<?php
require_once('lib.php');
require_once('cartModel.php');
require_once('itemModel.php');

$cartModel = new CartModel();
$itemModel = new ItemModel();

$action = getRequest('action', 'index');
//追加や削除の2重登録防止
$ticket = isset($_POST['ticket'])    ? $_POST['ticket']    : '';
$save   = isset($_SESSION['ticket']) ? $_SESSION['ticket'] : '';
if ($ticket === '' || $ticket !== $save) {
	$action = 'cart';
}
unset($_SESSION['ticket']);
$ticket = create_hash(session_id());
$_SESSION['ticket'] = $ticket;

switch( $action ){
	case 'add' :
		$item_id = getRequest('item_id');
		if( !is_null( $item = $itemModel->getById($item_id) ) ){
			$cartModel->addItem( $item->item_id );
		} else{
			header('Location: index.php');
			exit();
		}
		break;
	case 'remove' :
		$item_id = getRequest('item_id');
		if( !is_null( $item = $itemModel->getById($item_id) ) ){
			$cartModel->removeItem($item->item_id);
		} else{
			header('Location: cart.php');
			exit();
		}
		break;
	case 'cart' :
		//現状はcartのみの処理はない
		break;
	default :
		header('Location: index.php');
		exit();
}
$itemIds = $cartModel->getAll();
$items = $itemModel->getItems($itemIds);

$productTotal = $itemModel->calculateSumAmount($items);
$deliveryFee = $itemModel->getDeliveryFee( $productTotal );
$sumTotal = $productTotal + $deliveryFee;

require_once('cart.tmpl.php');