<?php
require_once('../itemModel.php');
$itemModel = new itemModel();
$item = $itemModel->getByIdWithRelations(15);
var_dump($item);

$stockQuantity = $itemModel->getStockQuantity(15);
var_dump($stockQuantity);
