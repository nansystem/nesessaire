<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$cartModel = new CartModel();
$itemModel = new ItemModel();
$orderModel = new OrderModel();

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
}

$items = $itemModel->getItems( $itemIds );
$shippingDate = $orderModel->calculateShippingDate();
$productTotal = $itemModel->calculateSumAmount($items);
$deliveryFee = $itemModel->getDeliveryFee( $productTotal );
$cashOnDeliveryFee = $itemModel->getCashOnDeliveryFee( $productTotal );
$sumTotal = $productTotal + $deliveryFee + $cashOnDeliveryFee;

require_once('orderConfirmation.tmpl.php');