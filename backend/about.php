<?php
include_once __DIR__ . "/../api/db.php";
// 後台「網站/醫師介紹管理」：新增 + 批次更新
$rows = $About->all(); // purr_about 表
?>

<h3 class="mb-3">網站/醫師介紹管理</h3>

<!-- 新增區 -->
<div class="card mb-4 p-3">
    <h5 class="mb-3">新增一筆介紹</h5>
    <form action="/api/insert.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="table" value="purr_about">

        <div class="mb-2">
            <label class="form-label">主標題 Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">副標題 Subtitle</label>
            <input type="text" name="subtitle" class="form-control">
        </div>

        <!-- 三段標題+內容 -->
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="mb-2">
                <label class="form-label">段落 <?= $i ?> 標題 h<?= $i ?></label>
                <input type="text" name="h<?= $i ?>" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">段落 <?= $i ?> 內文 p<?= $i ?></label>
                <textarea name="p<?= $i ?>" class="form-control" rows="2"></textarea>
            </div>
        <?php endfor; ?>

        <div class="mb-2">
            <label class="form-label">圖片</label>
            <input type="file" name="img" class="form-control">
        </div>

        <button class="btn btn-primary">新增</button>
    </form>
</div>

<!-- 批次更新區 -->
<div class="card p-3">
    <h5 class="mb-3">介紹列表</h5>

    <?php if (empty($rows)): ?>
        <div class="text-muted">尚無介紹資料</div>
    <?php else: ?>
        <form action="/api/edit.php" method="post">
            <input type="hidden" name="table" value="purr_about">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>圖片</th>
                            <th>標題</th>
                            <th>副標題</th>
                            <th colspan="6">內容</th>
                            <th>刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $idx => $row): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row['img'])): ?>
                                        <img src="/images/<?= $row['img'] ?>" style="height:60px;object-fit:cover;border-radius:6px">
                                    <?php endif; ?>
                                </td>
                                <td><input type="text" name="title[]" value="<?= $row['title'] ?>" class="form-control"></td>
                                <td><input type="text" name="subtitle[]" value="<?= $row['subtitle'] ?>" class="form-control"></td>
                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                    <td>
                                        <input type="text" name="h<?= $i ?>[]" value="<?= $row['h' . $i] ?>" class="form-control" placeholder="段落<?= $i ?>標題">
                                        <textarea name="p<?= $i ?>[]" rows="2" class="form-control mt-1" placeholder="段落<?= $i ?>內容"><?= $row['p' . $i] ?></textarea>
                                    </td>
                                <?php endfor; ?>
                                <td class="text-center"><input type="checkbox" name="del[]" value="<?= $row['id'] ?>"></td>
                                <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-success">批次更新</button>
        </form>
    <?php endif; ?>
</div>