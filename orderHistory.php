<?php
session_start();
require_once('lib.php');
require_once('authModel.php');
require_once('cartModel.php');
require_once('itemModel.php');
require_once('stockModel.php');
require_once('orderModel.php');
require_once('orderDetailModel.php');

$cartModel = new CartModel();
$itemModel = new ItemModel();
$stockModel = new StockModel();
$orderModel = new OrderModel();
$orderDetailModel = new OrderDetailModel();

//ログイン確認
if ( !$user = AuthModel::isLoggedIn() ){
	header('Location: login.php?redirect=order.php');
	exit();
}

$orders = $orderModel->getByUserId($user->user_id);

require_once('orderHistory.tmpl.php');