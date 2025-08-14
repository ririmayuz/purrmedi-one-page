<?php
// 後台「首圖輪播管理」：上傳新增 + 列表批次編修
// 依賴：api/db.php 的 $Images 物件、api/insert.php、api/edit.php
$rows = $Images->all(); // purr_images：id, img, text, sh
?>

<h3 class="mb-3">首圖輪播管理</h3>

<!-- 新增區：走共用 insert.php（會處理圖片上傳並呼叫 save($_POST)） -->
<div class="card mb-4 p-3">
    <h5 class="mb-3">新增圖片</h5>
    <form action="/api/insert.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="table" value="purr_images">
        <div class="mb-2">
            <label class="form-label">圖片檔案</label>
            <input type="file" name="img" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">說明文字（可空白）</label>
            <input type="text" name="text" class="form-control" placeholder="例如：Banner 標題">
        </div>
        <input type="hidden" name="sh" value="1">
        <button class="btn btn-primary">新增</button>
    </form>
</div>

<!-- 批次編修區 -->
<div class="card p-3">
    <h5 class="mb-3">圖片列表</h5>

    <?php if (empty($rows)): ?>
        <div class="text-muted">目前沒有輪播圖片，請先新增。</div>
    <?php else: ?>
        <form action="/api/edit.php" method="post">
            <input type="hidden" name="table" value="purr_images">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="120">預覽</th>
                            <th>說明文字</th>
                            <th width="100">顯示</th>
                            <th width="80">刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $idx => $row): ?>
                            <tr>
                                <td>
                                    <img src="/images/<?= $row['img'] ?>" alt="" style="height:60px;object-fit:cover;border-radius:6px">
                                </td>
                                <td>
                                    <input type="text" name="text[]" value="<?= $row['text'] ?>" class="form-control">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>" <?= $row['sh'] ? 'checked' : '' ?>>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">
                                </td>
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
