<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

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