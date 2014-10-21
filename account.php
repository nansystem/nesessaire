<?php
session_start();
require_once('lib.php');
require_once('authModel.php');
require_once('cartModel.php');
require_once('itemModel.php');

$cartModel = new CartModel();
$itemModel = new ItemModel();

//ログイン確認
if ( !$user = AuthModel::isLoggedIn() ){
	header('Location: login.php?redirect=account.php');
	exit();
}

require_once('account.tmpl.php');
