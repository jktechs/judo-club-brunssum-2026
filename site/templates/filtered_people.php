<?php snippet("header"); ?>
<!--<style>
.split {
    display: grid;
    grid-template-columns: auto auto;
}
@media (max-width: 1203px) {
    .split {
        display: contents;
    }
}
</style>-->
<article>
  <h1><?= $page->title() ?></h1>
</article>
<?php if ($page->text()->isNotEmpty()): ?>
  <article>
    <?= $page->text()->kirbytext() ?>
  </article>
<?php endif ?>
<div
  style="
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  "
>
  <?php foreach (page("people")->children()->listed() as $trainer): ?>
  <?php if (
    $trainer->role()->isNotEmpty() &&
    in_array($page->role(), $trainer->role()->split())
  ): ?>
      <article
        style="height: fit-content; cursor: pointer;"
        onclick="window.location.href='<?= $trainer->url() ?>';"
      >
        <img
          alt="Portrait of <?= $trainer->name() ?>"
          src="<?= $trainer->content()->foto()->toFile()->crop(400, 500)->url() ?>"
          style="width: 100%;"
        />
        <h2 style="margin-bottom: 0.2em;margin-top: 0.2em"><?= $trainer->name() ?></h2>
        <p style="margin-bottom: 0px">
          <?= implode(', ', array_map(fn ($role) => t(trim($role)), $trainer->role()->split())) ?>
        </p>
        <?= $trainer->contact()->kirbytext() ?>
      </article>
      <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php snippet("footer"); ?>
