<?php
require_once('categoryModel.php');

$categoryModel = new CategoryModel();
$childCategories = $categoryModel->getChildCategories();