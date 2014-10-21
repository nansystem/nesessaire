<?php
require_once('../productModel.php');

$productModel = new Product();
$stocks = $productModel->getStock(1);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<select name="" id="">
<?php foreach ($stocks as $product): ?>
	<option value="<?= $product->item_id ?>"><?=$product->size_name?>/<?=$product->color_name?>/<?=$product->quantity?></option>
<?php endforeach ?>
</select>
</body>
</html>