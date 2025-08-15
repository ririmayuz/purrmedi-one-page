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

$info  = password_get_info($user['pw'] ?? '');
$valid = $info['algo'] ? password_verify($pw, $user['pw']) : ($pw === $user['pw']);
if (!$valid) {
  echo json_encode(['success' => false, 'msg' => '密碼錯誤']); exit;
}

// ✅ 統一設定 session：用 user_id/user_acc
$_SESSION['user_id']  = (int)$user['id'];
$_SESSION['user_acc'] = (string)$user['acc'];
unset($_SESSION['user']); // 移除舊的，避免混用

// 查是否有預約
$Booking = new DB('purr_booking');
$rows = $Booking->all(['user_id' => $_SESSION['user_id']]);
$hasBooking = is_array($rows) ? count($rows) : 0;

$next = ($hasBooking > 0) ? '/index.php' : '/front/booking.php?first=1';

echo json_encode(['success'=>true,'msg'=>'登入成功','next'=>$next]);
exit;
