<?php
require './part/connect_db.php';

$products_id = isset($_GET['products_id']) ? intval($_GET['products_id']) : 0;
if(empty($products_id)){
    header('Location: list.php');
    exit;
  }
$sql = "DELETE FROM `products` WHERE products_id=$products_id";
$pdo->query($sql);
if(empty($_SERVER['HTTP_REFERER'])){
    $come_from = 'list.php';
  } else {
    $come_from = $_SERVER['HTTP_REFERER']; // 從哪裡來, 回哪裡去
  }
header("Location: $come_from");