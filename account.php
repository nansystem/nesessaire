<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$cartModel = new CartModel();
$itemModel = new ItemModel();

//ログイン確認
if ( !$user = AuthModel::isLoggedIn() ){
	header('Location: login.php?redirect=account.php');
	exit();
}

require_once('account.tmpl.php');
