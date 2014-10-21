<?php
require_once('../database.php');
$database = new Database();
$users = $database->query('SELECT * FROM users WHERE user_id = :user_id');
var_dump($users);