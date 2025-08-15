<?php
// /front/about.php：獨立頁面
include_once __DIR__ . "/../api/db.php";
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>關於我們｜PurrMedi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once __DIR__ . "/nav.php"; ?>

<div class="container py-5">
  <?php include_once __DIR__ . "/about.section.php"; ?>
</div>

<footer class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
        <img src="/images/002.jpg" alt="logo" class="footer-logo mb-2">
        <div>PurrMedi 線上寵物諮詢平台</div>
        <div class="text-muted">關於我們 / 預約流程 / 常見問題</div>
      </div>
      <div class="col-md-4 text-center mb-3 mb-md-0">
        <div>&copy; 2025 PurrMedi. All rights reserved.</div>
        <div>聯絡信箱：purrmedi.service@gmail.com</div>
        <div>客服專線：02-00001234</div>
      </div>
      <div class="col-md-4 text-center text-md-end">
        <div>社群連結：</div>
        <a href="#" class="text-decoration-none">Facebook</a>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
