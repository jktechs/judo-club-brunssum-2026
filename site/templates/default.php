<?php snippet("header"); ?>
<article>
  <h1><?= $page->title() ?></h1>
</article>
<article>
  <p><?= $page->text()->kirbytext() ?></p>
</article>
<?php snippet("footer"); ?>
