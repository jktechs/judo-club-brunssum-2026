<?php snippet("header"); ?>
<style>
.split {
    display: grid;
    grid-template-columns: auto auto;
    column-gap: 1em;
}
@media (max-width: 1203px) {
    .split {
        display: contents;
    }
}
</style>
<div>
    <article>
      <h1><?= $page->name() ?></h1>
    </article>
    <article class="split">
      <img
        alt="Portrait of <?= $page->name() ?>"
        src="<?= $page->content()->image()->toFile()->url() ?>"
        style="marginBottom: var(--pico-block-spacing-vertical);"
      />
      <div>
        <?= $page->bio()->kirbytext() ?>
      </div>
    </article>
</div>
<?php snippet("footer"); ?>
