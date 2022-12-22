<?php
require './part/connect_db.php';
header('Content-Type: application/json');

$output = [
  'success' => false,
  'lastId' => 0,
  'postData' => $_POST,
  'code' => 0,
  'errors' => []
];

if(empty($_POST['productName'])) {
  $output['errors']['productName'] = '沒有商品名稱';
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

// TODO: 欄位資料檢查

$isPass = true; // 是否通過檢查

$productName = $_POST['productName'] ?? '';
// $email = $_POST['email'] ?? '';
$productsType = $_POST['productsType'] ?? '';
$productsDecripttion = $_POST['productsDecripttion'] ?? '';
$productPrice = $_POST['productPrice'] ?? '';
$productUnit = $_POST['productUnit'] ?? '';
$my_file = $_FILES['my_file']['name'] ?? '';



if(mb_strlen($productName) < 2){
  $output['errors']['productName'] = '請填寫商品名稱';
  $isPass = false;
}

// if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
//   $output['errors']['email'] = '請填寫正確的 email';
//   $isPass = false;
// }


// $sql = " INSERT INTO `products`(`products_id`, `products_name`, `type_id`, `products_decripttion`, `products_price`, `products_unit`, `products_img_name`) VALUES (?,?,?,?,?,?,?) " and " INSERT INTO `product_imgs`(`products_id`, `img_name`) VALUES (?,?)";
$sql = " INSERT INTO `products`(`products_name`, `type_id`, `products_decripttion`, `products_price`, `products_unit`, `products_img_name`) VALUES (?,?,?,?,?,?)";

  // and " INSERT INTO `product_imgs`(`products_id`, `img_name`) VALUES (?,?)";



$stmt = $pdo->prepare($sql);

if($isPass) {
 $stmt->execute([
    $productName,
    $productsType,
    $productsDecripttion,
    $productPrice,
    $productUnit,
    $my_file,
  ]);

  // lastInsertId -> 得到前面新增的資料(最新一筆)的id
  $id = $pdo -> lastInsertId();
  $output['lastId'] = $id;
  $output['success'] = !! $stmt->rowCount();

}
$sql_img = " INSERT INTO `product_imgs`(`products_id, `img_name`) VALUES (?,?) ";

$stmt_img = $pdo->prepare($sql_img);
if($isPass){
  $stmt_img->execute([
    $id,
    $my_file,
  ]);
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
