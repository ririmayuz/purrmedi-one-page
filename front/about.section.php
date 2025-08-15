<?php
// 這支檔案專門被首頁或 about.php 引入，不含 <html> 外框
if (!class_exists('DB')) { include_once __DIR__ . "/../api/db.php"; }

$About = new DB('purr_about');
$about = $About->find(1);
if (!is_array($about)) {
  $about = [
    'img' => 'default.png',
    'subtitle' => '',
    'title' => '尚未設定',
    'h1' => '', 'p1' => '',
    'h2' => '', 'p2' => '',
    'h3' => '', 'p3' => ''
  ];
}
?>

<div id="about" class="about-section row mx-auto">
  <div class="col-md-4 text-center mb-3 mb-md-0">
    <img src="/images/<?= htmlspecialchars($about['img']) ?>" class="about-img shadow" alt="關於圖片">
  </div>
  <div class="col-md-8">
    <p class="mb-1 small"><?= htmlspecialchars($about['subtitle']) ?></p>
    <h3 class="mb-3 fw-bold"><?= htmlspecialchars($about['title']) ?></h3>

    <?php if (!empty($about['h1']) || !empty($about['p1'])): ?>
      <h5 class="fw-bold"><?= htmlspecialchars($about['h1']) ?></h5>
      <p><?= nl2br(htmlspecialchars($about['p1'])) ?></p>
    <?php endif; ?>

    <?php if (!empty($about['h2']) || !empty($about['p2'])): ?>
      <h5 class="fw-bold"><?= htmlspecialchars($about['h2']) ?></h5>
      <p><?= nl2br(htmlspecialchars($about['p2'])) ?></p>
    <?php endif; ?>

    <?php if (!empty($about['h3']) || !empty($about['p3'])): ?>
      <h5 class="fw-bold"><?= htmlspecialchars($about['h3']) ?></h5>
      <p><?= nl2br(htmlspecialchars($about['p3'])) ?></p>
    <?php endif; ?>
  </div>
</div>

<!-- 呼叫行動按鈕（與首頁一致） -->
<div class="text-center my-4">
  <a href="/front/booking.php" class="btn btn-lg btn-primary px-4">我要預約</a>
</div>
