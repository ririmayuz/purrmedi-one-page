<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include_once __DIR__ . "/../api/db.php";

$loggedIn    = !empty($_SESSION['user_id']);
$currentAcc  = $_SESSION['user_acc'] ?? null;
?>
<style>
  .navbar-custom { background-color: #b98e68; }
  .navbar-custom .nav-link, .navbar-custom .navbar-brand { color: #fff; }
  .navbar-custom .nav-link:hover { color: #f5f5f5; }
  .user-avatar {
    width: 28px; height: 28px; border-radius: 50%; font-weight: bold;
    background-color: #f8f9fa; color: #333;
    display: inline-flex; justify-content: center; align-items: center; margin-right: 6px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/index.php">PurrMedi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="切換選單">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/index.php">首頁</a></li>
        <li class="nav-item"><a class="nav-link" href="/front/about.php">關於我們</a></li>
        <?php if ($loggedIn): ?>
          <li class="nav-item"><a class="nav-link" href="/front/my_booking.php">我的預約</a></li>
          <li class="nav-item"><a class="nav-link" href="/front/booking.php">預約</a></li>
        <?php endif; ?>
      </ul>

      <?php if ($loggedIn && $currentAcc): ?>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="user-avatar"><?= strtoupper(substr($currentAcc,0,1)) ?></span>
            Hi, <?= htmlspecialchars($currentAcc) ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li><a class="dropdown-item" href="/front/my_booking.php">我的預約</a></li>
            <li><a class="dropdown-item" href="/front/booking.php">預約</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="/front/logout.php">登出</a></li>
          </ul>
        </div>
      <?php else: ?>
        <div class="d-flex">
          <a href="/front/login.php" class="btn btn-outline-light me-2">登入</a>
          <a href="/front/reg.php" class="btn btn-light text-dark">註冊</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</nav>
