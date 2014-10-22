<?php
require_once __DIR__ . '/vendor/autoload.php';
use Intervention\Image\ImageManager;

$url = $_GET["url"];
$width = $_GET["width"];
$height = $_GET["height"];

$manager = new ImageManager();
$img = $manager->make($url)->resize($width, $height);
echo $img->response('jpg');