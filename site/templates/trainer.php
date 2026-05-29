<?php snippet("header"); ?>
<style>
.split {
    display: grid;
    grid-template-columns: auto auto;
    column-gap: 1em;
}
.headshot {
  width: 30vw;
}
@media (max-width: 1203px) {
    .split {
        display: contents;
    }
    .headshot {
      width: 70vw;
    }
}
</style>
<div>
    <article>
      <h1><?= $page->name() ?></h1>
    </article>
    <article class="split">
      <img
        class="headshot"
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
