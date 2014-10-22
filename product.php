<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$product_id = h($_GET['product_id']);
$productModel = new ProductModel();
$product = $productModel->getRelationshipTablesById( $product_id );
$stocks = $productModel->getStock( $product_id );

$ticket = create_hash(session_id());
$_SESSION['ticket'] = $ticket;

require_once('product.tmpl.php');