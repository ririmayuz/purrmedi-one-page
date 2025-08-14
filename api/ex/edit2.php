<?php
include_once "db.php";

$table = $_POST['table'];
$DB = ${ucfirst($table)};

foreach ($_POST['id'] as $idx => $id) {
    // 處理刪除
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
        continue;
    }

    // 找出原資料
    $row = $DB->find($id);

    // 根據 table 名稱，處理欄位更新
    switch ($table) {
        case "purr_images":
            $row['text'] = $_POST['text'][$idx];
            $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
            break;

        case "purr_about":
            $row['title'] = $_POST['title'][$idx];
            $row['subtitle'] = $_POST['subtitle'][$idx];
            // 其他段落欄位（可依需求擴充）
            break;

        case "purr_users":
            $row['acc'] = $_POST['acc'][$idx];
            $row['name'] = $_POST['name'][$idx];
            $row['email'] = $_POST['email'][$idx];
            break;

        // 其他模組請在這裡補上
    }

    // 儲存更新後資料
    $DB->save($row);
}

// 修改完成後回原本模組後台頁面
to("../backend.php?do=$table");
?>
