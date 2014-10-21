<?php
require_once('../passwordHash.php');

//パスワードをハッシュ化する
$hashedPassword = create_hash("31043104");
echo strlen($hashedPassword);
echo "<br>";
$hashedPassword = create_hash("31043104");
echo strlen($hashedPassword);
echo "<br>";

//パスワードが正しいか検証する
if(validate_password("31043104",$hashedPassword)){
	echo "correct";
}else{
	echo "fail";
}