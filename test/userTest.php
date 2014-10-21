<?php
require_once('../user.php');

$userModel = new User();
$result = $userModel->emailExists('sato171786@gmail.com');
var_dump($result);


$result = $userModel->validatePassword('sato171786@gmail.com','password');
var_dump($result);

$result = $userModel->update(
	[
		'email1' => 'ktou@gmail.com',
		'name' => '木枯さみえ',
		'furigana' => 'コガラシサミエ',
		'sex' => '1',
		'zipcode' => '3050001',
		'tel' => '09012346587',
		'xmpf' => '5',
		'address' => '銀座一丁目',
	]);

var_dump($result);
