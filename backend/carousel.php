<?php
// 後台「首圖輪播管理」：上傳新增 + 列表批次編修
// 依賴：api/db.php 的 $Images 物件、api/insert.php、api/edit_carousel.php
//__DIR__ 取得的是作業系統路徑（絕對路徑）
//以這支檔案為基準往上層的 /api/db.php
// include_once __DIR__ . "/../api/db.php";
// 載入輪播資料（直接 include API）
$rows = include __DIR__ . "/../api/get_carousel.php";


// 取全部輪播資料
$rows = $Images->all(); // purr_images：id, img, text, sh
?>

<h3 class="mb-3">首圖輪播管理</h3>

<!-- 新增區：走共用 insert.php（因為它會處理 name="img" 的上傳並 save($_POST)） -->
<div class="card mb-4 p-3">
    <h5 class="mb-3">新增圖片</h5>
    <form action="/api/insert.php" method="post" enctype="multipart/form-data">
        <!-- 告訴 insert.php：這筆要寫進哪張表 -->
        <input type="hidden" name="table" value="purr_images">
        <div class="mb-2">
            <label class="form-label">圖片檔案</label>
            <input type="file" name="img" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">說明文字（可空白）</label>
            <input type="text" name="text" class="form-control" placeholder="例如：Banner 標題">
        </div>
        <!-- sh 預設 1（顯示）， insert.php 的 switch/預設值若沒處理，可主動送 1 -->
        <input type="hidden" name="sh" value="1">
        <button class="btn btn-primary">新增</button>
    </form>
</div>

<!-- 列表區：批量修改說明、顯示/隱藏、刪除 -->
<div class="card p-3">
    <h5 class="mb-3">圖片列表</h5>

    <?php if (empty($rows)): ?>
        <div class="text-muted">目前沒有輪播圖片，請先新增。</div>
    <?php else: ?>
        <form action="/api/edit_carousel.php" method="post">
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
                                <!-- 讓每一列的 text/sh/del 能對應到正確的 id -->
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