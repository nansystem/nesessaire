<?php
session_start();
require_once("lib.php");
require_once('userModel.php');
require_once('register3.tmpl.php');

$userModel = new UserModel();
$id = $userModel->insert([
	'email1' => $_SESSION['email1'],
	'password' => $_SESSION['password'],
	'name_kanji' => $_SESSION['name_kanji'],
	'name_kana' => $_SESSION['name_kana']
]);

if( $id ){
	echo "{$id}が登録されました。";
}else{
	echo "登録に失敗しました。";	
}