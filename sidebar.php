<?php
require_once __DIR__ . '/vendor/autoload.php';

$categoryModel = new CategoryModel();
$childCategories = $categoryModel->getChildCategories();