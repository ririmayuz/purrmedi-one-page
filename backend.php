<?php
include_once __DIR__ . "/api/db.php";

$do = $_GET['do'] ?? 'carousel';
$file = "backend/" . $do . ".php";
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PurrMedi 後台管理</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!-- 導覽列 -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="backend.php">PurrMedi 後台</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#backendNav" aria-controls="backendNav" aria-expanded="false" aria-label="切換選單">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="backendNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link <?=($do=='carousel')?'active':''?>" href="?do=carousel">首圖輪播</a></li>
        <li class="nav-item"><a class="nav-link <?=($do=='about')?'active':''?>" href="?do=about">醫師/網站介紹</a></li>
        <li class="nav-item"><a class="nav-link <?=($do=='booking')?'active':''?>" href="?do=booking">預約管理</a></li>
        <li class="nav-item"><a class="nav-link <?=($do=='user')?'active':''?>" href="?do=user">會員列表</a></li>
      </ul>
      <a href="logout.php" class="btn btn-light btn-sm">登出</a>
    </div>
  </div>
</nav>

<!-- 內容區 -->
<main class="container my-4">
  <?php
    if(file_exists($file)){
      include $file;
    }else{
      echo "<div class='alert alert-danger'>找不到頁面：$file</div>";
    }
  ?>
</main>

<!-- 頁尾 -->
<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">
    © 2025 PurrMedi 後台管理
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
