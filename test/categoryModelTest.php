<?php
require_once('../categoryModel.php');

$categoryModel = new CategoryModel();
$childCategories = $categoryModel->getChildCategories();
var_dump($childCategories);