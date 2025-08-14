<?php
include_once __DIR__ . "/../api/db.php";

/** 會員列表 */
$Users = isset($Users) ? $Users : new DB('purr_users');
$rows  = $Users->all(" ORDER BY id DESC ");
?>
<h3 class="mb-3" style="color: var(--bs-primary);">會員列表</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <?php if (empty($rows)): ?>
            <div class="text-muted">目前尚無會員。</div>
        <?php else: ?>
            <form action="/api/edit.php" method="post">
                <input type="hidden" name="table" value="purr_users">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle bg-white">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>帳號</th>
                                <th>Email</th>
                                <th>建立時間</th>
                                <th class="text-center">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td style="min-width:80px;"><?= (int)$row['id'] ?></td>
                                    <td style="min-width:180px;">
                                        <input type="text" name="acc[]" value="<?= htmlspecialchars($row['acc'] ?? '') ?>" class="form-control">
                                    </td>
                                    <td style="min-width:220px;">
                                        <input type="email" name="email[]" value="<?= htmlspecialchars($row['email'] ?? '') ?>" class="form-control">
                                    </td>
                                    <td style="min-width:180px;">
                                        <?= htmlspecialchars($row['created_at'] ?? '') ?>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="del[]" value="<?= (int)$row['id'] ?>">
                                    </td>

                                    <input type="hidden" name="id[]" value="<?= (int)$row['id'] ?>">
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">批次更新</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>