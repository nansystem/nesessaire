<?php
session_start();
require_once('itemModel.php');
require_once('lib.php');

$itemModel = new ItemModel();
$item = $itemModel->getById( h($_GET['item_id']) );

$ticket = create_hash(session_id());
$_SESSION['ticket'] = $ticket;

require_once('item.tmpl.php');