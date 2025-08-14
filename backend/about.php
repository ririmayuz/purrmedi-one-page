<?php
include_once __DIR__ . "/../api/db.php";
/** 後台「網站/醫師介紹管理」：新增 + 批次更新 */
$rows = $About->all(); // purr_about 表（於 db.php 建立的 DB 物件）
?>

<h3 class="mb-3" style="color: var(--bs-primary);">網站 / 醫師介紹管理</h3>

<!-- 新增區 -->
<div class="card mb-4 shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">新增一筆介紹</h5>

    <form action="/api/insert.php" method="post" enctype="multipart/form-data" class="row g-3">
      <input type="hidden" name="table" value="purr_about">

      <div class="col-12">
        <label class="form-label">主標題 Title</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="col-12">
        <label class="form-label">副標題 Subtitle</label>
        <input type="text" name="subtitle" class="form-control">
      </div>

      <!-- 三段標題+內容 -->
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="col-md-4">
          <label class="form-label">段落 <?= $i ?> 標題 h<?= $i ?></label>
          <input type="text" name="h<?= $i ?>" class="form-control" placeholder="段落<?= $i ?>標題">
        </div>
        <div class="col-md-8">
          <label class="form-label">段落 <?= $i ?> 內文 p<?= $i ?></label>
          <textarea name="p<?= $i ?>" class="form-control" rows="2" placeholder="段落<?= $i ?>內容"></textarea>
        </div>
      <?php endfor; ?>

      <div class="col-md-6">
        <label class="form-label">圖片</label>
        <input type="file" name="img" class="form-control">
        <div class="form-text">建議尺寸 1200×800 (JPG/PNG)</div>
      </div>

      <div class="col-12 text-end">
        <button class="btn btn-primary">新增</button>
      </div>
    </form>
  </div>
</div>

<!-- 批次更新區 -->
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">介紹列表</h5>

    <?php if (empty($rows)): ?>
      <div class="text-muted">尚無介紹資料</div>
    <?php else: ?>
      <form action="/api/edit.php" method="post">
        <input type="hidden" name="table" value="purr_about">

        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle bg-white">
            <thead>
              <tr>
                <th style="min-width:110px;">圖片</th>
                <th style="min-width:180px;">標題</th>
                <th style="min-width:180px;">副標題</th>
                <th colspan="3">內容（h1/p1、h2/p2、h3/p3）</th>
                <th class="text-center" style="min-width:80px;">刪除</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $idx => $row): ?>
                <tr>
                  <td>
                    <?php if (!empty($row['img'])): ?>
                      <img src="/images/<?= htmlspecialchars($row['img']) ?>" class="img-fluid rounded" style="max-height:60px;object-fit:cover">
                    <?php else: ?>
                      <span class="text-muted small">無</span>
                    <?php endif; ?>
                  </td>

                  <td>
                    <input type="text" name="title[]" value="<?= htmlspecialchars($row['title']) ?>" class="form-control">
                  </td>

                  <td>
                    <input type="text" name="subtitle[]" value="<?= htmlspecialchars($row['subtitle']) ?>" class="form-control">
                  </td>

                  <?php for ($i = 1; $i <= 3; $i++): ?>
                    <td style="min-width:260px;">
                      <input type="text" name="h<?= $i ?>[]" value="<?= htmlspecialchars($row['h' . $i]) ?>" class="form-control mb-1" placeholder="段落<?= $i ?>標題">
                      <textarea name="p<?= $i ?>[]" rows="2" class="form-control" placeholder="段落<?= $i ?>內容"><?= htmlspecialchars($row['p' . $i]) ?></textarea>
                    </td>
                  <?php endfor; ?>

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
