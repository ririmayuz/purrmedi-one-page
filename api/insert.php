<?php
// /api/insert.php
include_once __DIR__ . "/db.php";

// 1) 取得資料表名
$table = $_POST['table'] ?? '';
if ($table === '') exit("No table specified.");

// 2) 初始化 DB 物件
$DB = new DB($table);

// 3) 上傳圖片欄位處理（如果有上傳）
$filename = uploadImage(); // 成功會回傳檔名，失敗回 false
if ($filename) {
  $_POST['img'] = $filename;
}

// 4) 補上預設欄位（不會覆蓋已存在的 $_POST 欄位）
$_POST = array_merge(getDefaultFields($table), $_POST);

// 5) 移除不屬於資料表的欄位
unset($_POST['table']); // 不要把 table 欄位也存進資料表

// --------------------------------------------
// 6) 特殊處理：purr_booking 預約邏輯
// --------------------------------------------
if ($table === 'purr_booking') {

  // 未登入 → 導回登入頁
  if (empty($_SESSION['user_id'])) {
    to("../front/login.php");
    exit;
  }

  $uid = (int)$_SESSION['user_id'];

  // （權威來源）後端強制寫入 user_id，避免被前端竄改
  $_POST['user_id'] = $uid;

  // 儲存預約資料
  $DB->save($_POST);

  // 自動補/更新個資表（purr_user_profile）
  $Profile = new DB('purr_user_profile');
  $exist   = $Profile->find(['user_id' => $uid]);

  $profileData = [
    'user_id' => $uid,
    'name'    => $_POST['name']    ?? null,
    'tel'     => $_POST['tel']     ?? null,
    'line_id' => $_POST['line_id'] ?? null,
    'city'    => $_POST['city']    ?? null,
    // 如果你的 profile 有 email 欄位、且表單有提供，可一併補上
    // 'email'   => $_POST['email']   ?? null,
  ];

  // 有就更新、沒有就新增
  if ($exist) {
    $profileData['id'] = $exist['id'];
  }
  $Profile->save($profileData);

  // 成功 → 導回「我的預約」頁面（避免 F5 重送）
  to("../front/my_booking.php");
  exit; // ✅ 不要往下執行共用 save
}

// --------------------------------------------
// 7) 其他一般資料表：共用 save 流程
// --------------------------------------------
$DB->save($_POST);

// 8) 導回後台該功能頁（例如 ?do=carousel）
to("../backend.php?do=" . redirectDo($table));
exit;
