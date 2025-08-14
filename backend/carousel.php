<?php
include_once __DIR__ . "/../api/db.php";

/** 首圖輪播管理 */
$Images = isset($Images) ? $Images : new DB('purr_images');
$rows   = $Images->all();  // 你也可以加條件：all(['sh'=>1])
?>
<h3 class="mb-3" style="color: var(--bs-primary);">首圖輪播管理</h3>

<!-- 新增區 -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">新增輪播圖</h5>
        <form action="/api/insert.php" method="post" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="table" value="purr_images">
            <div class="col-md-6">
                <label class="form-label">圖片</label>
                <input type="file" name="img" class="form-control" required>
                <div class="form-text">建議 1920×800，JPG/PNG</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">圖片說明（可選）</label>
                <input type="text" name="text" class="form-control" placeholder="顯示於輪播圖上的文字">
            </div>
            <div class="col-12 text-end">
                <button class="btn btn-primary">新增</button>
            </div>
        </form>
    </div>
</div>

<!-- 列表/批次更新 -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">輪播圖列表</h5>
        <?php if (empty($rows)): ?>
            <div class="text-muted">尚無輪播圖</div>
        <?php else: ?>
            <form action="/api/edit_carousel.php" method="post">
                <input type="hidden" name="table" value="purr_images">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle bg-white">
                        <thead>
                            <tr>
                                <th>預覽</th>
                                <th>說明文字</th>
                                <th class="text-center">顯示</th>
                                <th class="text-center">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td style="min-width:160px;">
                                        <?php if (!empty($row['img'])): ?>
                                            <img src="/images/<?= htmlspecialchars($row['img']) ?>" class="img-fluid rounded" style="max-height:80px;object-fit:cover">
                                        <?php else: ?>
                                            <span class="text-muted small">無圖片</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="text[]" value="<?= htmlspecialchars($row['text'] ?? '') ?>" class="form-control" placeholder="圖片說明">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="sh[]" value="<?= (int)$row['id'] ?>" <?= !empty($row['sh']) ? 'checked' : '' ?>>
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