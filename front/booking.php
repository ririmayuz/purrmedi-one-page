<?php
include_once "../api/db.php";
if (empty($_SESSION['user'])) {
  to("login.php");
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
        <li class="nav-item"><a class="nav-link active" href="/front/booking.php">預約</a></li>
      </ul>
      <a href="/front/logout.php" class="btn btn-light btn-sm">登出</a>
    </div>
  </div>
</nav>

<!-- 內容區 -->
<div class="container py-5">
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
        <input type="file" name="img" class="form-control">
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

<!-- 頁尾 -->
<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">
    © 2025 PurrMedi
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
