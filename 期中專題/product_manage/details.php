<?php
require './part/connect_db.php';
$title = "修改資料";
$path = 'http://localhost/training-program/%e6%9c%9f%e4%b8%ad%e5%b0%88%e9%a1%8c/product_manage/%e4%b8%8a%e5%82%b3%e7%85%a7%e7%89%87/';

// $p_id = $_GET['p'];
$products_id = isset($_GET['products_id']) ? intval($_GET['products_id']) : 0;
if(empty($products_id)){
    header('Location: list.php');
    exit;
  }
$sql = "SELECT * FROM `products` WHERE `products_id` = $products_id";
$r = $pdo->query($sql)->fetch();

?>
<?php include './part/html-header.php' ?>
<?php include './part/html-body-header.php' ?>
<?php include './part/html-body-sidebar.php' ?>
<div class="container mt-3 ">
            <div class="btn">
                <a href="list.php" class="text-danger">
                <i class="fa-solid fa-angles-left">回上一頁</i>
                </a>
            </div>
            <div class="card ms-auto me-auto" style="width: 18rem;">
                <img src="<?= $path . $r['products_img_name']?>" id="myimg" " class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title border-bottom border-warning">
                        <?= ($r['products_name']) ?>
                    </h5>
                    <span class="border-bottom border-warning">
                        <?= $r['type_name'] ?>
                    </span>
                    <p class="card-text">
                        <?= htmlentities($r['products_decripttion']) ?>
                    </p>
                    <span class="m-0 text-capitalize border-bottom border-warning">
                        商品價格
                    </span><br>
                    <div class="form-text">
                        <?= ($r['products_price']) ?>
                    </div>
                    <span class="m-0 text-capitalize border-bottom border-warning">
                        販售單位
                    </span><br>
                    <div class="form-text">
                        <?= htmlentities($r['products_unit']) ?>
                    </div>
                </div>
            </div>
</div>
<?php include './part/html-script.php' ?>
<?php include './part/html-foot.php' ?>