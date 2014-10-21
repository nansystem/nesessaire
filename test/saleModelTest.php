<?php
require_once('../saleModel.php');

$saleModel = new SaleModel();
$sales = $saleModel->get();
