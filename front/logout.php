<?php
session_start(); // 確保能操作 session

// 清除所有 session 變數
$_SESSION = [];

// 清除 session cookie（如果有設定）
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 銷毀 session
session_destroy();

// 導回根目錄首頁
header("Location: /index.php");
exit;
