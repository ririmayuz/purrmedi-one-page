<?php
include_once __DIR__ . "/db.php";


$table = $_POST['table'] ?? '';
if ($table == '') exit("no table");

$DB = new DB($table);

// ✅ 圖片上傳處理（可選）
$filename = uploadImage();
if ($filename) $_POST['img'] = $filename;

// ✅ 補預設欄位（不會覆蓋原本送過來的）
$_POST = array_merge(getDefaultFields($table), $_POST);

switch ($table) {
  case "purr_booking":
    $_POST['user_id'] = $_SESSION['user'];
    $DB->save($_POST);

    // ✅ 自動補個資表
    $Profile = new DB('purr_user_profile');
    $uid = $_SESSION['user'];
    $exist = $Profile->find(['user_id' => $uid]);
    $profileData = [
      'user_id' => $uid,
      'name' => $_POST['name'] ?? null,
      'tel' => $_POST['tel'] ?? null,
      'line_id' => $_POST['line_id'] ?? null,
      'city' => $_POST['city'] ?? null
    ];
    if ($exist) $profileData['id'] = $exist['id'];
    $Profile->save($profileData);

    // 跳轉
    to("../backend.php?do=" . redirectDo($table));
    break;
}

// ✅ 其他資料表共用 save
unset($_POST['table']);
$DB->save($_POST);

// ✅ 跳轉頁面
to("../backend.php?do=" . redirectDo($table));
