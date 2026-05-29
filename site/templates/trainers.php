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
  <h1>Trainers</h1>
</article>
<div
  style="
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  "
>
  <?php foreach ($page->children()->listed() as $trainer): ?>
    <?php if (
      $trainer->role()->isNotEmpty() &&
      in_array("trainer", $trainer->role()->split())
    ): ?>
      <article
        style="height: fit-content; cursor: pointer;"
        onclick="window.location.href='<?= $trainer->url() ?>';"
      >
        <img
          alt="Portrait of <?= $trainer->name() ?>"
          src="<?= $trainer->content()->image()->toFile()->url() ?>"
          style="width: 18em;"
        />
        <h2><?= $trainer->name() ?></h2>
      </article>
       <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php snippet("footer"); ?>
