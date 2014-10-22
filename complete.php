<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$cartModel = new CartModel();
$itemModel = new ItemModel();
$stockModel = new StockModel();
$orderModel = new OrderModel();
$orderDetailModel = new OrderDetailModel();

//ログイン確認
if ( !AuthModel::isLoggedIn() ){
	header('Location: login.php?redirect=order.php');
	exit();
}

//お客様情報登録確認
if( !$user = AuthModel::userCheck() ){
	header('Location: register1.php?redirect=order.php');
	exit();
}

//注文内容確認
$itemIds = $cartModel->getAll();
//カートに1個も商品がない場合はトップページへリダイレクトする
if( empty($itemIds) ){
	header('Location: index.php');
	exit();
}

// テスト用 テスト時はカートの情報を削除しないこと
// $itemIds = [
// 	1 => 100
// ];

//ホントは在庫確認をして、在庫数から注文数を減らす処理をトランザクションとして
//まとめて実行しなければならないが、PDOをテーブルのインスタンスごとに
//生成しているためモデルの設計上たぶんできない。
$outOfStockIds = [];
foreach ($itemIds as $itemId => $quantity) {
	if($quantity > $stockModel->getById($itemId)->quantity) {
		$outOfStockIds = [$itemId => $quantity];
		unset($itemIds[$itemId]);
	} else {
		$stockModel->update([
			'item_id' => $itemId,
			'quantity' => $stockModel->getById($itemId)->quantity - $quantity,
		]);
	}
}

//在庫不足のため注文できなかった商品情報を取得し,
//VIEWにてメッセージを表示する
$outOfStockItems = $itemModel->getItems( $outOfStockIds );

//注文を追加
$items = $itemModel->getItems( $itemIds );
$now = date('Y-m-d H:i:s');
$shippingDate = $orderModel->calculateShippingDate();
$productTotal = $itemModel->calculateSumAmount($items);
$deliveryFee = $itemModel->getDeliveryFee( $productTotal );
$cashOnDeliveryFee = $itemModel->getCashOnDeliveryFee( $productTotal );
$sumTotal = $productTotal + $deliveryFee + $cashOnDeliveryFee;

$orderId = $orderModel->insert([
		'user_id' => $user->user_id,
		'payment' => $_POST['pay'],
		'state' => 0,//未発送
		'remote_addr' => $_SERVER['REMOTE_ADDR'],
		'shipping_name' => $user->name,
		'shipping_furigana' => $user->furigana,
		'shipping_zipcode' => $user->zipcode,
		'shipping_xmpf' => $user->xmpf,
		'shipping_address' => $user->address,
		'product_total' => $productTotal,
		'delivery_fee' => $deliveryFee,
		'charge' => $cashOnDeliveryFee,
		'sum_total' => $sumTotal,
		'order_date' => $now,
		'shipping_date' => $shippingDate
	]);

foreach ($items as $item) {
	$orderDetailModel->insert([
		'order_id' => $orderId,
		'item_id' => $item->item_id,
		'product_name' => $item->product_name,
		'color_name' => $item->color_name,
		'size_name' => $item->size_name,
		'sale_price' => $item->list_price,
		'image_url' => $item->image_url,
		'quantity' => $item->quantity,
	]);
}

//カートの情報を削除する
$cartModel->removeAll();

require_once('complete.tmpl.php');