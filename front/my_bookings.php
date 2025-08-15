<?php
include_once "../api/db.php";

// 檢查是否登入
if (!isset($_SESSION['user'])) {
    to("login.php"); // 未登入導回登入頁
    exit;
}

$uid = $_SESSION['user'];
$bookings = $Booking->all(['user_id' => $uid]);

// 狀態轉文字
// function statusText($code)
// {
//     $map = [
//         0 => '待處理',
//         1 => '已確認',
//         2 => '完成',
//         3 => '取消'
//     ];
//     return $map[$code] ?? '未知';
// }
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>我的預約紀錄</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4 text-primary">我的預約紀錄</h2>

        <?php if (empty($bookings)): ?>
            <div class="alert alert-info">尚無預約紀錄。</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle bg-white">
                    <thead class="table-primary">
                        <tr>
                            <th>預約時間</th>
                            <th>寵物數量</th>
                            <th>圖片</th>
                            <th>問題描述</th>
                            <th>聯絡資訊</th>
                            <th>目前狀態</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td><?= $b['available_time']; ?></td>
                                <td><?= $b['pet_count']; ?></td>
                                <td>
                                    <?php if (!empty($b['img'])): ?>
                                        <img src="/images/<?= $b['img']; ?>" style="height:60px;border-radius:6px;object-fit:cover">
                                    <?php endif; ?>
                                </td>
                                <td><?= nl2br($b['issue']); ?></td>
                                <td>
                                    姓名：<?= $b['name']; ?><br>
                                    電話：<?= $b['tel']; ?><br>
                                    LINE：<?= $b['line_id']; ?><br>
                                    地區：<?= $b['city']; ?>
                                </td>
                                <td><?= statusText($b['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
