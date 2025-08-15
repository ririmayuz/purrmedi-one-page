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
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>毛孩視訊預約</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once __DIR__ . "/nav.php"; ?>

<div class="container py-5">

  <!-- ✅ 首次註冊／登入且無紀錄時顯示提醒：/front/booking.php?first=1 -->
  <?php if (isset($_GET['first']) && $_GET['first'] === '1'): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>歡迎加入！</strong> 您目前尚無任何預約紀錄，請先填寫以下表單完成預約。
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <h2 class="mb-4" style="color: var(--bs-primary);">🐾 毛孩視訊預約</h2>

  <form action="../api/insert.php" method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    <input type="hidden" name="table" value="purr_booking">

    <div class="row g-3">
      <!-- 基本資料 -->
      <div class="col-md-6">
        <label class="form-label">飼主姓名 *</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Email *</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">電話 *</label>
        <input type="tel" name="tel" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">LINE ID</label>
        <input type="text" name="line_id" class="form-control">
      </div>

      <div class="col-md-6">
        <label class="form-label">居住地</label>
        <input type="text" name="city" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">飼養毛孩數量</label>
        <input type="number" name="pet_count" class="form-control" min="1" max="10">
      </div>

      <!-- 預約資訊 -->
      <div class="col-md-6">
        <label class="form-label">方便預約的時段</label>
        <select name="available_time" class="form-select">
          <option value="早上">早上</option>
          <option value="下午">下午</option>
          <option value="晚上">晚上</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">圖片（可選）</label>
        <input type="file" name="img" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
      </div>

      <div class="col-12">
        <label class="form-label">簡述想諮詢的問題</label>
        <textarea name="issue" class="form-control" rows="3"></textarea>
      </div>
    </div>

    <div class="mt-4 text-end">
      <button type="submit" class="btn btn-primary px-4">送出預約</button>
    </div>
  </form>
</div>

<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">© 2025 PurrMedi</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
