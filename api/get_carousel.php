<?php
include_once __DIR__ . "/db.php";

// 回傳全部輪播資料
$rows = $Images->all();
return $rows;
