<?php

require './product_manage/part/connect_db.php';
$pageName = 'add';
$title = "新增商品資料";

?>

<?php include './product_manage/part/html-header.php' ?>
<?php include './product_manage/part/html-body-header.php' ?>
<div class="container add-prouct ms-auto me-auto mt-3">
    <div class="row ms-auto me-auto">
        <div class="col-lg-6 mt-3 ms-auto me-auto">
            <div class=" border border-warning rounded rounded-3">
                <div class="card-body ms-auto me-auto">
                    <h5 class="m-0 border-bottom pb-2 border-warning">新增商品資料</h5>
                    <form  name="form-proudct" onsubmit="">
                        <div class="mb-3 mt-3">
                            <label for="product-name" class="form-label text-capitalize">
                                product name <br>
                                商品名稱
                            </label>
                            <input type="text" class="form-control" id="product-name" name="product-name" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 mt-2 " >
                            <label for="fodder" class="form-label text-capitalize " >
                                product type <br>
                                商品類型
                            </label><br>
                            <input type="radio" id="fodder" name="type_id" value="fodder" checked>
                            <label for="fodder">fodder</label><br>
                            <input type="radio" id="food-canned" name="type_id" value="food-canned">
                            <label for="food-canned">food canned</label>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="products_decripttion" class="form-label text-capitalize">
                                products-decripttion
                            </label> -->
                            <div class="input-group">
                                <span class="input-group-text">products-decripttion</span>
                                <textarea  class="form-control" name="address" id="products_decripttion" cols="30" rows="3" aria-label="products-decripttion"></textarea>
                                <div class="form-text"></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <input class="btn border-primary text-white bg-primary" type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './product_manage/part/html-script.php' ?>
<?php include './product_manage/part/html-foot.php' ?>