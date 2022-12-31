<?php
require './part/connect_db.php';
$pageName = 'list';
$title = "資料列表";
$path = 'http://localhost/training-program/%e6%9c%9f%e4%b8%ad%e5%b0%88%e9%a1%8c/product_manage/%e4%b8%8a%e5%82%b3%e7%85%a7%e7%89%87/';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

$t_sql = "SELECT COUNT(1) FROM products";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = [];
$totalPages = ceil($totalRows / $perPage);
if (!empty($totalRows)) {
  if ($page > $totalPages) {
    // 頁碼超出範圍時, 轉向到最後一頁
    header('Location: ?page=' . $totalPages);
    exit;
  }
  $sql =sprintf(
    "SELECT * FROM `products` ORDER BY products_id DESC LIMIT %s, %s",
    ($page - 1) * $perPage,
      $perPage
  );
  $rows = $pdo->query($sql)->fetchAll();
}
?>
<?php include './part/html-header.php' ?>
<?php include './part/html-body-header.php' ?>
<?php include './part/html-body-sidebar.php' ?>



<nav class="title d-flex flex-column flex-grow-1 ms-2 me-2 border">
  
        <div class="d-flex align-items-center ps-1 pe-1 m-2" >
          商品列表
        </div>
        <div class="content-title border-top border-bottom">
          <div class="d-flex align-items-center ps-1 pe-1 m-2">
            <div class="content-title me-3">商品項目</div> 
            <a href="add_product.php"><i class="btn border fa-regular fa-square-plus p-1">新增</i></a>
          </div>
          
        </div>
        <table class="table table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th scope="col">詳情</th>
                    <th scope="col">圖片</th>
                    <th scope="col">商品ID</th>
                    <th scope="col-1">商品名稱</th>
                    <th scope="col-1">商品類型</th>
                    <th scope="col-1">商品介紹</th>
                    <th scope="col-1">商品價格</th>
                    <th scope="col-1">販售單位</th>
                    <th scope="col-2" colspan="2" class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) :?>
                <tr>
                    <td>
                      <a class="rounded-pill border btn btn-light" href="<?= "details.php?products_id=" . $r['products_id']?>" >
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                    <td><img src="<?= $path . $r['products_img_name'] ?>" width="90" height="90"></td>
                    <td><?= $r['products_id'] ?></td>
                    <td><?= $r['products_name'] ?></td>
                    <td><?= $r['type_name'] ?></td>
                    <td><?= $r['products_decripttion'] ?></td>
                    <td><?= $r['products_price'] ?></td>
                    <td><?= $r['products_unit'] ?></td>
                    <td class="align-items-center text-center" colspan="2">
                        <a class="btn btn-outline-primary mb-1" href="<?= "updata.php?products_id=" . $r['products_id']?>" >
                            <i class="fa-solid fa-pen-to-square"></i>編輯
                        </a>
                        <a class="btn btn-outline-danger" href="javascript: delete_it(<?= $r['products_id']?>)">
                            <i class="fa-solid fa-trash-can"></i>刪除
                        </a> 
                    </td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
        <div class="d-flex flex-column align-items-center ps-1 pe-1 m-2">
          <ul class="pagination justify-content-end">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-circle-arrow-left"></i></a>
            </li>
              <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                    if ($i >= 1 and $i <= $totalPages) :
              ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?> ">
              <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endif;
            endfor; ?>
            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-circle-arrow-right"></i></a>
            </li>
          </ul>
        </div>
    </nav>
</container>

<?php include './part/html-script.php' ?>
<script>
  function delete_it(products_id,products_name){
    if(confirm(`確定要刪除編號 ${products_id} 的資料嗎?`)){
      location.href = `delete.php?products_id=${products_id}`;
    }
  }

</script>
<?php include './part/html-foot.php' ?>