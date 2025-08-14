<?php
include_once "../api/db.php";

// 檢查是否登入
if (!isset($_SESSION['user'])) {
    to("login.php");
    exit;
}

$uid = $_SESSION['user'];
$Booking = new DB('purr_booking');
$bookings = $Booking->all(['user_id' => $uid]);
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>我的預約紀錄</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!-- 導覽列 -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/index.php">PurrMedi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontNav" aria-controls="frontNav" aria-expanded="false" aria-label="切換選單">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="frontNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/index.php">首頁</a></li>
        <li class="nav-item"><a class="nav-link" href="/front/about.php">關於我們</a></li>
        <li class="nav-item"><a class="nav-link" href="/front/booking.php">預約</a></li>
        <li class="nav-item"><a class="nav-link active" href="/front/my_booking.php">我的預約</a></li>
      </ul>
      <a href="logout.php" class="btn btn-light btn-sm">登出</a>
    </div>
  </div>
</nav>

<!-- 內容區 -->
<div class="container py-5">
  <h2 class="mb-4" style="color: var(--bs-primary);">我的預約紀錄</h2>

  <?php if (empty($bookings)): ?>
    <div class="alert alert-info">尚無預約紀錄。</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle bg-white">
        <thead style="background-color: var(--bs-primary); color: white;">
          <tr>
            <th>預約時間</th>
            <th>寵物數量</th>
            <th>圖片</th>
            <th>問題描述</th>
            <th>聯絡資訊</th>
            <th>目前狀態</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $b): ?>
            <tr>
              <td><?= htmlspecialchars($b['available_time']); ?></td>
              <td><?= htmlspecialchars($b['pet_count']); ?></td>
              <td class="text-center">
                <?php if (!empty($b['img'])): ?>
                  <img src="/images/<?= htmlspecialchars($b['img']); ?>" class="img-fluid rounded" style="max-height:60px; object-fit:cover;">
                <?php endif; ?>
              </td>
              <td><?= nl2br(htmlspecialchars($b['issue'])); ?></td>
              <td>
                <div>姓名：<?= htmlspecialchars($b['name']); ?></div>
                <div>電話：<?= htmlspecialchars($b['tel']); ?></div>
                <div>LINE：<?= htmlspecialchars($b['line_id']); ?></div>
                <div>地區：<?= htmlspecialchars($b['city']); ?></div>
              </td>
              <td>
                <?php
                  if (!function_exists('statusText')) {
                      function statusText($code) {
                          $map = [0 => '待處理', 1 => '已確認', 2 => '完成', 3 => '取消'];
                          return $map[$code] ?? '未知';
                      }
                  }
                  echo statusText($b['status']);
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<!-- 頁尾 -->
<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">
    © 2025 PurrMedi
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
