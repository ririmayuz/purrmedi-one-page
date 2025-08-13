<?php
include_once __DIR__ . "/api/db.php";

// 之後做管理員登入時在這裡檢查 session
// if(empty($_SESSION['admin'])) to("login.php");

$do = $_GET['do'] ?? 'carousel';
$file = "backend/" . $do . ".php";
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <title>後台管理</title>
  <link rel="stylesheet" href="/css/css.css">
</head>
<body>
  <h1>後台管理</h1>
  <nav>
    <a href="?do=carousel">首圖輪播</a> |
    <a href="?do=about">醫師/網站介紹</a> |
    <a href="?do=booking">預約管理</a> |
    <a href="?do=user">會員列表</a>
  </nav>
  <hr>

  <main>
    <?php
      if(file_exists($file)){
        include $file;
      }else{
        echo "<div style='color:#d00'>找不到頁面：$file</div>";
      }
    ?>
  </main>
</body>
</html>
