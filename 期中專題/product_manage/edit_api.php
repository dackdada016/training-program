<?php
require './part/connect_db.php';
header('Content-Type: application/json');

$output = [
  'success' => false,
  'lastId' => 0,
  'postData' => $_POST,
  'code' => 0,
  'errors' => '',
  'filename' => '',
];



// TODO:檔案上傳

// 篩選檔案類型, 決定副檔名
$extMap = [
  'image/jpeg' => '.jpg',
  'image/jpg' => '.jpg',
  'image/png' => '.png',
];

$path = __DIR__. './上傳照片/';

if(! empty($_FILES['my_file'])){
  $f = $_FILES['my_file'];

  $ext = isset($extMap[$f['type']]) ? $extMap[$f['type']] : ''; // 決定副檔名
  if(empty($ext)){
    // 檔案類型是錯的
    $output['error'] = '檔案類型錯誤';
  } else {
    $fname = sha1($f['name']. rand()). $ext; // 檔案名稱, 不包含路徑

    if(move_uploaded_file(
      $f['tmp_name'],
      $path. $fname
    )){
      $output['success'] = true;
      $output['filename'] = $fname;
    } else {
      $output['error'] = '無法搬移檔案';
    }
  }
}



// if(empty($_POST['productName'])) {
//   $output['errors']['productName'] = '沒有商品名稱';
//   echo json_encode($output, JSON_UNESCAPED_UNICODE);
//   exit;
// }

// // TODO: 欄位資料檢查




$isPass = true; // 是否通過檢查
$products_id = intval($_POST['products_id']);
$productName = $_POST['productName'] ?? '';
// $email = $_POST['email'] ?? '';
$productsType = $_POST['productsType'] ?? '';
$productsDecripttion = $_POST['productsDecripttion'] ?? '';
$productPrice = $_POST['productPrice'] ?? '';
$productUnit = $_POST['productUnit'] ?? '';
//$my_file = $_FILES['my_file']['name'] ?? '';



if(mb_strlen($productName) < 2){
  $output['errors']['productName'] = '請填寫商品名稱';
  $isPass = false;
}
// TODO:寫進資料庫

$sql = " UPDATE `products` SET 
`products_name`=?,
`type_id`=?,
`products_decripttion`=?,
`products_price`=?,
`products_unit`=?,
`products_img_name`=?
 WHERE `products_id`=?";
$stmt = $pdo->prepare($sql);

// TODO:line 97 error
if($isPass) {
 $stmt->execute([
    $productName,
    $productsType,
    $productsDecripttion,
    $productPrice,
    $productUnit,
    $fname
  ]);

  // lastInsertId -> 得到前面新增的資料(最新一筆)的id
  $output['success'] = !! $stmt->rowCount();

}



// echo json_encode($output);

echo json_encode($output, JSON_UNESCAPED_UNICODE);
