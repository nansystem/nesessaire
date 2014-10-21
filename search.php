<?php
session_start();
require_once('lib.php');
require_once('productModel.php');
require_once('categoryModel.php');
require_once('sidebar.php');

$productModel = new ProductModel();
$categoryModel = new CategoryModel();

if( isset( $_GET['keywordSubmit'] ) ){
	$products = $productModel->getByKeyWord( $_GET['keyword'] );
	$serachWord = $_GET['keyword'];
} elseif (isset($_GET['category_id'])){
	$products = $categoryModel->getByCategoryId([
		'category_id' => $_GET['category_id']
	]);
	$category = $categoryModel->getById($_GET['category_id']);
	if(!empty($category)){
		$serachWord = $category->category_name;
	} else {
		//category_idが範囲外の場合は検索ワードを''とする
		$serachWord = '';		
	}
} else {
	//指定がない場合はすべて表示する
	$products = $productModel->getLimitRowWithRelationshipTables();
	$serachWord = 'すべて';
}


require_once("search.tmpl.php");
