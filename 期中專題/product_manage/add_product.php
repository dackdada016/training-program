<?php

require './part/connect_db.php';
$pageName = 'add';
$title = "新增商品資料";

?>

<?php include './part/html-header.php' ?>
<?php include './part/html-body-header.php' ?>
<div class="container add-prouct ms-auto me-auto mt-3">
    <div class="row ms-auto me-auto">
        <div class="col-lg-6 mt-3 ms-auto me-auto">
            <div class=" border border-warning rounded rounded-3">
                <div class="card-body ms-auto me-auto">
                    <h5 class="m-0 border-bottom pb-2 border-warning">新增商品資料</h5>
                    <form  name="formProudct" onsubmit="checkForm(event)">
                        <div class="mb-3 mt-3">
                            <label for="product-name" class="form-label text-capitalize">
                                product name <br>
                                商品名稱
                            </label>
                            <input type="text" class="form-control" id="product-name" name="product-name" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 mt-2 " >
                            <label for="fodder" class="form-label text-capitalize " >                                product type <br>
                            商品類型
                            

                            <!-- </label><br>
                            <input type="radio" id="fodder" name="type_id" value="fodder" checked>
                            <label for="fodder">fodder</label><br>
                            <input type="radio" id="food-canned" name="type_id" value="food-canned">
                            <label for="food-canned">food canned</label> -->
                        </div>
                        <div class="mb-3">
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
<?php include './part/html-script.php' ?>
<script>
// TODO 調整表單輸入類型的方式
    // 不要讓原來的表單送出
    const checkForm = (e) =>{
        e.preventDefault();

        // 回復所有輸入欄位外觀
        const iputs = document.querySelectorAll('input.form-control');
        inputs.forEach((el) => {
            el.style.border = '1px solid #ccc';
            el.nextElementSibling.innerHTML = '';
        });

        // 預設表單通過檢查
        let isPass = true;

        // 檢查商品名稱欄位
        let field = document.formProudct.name;
        if(field.value.length < 2){
            isPass = false;
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '請輸入正確的商品名稱';
        }
        // 如果欄位沒有通過檢查，不發AJAX request
        if(!isPass){
            return;
        }

        const fieldData = new FormData(document.formProudct)
        fetch('add_api.php',{
            method: 'POST',
            body: fieldData
        })
        .then( dataValue => dataValue.json() )
        .then(obj =>{
            console.log(obj);
            if(obj.success){
                alert('新增成功');
            }else{
                for(let msg in obj.errors){
                    const el = document.querySelector('#' + msg);
                    // 如果有錯誤訊息，顯示錯誤的欄位
                    if(el){
                        el.style.border = '2px solid red';
                        el.nextElementSibling.innerHTML = obj.errors[msg];
                    }
                }
            }
        })
    };
</script>
<?php include './part/html-foot.php' ?>