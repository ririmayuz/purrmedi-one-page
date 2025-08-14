<?php include_once "../api/db.php"; ?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>會員登入</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!-- 導覽列 -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/index.php">PurrMedi</a>
  </div>
</nav>

<!-- 登入表單區 -->
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="bg-white p-4 rounded shadow-sm">
        <h3 class="text-center mb-4" style="color: var(--bs-primary);">會員登入</h3>
        
        <div class="mb-3">
          <label class="form-label">帳號</label>
          <input type="text" id="acc" class="form-control" placeholder="請輸入帳號">
        </div>
        <div class="mb-3">
          <label class="form-label">密碼</label>
          <input type="password" id="pw" class="form-control" placeholder="請輸入密碼">
        </div>
        <div class="d-grid">
          <button onclick="login()" class="btn btn-primary">登入</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 頁尾 -->
<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">
    © 2025 PurrMedi
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function login() {
  const acc = document.getElementById("acc").value.trim();
  const pw = document.getElementById("pw").value.trim();

  if (!acc || !pw) {
    alert("請輸入帳號與密碼");
    return;
  }

  fetch("../api/login.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `acc=${encodeURIComponent(acc)}&pw=${encodeURIComponent(pw)}`
  })
  .then(res => res.json())
  .then(result => {
    if (result.success) {
      location.href = "booking.php"; 
    } else {
      alert(result.msg);
    }
  });
}
</script>
</body>
</html>
