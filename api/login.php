<?php
// /api/login.php
include_once __DIR__ . "/db.php";
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'msg' => 'Invalid request']); exit;
}

$acc = $_POST['acc'] ?? '';
$pw  = $_POST['pw']  ?? '';

$Users = new DB('purr_users');
$user  = $Users->find(['acc' => $acc]);

if (!$user) {
  echo json_encode(['success' => false, 'msg' => '帳號不存在']); exit;
}

// 密碼驗證（支援雜湊與明碼）
$valid = false;
if (isset($user['pw'])) {
  $info = password_get_info($user['pw']);
  $valid = $info['algo'] ? password_verify($pw, $user['pw']) : ($pw === $user['pw']);
}
if (!$valid) {
  echo json_encode(['success' => false, 'msg' => '密碼錯誤']); exit;
}

// 登入成功
$_SESSION['user'] = (int)$user['id'];

// 查是否有預約紀錄（撈陣列再 count，最穩）
$Booking = new DB('purr_booking');
$rows = $Booking->all(['user_id' => $_SESSION['user']]);
$hasBooking = is_array($rows) ? count($rows) : 0;

// 規則：有單回首頁；沒單到預約並顯示警告
$next = ($hasBooking > 0) ? '/index.php' : '/front/booking.php?first=1';

echo json_encode([
  'success' => true,
  'msg'     => '登入成功',
  'next'    => $next
]);
exit;
