<?php
session_start();
require_once("lib.php");
require_once("productModel.php");
require_once("categoryModel.php");
require_once("sidebar.php");

$productModel = new ProductModel();
$categoryModel = new CategoryModel();

//メインビジュアル左
$mainVisuals = $productModel->getPickups();
//メインビジュアル右
//アクセサリー
$mainVisual3 = $productModel->getById(12);
//バッグ
$mainVisual4 = $productModel->getById(23);

//新着
$products = $productModel->getLimitRowWithRelationshipTables(10);

//トップス
$topsCategoryProducts = $categoryModel->getByParentCategoryId([
	'parent_category_id' => 2,
],3);
//ジャケット・アウター
$jacketCategoryProducts = $categoryModel->getByParentCategoryId([
	'parent_category_id' => 11,
],3);
//アクセサリー
$accessoryCategoryProducts = $categoryModel->getByParentCategoryId([
	'parent_category_id' => 6,
],3);

require_once("index.tmpl.php");