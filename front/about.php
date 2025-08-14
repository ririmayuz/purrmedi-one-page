<!-- 🐶🐱 About 區塊 -->
  <div id="about" class="about-section row mx-auto">
    <div class="col-md-4 text-center mb-3 mb-md-0">
      <img src="./images/<?= $about['img'] ?>" class="about-img shadow" alt="關於圖片">
    </div>
    <div class="col-md-8">
      <p class="mb-1 small"><?= $about['subtitle'] ?></p>
      <h3 class="mb-3 fw-bold"><?= $about['title'] ?></h3>

      <h5 class="fw-bold"><?= $about['h1'] ?></h5>
      <p><?= nl2br($about['p1']) ?></p>

      <h5 class="fw-bold"><?= $about['h2'] ?></h5>
      <p><?= nl2br($about['p2']) ?></p>

      <h5 class="fw-bold"><?= $about['h3'] ?></h5>
      <p><?= nl2br($about['p3']) ?></p>
    </div>
  </div>
</div>