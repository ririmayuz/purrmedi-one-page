<?php
// /front/reg.php
include_once __DIR__ . "/../api/db.php";
?>
<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>會員註冊</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once __DIR__ . "/nav.php"; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="bg-white p-4 rounded shadow-sm">
        <h3 class="text-center mb-4" style="color: var(--bs-primary);">建立帳號</h3>

        <div class="mb-3">
          <label class="form-label">帳號</label>
          <input type="text" id="acc" class="form-control" placeholder="請輸入帳號">
        </div>
        <div class="mb-3">
          <label class="form-label">Email（可選）</label>
          <input type="email" id="email" class="form-control" placeholder="you@example.com">
        </div>
        <div class="mb-3">
          <label class="form-label">密碼</label>
          <input type="password" id="pw" class="form-control" placeholder="請輸入密碼（至少 6 碼）">
        </div>

        <div class="d-grid">
          <button onclick="register()" class="btn btn-primary">註冊</button>
        </div>

        <div class="text-center text-muted mt-3">
          已有帳號？<a href="/front/login.php" class="link-primary">前往登入</a>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="py-3 mt-4">
  <div class="container text-center small text-muted">© 2025 PurrMedi</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
async function register() {
  const acc   = document.getElementById("acc").value.trim();
  const pw    = document.getElementById("pw").value.trim();
  const email = document.getElementById("email").value.trim();

  if (!acc || !pw) { alert("請輸入帳號與密碼"); return; }

  try {
    const res = await fetch("../api/reg.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `acc=${encodeURIComponent(acc)}&pw=${encodeURIComponent(pw)}&email=${encodeURIComponent(email)}`
    });

    // 先試著解析 JSON，不行就拿純文字看錯誤
    const text = await res.text();
    let data;
    try { data = JSON.parse(text); } catch { data = { success:false, msg: "非 JSON 回應", raw:text }; }

    console.log("register api resp:", data);

    if (data.success) {
      location.href = data.next || "/front/booking.php?first=1";
    } else {
      alert(data.msg || "註冊失敗" + (data.raw ? "\n" + data.raw : ""));
    }
  } catch (e) {
    console.error(e);
    alert("系統忙碌，請稍後再試");
  }
}
</script>
</body>
</html>
