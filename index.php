<?php
include_once "./api/db.php";

$Images = new DB('purr_images');
$carousel = $Images->all(['sh' => 1]);

$About = new DB('purr_about');
$about = $About->find(1);
if (!is_array($about)) {
  $about = [
    'img' => 'default.png', 'subtitle' => '', 'title' => '尚未設定',
    'h1' => '', 'p1' => '', 'h2' => '', 'p2' => '', 'h3' => '', 'p3' => ''
  ];
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PurrMedi 首頁</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .about-section {
      background-color: #b98e68;
      border-radius: 15px;
      padding: 2rem;
      color: white;
    }
    .about-img {
      border-radius: 15px;
      width: 100%;
      max-width: 300px;
    }
    footer {
      background-color: #e9e9e9;
      padding: 2rem 1rem;
      color: #444;
      font-size: 0.9rem;
    }
    .footer-logo {
      max-width: 80px;
      filter: grayscale(1);
    }
  </style>
</head>
<body class="bg-light">

<!-- 🔝 導覽列 -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">PurrMedi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#carousel">首頁</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">關於我們</a></li>
      </ul>
      <div class="d-flex">
        <a href="./front/login.php" class="btn btn-outline-primary me-2">登入</a>
        <a href="./front/reg.php" class="btn btn-primary">註冊</a>
      </div>
    </div>
  </div>
</nav>

<div class="container py-5">
  <!-- 🔁 輪播圖區塊 -->
  <div id="carousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php foreach($carousel as $index => $item): ?>
        <div class="carousel-item <?= $index==0 ? 'active' : '' ?>">
          <img src="./images/<?= $item['img'] ?>" class="d-block w-100" alt="<?= $item['text'] ?>">
        </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- 🐶🐱 About 區塊 -->
  <div id="about" class="about-section row mx-auto">
    <div class="col-md-4 text-center mb-3 mb-md-0">
      <img src="./images/<?= $about['img'] ?>" class="about-img shadow" alt="關於圖片">
    </div>
    <div class="col-md-8">
      <p class="mb-1 small"><?= $about['subtitle'] ?></p>
      <h3 class="mb-3 fw-bold"><?= $about['title'] ?></h3>

      <h5 class="fw-bold"><?= $about['h1'] ?></h5>
      <p><?= nl2br($about['p1']) ?></p>

      <h5 class="fw-bold"><?= $about['h2'] ?></h5>
      <p><?= nl2br($about['p2']) ?></p>

      <h5 class="fw-bold"><?= $about['h3'] ?></h5>
      <p><?= nl2br($about['p3']) ?></p>
    </div>
  </div>
</div>

<!-- 🔚 頁尾 footer -->
<footer class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
        <img src="./images/002.jpg" alt="logo" class="footer-logo mb-2">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>