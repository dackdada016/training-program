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
                    <form name="formProudct" method="POST"
                    onsubmit="checkForm(event)" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">
                            <label for="productName" class="form-label text-capitalize">
                                product name 商品名稱
                            </label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 mt-2 ">
                            <label for="productType" class="form-label text-capitalize ">
                                product type 商品類型
                            </label><br>
                            <select name="productsType">
                                <option value="none" selected disabled hidden>請選擇商品分類</option>
                                <option value="1" >飼料</option>
                                <option value="2" >罐頭</option>
                                <option value="3" >外出繩</option>
                                <option value="4" >耐磨玩具</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">產品介紹</span>
                                <textarea placeholder="最少10個字的介紹" class="form-control rounded-end" name="productsDecripttion" id="productsDecripttion" cols="30" rows="3" aria-label="productsDecripttion" required ></textarea>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="productPrice" class="form-label text-capitalize">
                                product price 商品價格
                            </label>
                            <input type="text" class="form-control" id="productPrice" name="productPrice" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="productUnit" class="form-label m-0 text-capitalize">
                                product unit 販售單位
                            </label><br>
                            <span class="font-monospace bg-success text-secondary bg-opacity-10">Ex: 1kg/包</span>
                            <input type="text" class="form-control" id="productUnit" name="productUnit" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="input-group mb-3 rounded">
                            <input type="file"  accept="image/*" name="my_file" class="form-control" multiple>
                        </div>
                        <div class="file mb-3">
                            <img src="" id="myimg" width="200">
                        </div>
                        <div class="d-flex justify-content-center btn border-primary text-white bg-primary">
                            <input class="btn text-white" type="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './part/html-script.php' ?>
<script>
    // TODO: 表單驗證
    
    const f = document.formProudct.my_file;
      const myimg = document.querySelector("#myimg");

      // Promise function, 用來取得圖檔的 DataURL
      function getDataURLByFile(file) {
        if (!(file instanceof File)) {
          throw new Error("必須是 File 類型");
        }

        return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.onload = function () {
            resolve(reader.result);
          };
          reader.onerror = function (error) {
            reject(error);
          };
          reader.readAsDataURL(file); // 讀取檔案內容
        });
      }

      f.onchange = async (e) => {
        console.log(f.files); // FileList, File
        myimg.src = await getDataURLByFile(f.files[0]);
      };
    
    const checkForm = (e) => {
        e.preventDefault(); // 不要讓原來的表單送出

        // 所有輸入欄回復原來的外觀
        const inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach((el) => {
        el.style.border = '1px solid #CCCCCC';
        el.nextElementSibling.innerHTML = '';
        });
        let isPass = true; // 預設是通過檢查的

        let field = document.formProudct.productName; // 當前要檢查的欄位
        if (field.value.length < 2) {
        isPass = false;
        field.style.border = '2px solid red';
        field.nextElementSibling.innerHTML = '請輸入正確的商品名稱';
        }
        let pd = document.formProudct.productsDecripttion;
        if( pd.value.length < 10 ){
            isPass = false;
            pd.style.border = '2px solid red';
            pd.nextElementSibling.innerHTML = '請輸入正確的商品名稱';
        }


        if (!isPass) {
        return; // 沒有通過檢查就結束, 不發 AJAX request
        }
        const fd = new FormData(document.formProudct);
        /*
            fetch('add-api.php', {
            method: 'POST',
            body: fd
            }).then(function(response){
            return response.json()
            }).then(obj=>{
            console.log(obj);
            })
        */
        fetch('add_api.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.json())
        .then(obj => {
            console.log(obj);
            if (obj.success) {
            alert('新增成功');
            } else {
            for (let k in obj.errors) {
                const el = document.querySelector('#' + k);
                if (el) {
                el.style.border = '2px solid red';
                el.nextElementSibling.innerHTML = obj.errors[k];
                }
            }
            }
        })
    };
    </script>
<?php include './part/html-foot.php' ?>