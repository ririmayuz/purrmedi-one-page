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

$loggedIn = !empty($_SESSION['user']);  // 是否登入
$currentAcc = null;                     // 目前登入者帳號（顯示用）
if ($loggedIn) {
  $Users = new DB('purr_users');
  // 允許以 id 或陣列查找，視你的 DB() 實作；通常 find(主鍵id) OK
  $u = $Users->find((int)$_SESSION['user']);
  $currentAcc = $u['acc'] ?? null;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PurrMedi 首頁</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-light">

<!-- Navbar（主色；登入後顯示帳號與下拉） -->
<?php include_once "./front/nav.php"; ?>


<div class="container py-5">
  <!-- 輪播圖（75vh 等高 cover） -->
  <div id="carouselHero" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel">
    <?php if (!empty($carousel)): ?>
      <div class="carousel-indicators">
        <?php foreach ($carousel as $i => $item): ?>
          <button type="button"
                  data-bs-target="#carouselHero"
                  data-bs-slide-to="<?= $i ?>"
                  class="<?= $i === 0 ? 'active' : '' ?>"
                  aria-current="<?= $i === 0 ? 'true' : 'false' ?>"
                  aria-label="Slide <?= $i+1 ?>"></button>
        <?php endforeach; ?>
      </div>
      <div class="carousel-inner">
        <?php foreach ($carousel as $i => $item): ?>
          <?php
            $posClass = '';
            if ($i === 0) $posClass = 'hero-pos-45';
            if ($i === 1) $posClass = 'hero-pos-35';
            if ($i === 2) $posClass = 'hero-pos-30';
          ?>
          <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
            <img src="/images/<?= htmlspecialchars($item['img']) ?>"
                 class="d-block <?= $posClass ?>"
                 alt="<?= htmlspecialchars($item['text'] ?? ('Slide '.($i+1))) ?>">
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/images/default.png" class="d-block hero-pos-45" alt="預設首圖">
        </div>
      </div>
    <?php endif; ?>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev" aria-label="上一張">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next" aria-label="下一張">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
  </div>

 <!-- 🐶🐱 About 區塊 -->
  <?php include_once "./front/about.section.php"; ?>
</div>



<!-- Footer（維持自然高度，不強制對齊） -->
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
