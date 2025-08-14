<?php
include_once __DIR__ . "/../api/db.php";

// 撈出所有預約紀錄，最新在最上
$rows = $Booking->all('', ' ORDER BY created_at DESC');

// 狀態選項
$statusOptions = [
    0 => '待處理',
    1 => '已確認',
    2 => '完成',
    3 => '取消'
];
?>

<h3 class="mb-3">預約紀錄管理</h3>

<?php if (empty($rows)): ?>
    <div class="text-muted">目前沒有預約紀錄。</div>
<?php else: ?>
    <form action="/api/edit.php" method="post">
        <input type="hidden" name="table" value="purr_booking">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>會員資訊</th>
                        <th>預約細節</th>
                        <th>問題與圖片</th>
                        <th>狀態</th>
                        <th>建立時間</th>
                        <th>刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $idx => $row): ?>
                        <tr>
                            <td>
                                <?= $row['name']; ?><br>
                                <?= $row['email']; ?><br>
                                <?= $row['tel']; ?><br>
                                <?= $row['line_id']; ?><br>
                                <?= $row['city']; ?>
                            </td>
                            <td>
                                預約時間：<?= $row['available_time']; ?><br>
                                寵物數量：<?= $row['pet_count']; ?>
                            </td>
                            <td>
                                <?= nl2br($row['issue']); ?><br>
                                <?php if (!empty($row['img'])): ?>
                                    <img src="/images/<?= $row['img']; ?>" style="height:60px;object-fit:cover;border-radius:6px">
                                <?php endif; ?>
                            </td>
                            <td>
                                <select name="status[]">
                                    <?php foreach ($statusOptions as $code => $text): ?>
                                        <option value="<?= $code; ?>" <?= ($row['status'] == $code) ? 'selected' : ''; ?>>
                                            <?= $text; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><?= $row['created_at']; ?></td>
                            <td class="text-center">
                                <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                                <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-success">批次更新</button>
    </form>
<?php endif; ?>