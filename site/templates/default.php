<?php snippet("header"); ?>
<article>
  <h1><?= $page->title() ?></h1>
</article>
<article>
  <?= $page->text()->kirbytext() ?>
</article>
<?php snippet("footer"); ?>
