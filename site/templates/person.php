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
    <div class="split">
      <div>
      <article>
      <img
        class="headshot"
        alt="Portrait of <?= $page->name() ?>"
        src="<?= $page->content()->foto()->toFile()->crop(800, 1000)->url() ?>"
        style="marginBottom: var(--pico-block-spacing-vertical);"
      />
      </article>
      </div>
      <div>
        <article>
          <?php if ($page->contact()->isNotEmpty()): ?>
            <div style="display: flex; gap: 10px;">
              <p style="display: inline">Contact:</p>
              <?= $page->contact()->kirbytext() ?>
            </div>
          <?php endif ?>
          <p><?= t("roles") ?>: <?= implode(', ', array_map(fn ($role) => t(trim($role)), $page->role()->split())) ?></p>
        </article>
        <article>
          <?= $page->bio()->kirbytext() ?>
        </article>
      </div>
    </div>
</div>
<?php snippet("footer"); ?>
