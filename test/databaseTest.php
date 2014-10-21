<?php
require_once("../userModel.php");

$userModel = new UserModel();
if(!$userModel){
	die("DB could not connect.");
}

$users = $userModel->get("users");
if( $users ) {
	foreach($users as $user){
		print_r($user);
	}
}

$user = $userModel->query("SELECT * FROM users WHERE user_id = :user_id", ['user_id'=>1]);
// if( $user ) {
// 	print_r($user);
// }

