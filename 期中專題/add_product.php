<?php

require './product_manage/part/connect_db.php';
$pageName = 'add';
$title = "新增商品資料";

?>

<?php include './product_manage/part/html-header.php' ?>
<?php include './product_manage/part/html-body-header.php' ?>
<div class="container add-prouct ms-auto me-auto mt-3 border border-warning rounded rounded-3">
    <div class="row">
        <div class="col-lg-6 mt-3">
            <h5 class="card-title">新增商品資料</h5>
            <form name="form-proudct" onsubmit="">
                <div class="mb-3">
                    <label for="product-name" class="form-label text-capitalize">
                        product name
                    </label>
                    <input type="text" class="form-control" id="product-name" name="product-name" required>
                    <div class="form-text"></div>
                </div>


            </form>
        </div>
    </div>
</div>
<?php include './product_manage/part/html-script.php' ?>
<?php include './product_manage/part/html-foot.php' ?>