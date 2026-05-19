<?php foreach ($page->children()->listed() as $trainer): ?>
  <a href="<?= $trainer->url() ?>">
    <?= $page->bio()->kirbytext() ?>
  </a>
<?php endforeach; ?>
