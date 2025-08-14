<?php
include_once __DIR__ . "/db.php";

$table = $_POST['table'] ?? '';
if ($table == '') exit("no table");

$DB = new DB($table);

// 批次處理每一筆 id 對應的資料
foreach ($_POST['id'] as $idx => $id) {

    // 🗑️ 如果有勾選刪除
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
        continue;
    }

    // 🔄 找到原資料
    $row = $DB->find($id);

    // 🧩 自動更新所有欄位（有送的欄位才更新）
    foreach ($_POST as $key => $valArr) {
        if (is_array($valArr) && $key != 'id' && $key != 'del' && $key != 'sh' && isset($valArr[$idx])) {
            $row[$key] = $valArr[$idx];
        }
    }

    // ✅ 額外處理 checkbox 顯示狀態（sh[]）
    if (isset($_POST['sh'])) {
        $row['sh'] = in_array($id, $_POST['sh']) ? 1 : 0;
    }

    $DB->save($row);
}

to("../backend.php?do=" . redirectDo($table));

