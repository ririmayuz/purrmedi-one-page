修改圖片功能，不確定要不要  預留
<form action="/api/update.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="table" value="purr_about">
  <input type="hidden" name="id" value="1">
  <input type="file" name="img" required>
  <button>更換圖片</button>
</form>
