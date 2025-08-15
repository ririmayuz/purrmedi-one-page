<?php
include_once "../api/db.php";

// 取得目前登入者 ID（優先用 user_id，相容舊的 user）
$uid = null;
if (!empty($_SESSION['user_id'])) {
    $uid = (int)$_SESSION['user_id'];
} elseif (!empty($_SESSION['user'])) {
    $uid = (int)$_SESSION['user']; // 舊的相容處理
}

if (!$uid) {
    to("login.php");
    exit;
}

// 建立 DB 物件
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

<?php include_once __DIR__ . "/nav.php"; ?>

<div class="container py-5">
  <h2 class="mb-4" style="color: var(--bs-primary);">我的預約紀錄</h2>

  <?php if (empty($bookings)): ?>
    <div class="alert alert-info">尚無預約紀錄。</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered align-middle bg-white shadow-sm rounded">
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
              <td>
                <?php if (!empty($b['img'])): ?>
                  <img src="/images/<?= htmlspecialchars($b['img']); ?>" style="height:60px;border-radius:6px;object-fit:cover">
                <?php endif; ?>
              </td>
              <td><?= nl2br(htmlspecialchars($b['issue'])); ?></td>
              <td>
                姓名：<?= htmlspecialchars($b['name']); ?><br>
                電話：<?= htmlspecialchars($b['tel']); ?><br>
                LINE：<?= htmlspecialchars($b['line_id']); ?><br>
                地區：<?= htmlspecialchars($b['city']); ?>
              </td>
              <td><?= statusText($b['status']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">© 2025 PurrMedi</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
