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


$path = 'http://localhost/training-program/%e6%9c%9f%e4%b8%ad%e5%b0%88%e9%a1%8c/product_manage/%e4%b8%8a%e5%82%b3%e7%85%a7%e7%89%87/';

?>
<?php include './part/html-header.php' ?>
<?php include './part/html-body-header.php' ?>
<?php include './part/html-body-sidebar.php' ?>
<div class="container add-prouct ms-auto me-auto mt-3">
    <div class="row ms-auto me-auto">
        <div class="col-lg-6 mt-3 ms-auto me-auto">
            <div class=" border border-warning rounded rounded-3">
                <div class="card-body ms-auto me-auto">
                    <h5 class="m-0 border-bottom pb-2 border-warning">修改資料</h5>
                    <form name="formProudct" method="POST"
                    onsubmit="checkForm(event)" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="products_id" value="<?= $r['products_id'] ?>" >
                        <div class="mb-3 mt-3">
                            <label for="productName" class="form-label text-capitalize">
                                product name 商品名稱
                            </label>
                            <input type="text" class="form-control" id="productName" name="productName" value="<?= ($r['products_name']) ?>" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 mt-2 ">
                            <label for="productType" class="form-label text-capitalize ">
                                product type 商品類型
                            </label><br>
                            <select name="productsType" value="<?= $r['type_name'] ?>">
                                <option value="飼料" >飼料</option>
                                <option value="罐頭" >罐頭</option>
                                <option value="外出繩" >外出繩</option>
                                <option value="耐磨玩具" >耐磨玩具</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">產品介紹</span>
                                <textarea placeholder="最少10個字的介紹" class="form-control rounded-end" name="productsDecripttion" id="productsDecripttion" cols="30" rows="3" aria-label="productsDecripttion"><?= htmlentities($r['products_decripttion']) ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="productPrice" class="form-label text-capitalize" >
                                product price 商品價格
                            </label>
                            <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?= ($r['products_price']) ?>"  required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="productUnit" class="form-label m-0 text-capitalize">
                                product unit 販售單位
                            </label><br>
                            <span class="font-monospace bg-success text-secondary bg-opacity-10">Ex: 1kg/包</span>
                            <input type="text" class="form-control" id="productUnit" name="productUnit" value="<?= htmlentities($r['products_unit']) ?>"  required>
                            <div class="form-text"></div>
                        </div>
                        <div class="input-group mb-3 rounded">
                            <input type="file"  accept="image/jpeg,image/png" name="my_file" class="form-control" multiple>
                        </div>
                        <div class="file mb-3">
                            <img src="<?= $path . $r['products_img_name']?>" id="myimg" width="200">
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

      //預覽圖片
      f.addEventListener('change',function(){
        getDataURLByFile(this.files[0]).then(data => myimg.src = data)
       
      })
     // f.onchange = async (e)=>{
        // const fd = new FormData(document.formProudct);
        // const r = await fetch('upload-single-img.php', {
        //   method: 'POST',
        //   body: fd
        // });
        // const data = await r.json();
        // console.log({data});
        // if(data.success){
        //   // 成功上傳
        //   myimg.src = 'http://localhost/training-program/%e6%9c%9f%e4%b8%ad%e5%b0%88%e9%a1%8c/product_manage/%e4%b8%8a%e5%82%b3%e7%85%a7%e7%89%87/' + data.filename;
        //   document.formProudct.my_file.value = data.filename;
        // } else {
        //   alert(data.error || '沒有上傳的檔案');
        // }
     // };
    
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
        return;  alert('Error') // 沒有通過檢查就結束, 不發 AJAX request
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
        fetch('edit_api.php', {
        method: 'POST',
        body: fd
        })
        .then(r => r.json())
        .then(obj => {
            console.log(obj);
            if (obj.success) {
            alert('修改成功');
            location.href = "list.php"
            } else {
            for (let k in obj.errors) {
                const el = document.querySelector('#' + k);
                if (el) {
                el.style.border = '2px solid red';
                el.nextElementSibling.innerHTML = obj.errors[k];
                }
            }
            alert('資料沒有修改');
            }
        })
  };
    </script>
<?php include './part/html-foot.php' ?>