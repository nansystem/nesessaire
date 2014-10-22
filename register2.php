<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$userModel = new UserModel();
	$result = $userModel->update(
		[
			'email1' => $_SESSION['email'],
			'name' => $_SESSION['name'],
			'furigana' => $_SESSION['furigana'],
			'sex' => $_SESSION['sex'],
			'zipcode' => $_SESSION['zipcode'],
			'tel' => $_SESSION['tel'],
			'xmpf' => $_SESSION['xmpf'],
			'address' => $_SESSION['address'],
		]);

	if( $result ) {
		header('Location: order.php');
		exit();
	}
}

require_once('register2.tmpl.php');

