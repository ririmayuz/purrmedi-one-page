<?php include_once "../api/db.php"; ?>
<h3>會員登入</h3>

<div>
  <label>帳號</label>
  <input type="text" id="acc">
</div>
<div>
  <label>密碼</label>
  <input type="password" id="pw">
</div>
<button onclick="login()">登入</button>

<script>
function login() {
  const acc = document.getElementById("acc").value;
  const pw = document.getElementById("pw").value;

  fetch("../api/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `acc=${acc}&pw=${pw}`
  })
  .then(res => res.json())
  .then(result => {
    
    console.log(result); // ✅ 這裡會出現在 Console
    if (result.success) {
      location.href = "booking.php"; // 或導向你想跳的頁
    } else {
      alert(result.msg);
    }
  });
}
</script>
