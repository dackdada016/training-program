<?php
require './part/connect_db.php';
$pageName = 'list';
$title = "資料列表";
$path = 'http://localhost/training-program/%e6%9c%9f%e4%b8%ad%e5%b0%88%e9%a1%8c/product_manage/%e4%b8%8a%e5%82%b3%e7%85%a7%e7%89%87/';

$sql =sprintf("SELECT * FROM `products` WHERE 1");
$rows = $pdo->query($sql)->fetchAll();
?>
<?php include './part/html-header.php' ?>
<?php include './part/html-body-header.php' ?>
<?php include './part/html-body-sidebar.php' ?>
<nav class="title d-flex flex-column flex-grow-1 ms-2 me-2 border">
        <div class="d-flex align-items-center ps-1 pe-1 m-2" >
          更新商品內容
        </div>
        <table class="table table-striped table align-middle">
            <thead>
                <tr>
                    <th scope="col">圖片</th>
                    <th scope="col">商品ID</th>
                    <th scope="col-1">商品名稱</th>
                    <th scope="col-1">商品類型</th>
                    <th scope="col-1">商品介紹</th>
                    <th scope="col-1">商品價格</th>
                    <th scope="col-1">販售單位</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) :?>
                <tr>
                    <td><img src="<?= $path . $r['products_img_name'] ?>"></td>
                    <td><?= $r['products_id'] ?></td>
                    <td><?= $r['products_name'] ?></td>
                    <td><?= $r['type_id'] ?></td>
                    <td><?= $r['products_decripttion'] ?></td>
                    <td><?= $r['products_price'] ?></td>
                    <td><?= $r['products_unit'] ?></td>
                    <td class="align-items-center">
                        <a href="index_.php"><i class="fa-solid fa-pen-to-square btn border">編輯</i></a>
                        <i class="fa-solid fa-trash-can btn border">刪除</i>
                    </td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
    </nav>
</container>

<?php include './part/html-script.php' ?>
<?php include './part/html-foot.php' ?>