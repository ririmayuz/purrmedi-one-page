<?php
// /api/reg.php  （如果你檔名是 register_simple.php，就貼到那支）
include_once __DIR__ . "/db.php";
header('Content-Type: application/json; charset=utf-8');

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success'=>false,'msg'=>'Invalid request method']); exit;
  }

  $acc   = trim($_POST['acc']   ?? '');
  $pw    = trim($_POST['pw']    ?? '');
  $email = trim($_POST['email'] ?? '');

  if ($acc === '' || $pw === '') {
    echo json_encode(['success'=>false,'msg'=>'請輸入帳號與密碼']); exit;
  }
  if (strlen($pw) < 6) {
    echo json_encode(['success'=>false,'msg'=>'密碼至少 6 碼']); exit;
  }

  $Users = new DB('purr_users');
  if ($Users->find(['acc' => $acc])) {
    echo json_encode(['success'=>false,'msg'=>'帳號已被使用']); exit;
  }

  $hash  = password_hash($pw, PASSWORD_DEFAULT);
  $newId = $Users->save([
    'acc'        => $acc,
    'pw'         => $hash,
    'created_at' => date('Y-m-d H:i:s'),
  ]);

  if (empty($newId) || !is_numeric($newId)) {
    $row = $Users->find(['acc' => $acc]);
    if (is_array($row) && !empty($row['id'])) $newId = (int)$row['id'];
  }
  if (empty($newId) || !is_numeric($newId)) {
    echo json_encode(['success'=>false,'msg'=>'註冊失敗（寫入帳號時發生問題）']); exit;
  }

  if ($email !== '') {
    $Profiles = new DB('purr_user_profile');
    $Profiles->save([
      'user_id' => (int)$newId,
      'email'   => $email,
    ]);
  }

  // ✅ 統一設定 session：用 user_id/user_acc
  $_SESSION['user_id']  = (int)$newId;
  $_SESSION['user_acc'] = $acc;
  unset($_SESSION['user']); // 移除舊的，避免混用

  echo json_encode([
    'success' => true,
    'msg'     => '註冊成功',
    'next'    => '/front/booking.php?first=1'
  ]);
  exit;

} catch (Throwable $e) {
  error_log('[reg.php] ' . $e->getMessage());
  echo json_encode(['success'=>false, 'msg'=>'系統錯誤：'.$e->getMessage()]);
  exit;
}
