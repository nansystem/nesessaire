<?php
require_once('../productModel.php');

$productModel = new ProductModel();
$products = $productModel->getByKeyWord('モヘアプルオーバー');
var_dump($products);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php foreach ($products as $product): ?>
	<span><?= $product->product_id ?></span>
	<img src="../<?= $product->image_url ?>" alt="" width="100">	
<?php endforeach ?>
</body>
</html>

