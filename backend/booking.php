<?php
// /backend/booking.php
include_once __DIR__ . "/../api/db.php";

// 取資料
$Booking = new DB('purr_booking');
$rows = $Booking->all();  // 你的 DB 類別已支援條件陣列；這裡取全部
if (is_array($rows)) {
  usort($rows, function($a,$b){ return (int)$b['id'] <=> (int)$a['id']; }); // 依 id DESC
}

// 狀態對照（避免與 db.php 內相同函式重複宣告）
$statusMap = [ 0=>'待處理', 1=>'已確認', 2=>'完成', 3=>'取消' ];
function status_text_local($code){ global $statusMap; return $statusMap[$code] ?? '未知'; }
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h3 class="mb-0">預約管理</h3>
</div>

<?php if (empty($rows)): ?>
  <div class="alert alert-info">目前尚無任何預約資料。</div>
<?php else: ?>
  <form action="/api/edit.php" method="post">
    <input type="hidden" name="table" value="purr_booking">

    <div class="table-responsive">
      <table class="table align-middle bg-white shadow-sm rounded overflow-hidden">
        <thead style="background-color: var(--bs-primary); color:#fff;">
          <tr>
            <th style="width:90px;">ID</th>
            <th>預約時間帶</th>
            <th>飼主 / 聯絡</th>
            <th>地區 / 毛孩數</th>
            <th>問題描述</th>
            <th>圖片</th>
            <th style="width:140px;">狀態</th>
            <th style="width:70px;" class="text-center">刪除</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td>
                <div class="fw-semibold">#<?= (int)$r['id'] ?></div>
                <div class="text-muted small"><?= htmlspecialchars($r['created_at'] ?? '') ?></div>
                <input type="hidden" name="id[]" value="<?= (int)$r['id'] ?>">
              </td>

              <td><?= htmlspecialchars($r['available_time']) ?></td>

              <td>
                <div>姓名：<?= htmlspecialchars($r['name']) ?></div>
                <div>電話：<?= htmlspecialchars($r['tel']) ?></div>
                <?php if(!empty($r['email'])): ?>
                  <div>Email：<?= htmlspecialchars($r['email']) ?></div>
                <?php endif; ?>
                <?php if(!empty($r['line_id'])): ?>
                  <div>LINE：<?= htmlspecialchars($r['line_id']) ?></div>
                <?php endif; ?>
              </td>

              <td>
                <div>地區：<?= htmlspecialchars($r['city']) ?></div>
                <div>毛孩數：<?= htmlspecialchars($r['pet_count']) ?></div>
              </td>

              <td class="small" style="max-width:320px;">
                <?= nl2br(htmlspecialchars($r['issue'])) ?>
              </td>

              <td>
                <?php if(!empty($r['img'])): ?>
                  <a href="/images/<?= htmlspecialchars($r['img']) ?>" target="_blank">
                    <img src="/images/<?= htmlspecialchars($r['img']) ?>" alt="" style="height:64px;width:64px;object-fit:cover;border-radius:8px;">
                  </a>
                <?php endif; ?>
              </td>

              <td>
                <select name="status[]" class="form-select form-select-sm">
                  <?php foreach($statusMap as $k=>$text): ?>
                    <option value="<?= $k ?>" <?= ((string)$r['status'] === (string)$k?'selected':'') ?>>
                      <?= $text ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>

              <td class="text-center">
                <input type="checkbox" name="del[]" value="<?= (int)$r['id'] ?>">
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-success">批次更新</button>
    </div>
  </form>
<?php endif; ?>

<!-- 小提示 -->
<div class="text-muted small mt-3">
  提示：修改狀態後按「批次更新」；打勾「刪除」可一次刪多筆。
</div>
