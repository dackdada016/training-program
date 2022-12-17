-- 商品總覽 
select * FROM `products` LIMIT 0, 10;
-- 查看商品詳細內容
select * FROM `products` WHERE `products_name`;

-- 搜尋這個會員的購物車清單
select `products_id` FROM `shopping_cart` WHERE `member_id`=1;



