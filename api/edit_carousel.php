<?php
include_once "db.php";

$table = $_POST['table'] ?? 'purr_images';
$DB = new DB($table);

// 逐筆處理每筆 id
foreach ($_POST['id'] as $idx => $id) {
    // 如果有勾選刪除
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
        continue;
    }

    // 沒有要刪除就更新資料
    $row = $DB->find($id);

    // 更新文字說明
    $row['text'] = $_POST['text'][$idx];

    // 更新顯示狀態（sh[] 是 checkbox 勾到才有送出）
    $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;

    // 存回
    $DB->save($row);
}

// 修改完回原頁面
to("../backend.php?do=carousel");
