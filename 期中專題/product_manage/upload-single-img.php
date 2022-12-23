<?php

header('Content-Type: application/json');
// 上傳的欄位名稱 avatar

// 輸出的格式
$output = [
  'success' => false,
  'error' => '',
  'filename' => '',
];

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

echo json_encode($output);
