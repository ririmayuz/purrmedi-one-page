<?php
include_once "db.php";

$table = $_POST['table'] ?? '';
if ($table == '') {
  exit("no table");
}

$DB = new DB($table);

// 1) 如果有上傳圖片，存到 /images，欄位名字固定 img
if (!empty($_FILES['img']['tmp_name'])) {
  $filename = $_FILES['img']['name'];
  move_uploaded_file($_FILES['img']['tmp_name'], "../images/" . $filename);
  $_POST['img'] = $filename;
}

// 2) 把不用的欄位（table）移掉
unset($_POST['table']);

// 3) INSERT
$DB->save($_POST);

// 4) 回去（預設導回輪播）
to("../backend.php?do=carousel");
