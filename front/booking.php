<?php
include_once "../api/db.php";

// 若未登入，導回登入頁
if (empty($_SESSION['user'])) {
  to("login.php");
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <title>預約表單</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="text-primary mb-4">🐾 毛孩視訊預約</h2>

  <form action="../api/insert.php" method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
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

</body>
</html>
