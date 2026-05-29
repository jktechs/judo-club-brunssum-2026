<?php snippet("header"); ?>
<style>
* {
    --pico-table-border-color: #000;
}
[data-theme="dark"] * {
    --pico-table-border-color: #fff;
}
thead th {
    --pico-border-width: 1px !important;
}
@media (max-width: 1203px) {
    table,
    tbody {
        display: contents;
        border-top: var(--pico-border-width) solid
            var(--pico-table-border-color);
        border-bottom: var(--pico-border-width) solid
            var(--pico-table-border-color);
    }
    thead {
        display: none;
    }
    td {
        display: block;
        border-bottom: 0px;
        border-top: 0px;
    }
    tr {
        display: block;
        border-bottom: var(--pico-border-width) solid
            var(--pico-table-border-color);
    }
    td::before {
        content: attr(data-label);
        margin-right: 1em;
        font-weight: bold;
    }
}
</style>
<article>
  <h1><?= $page->title() ?></h1>
</article>
<article>
  <p><?= $page->text()->kirbytext() ?></p>
  <table>
    <thead>
      <tr>
        <th><?= t("name") ?></th>
        <th><?= t("description") ?></th>
        <th><?= t("price") ?></th>
        <th><?= t("lesson-times") ?></th>
      </tr>
    </thead>
    <tbody>
        <?php $defaults = $page->content("default")->groups()->toStructure(); ?>
        <?php foreach ($page->groups()->toStructure() as $i => $group): ?>
          <tr>
            <td data-label="<?= t("name") ?>">
              <?= $group->name()->html() ?>
            </td>
            <td
              data-label="<?= t("description") ?>"
            >
              <?= $group->desc()->html() ?>
            </td>
            <td data-label="<?= t("price") ?>">
              € <?= $defaults->nth($i)->price()->toFloat() ?>
            </td>
            <td
              data-label="<?= t("lesson-times") ?>"
            >
              <p>
                <?= t("monday") ?>
                <?= $defaults->nth($i)->monday_start()->toDate("H:i") ?>
                -
                <?= $defaults->nth($i)->monday_end()->toDate("H:i") ?>
                Mat:
                <?= $defaults->nth($i)->monday_mat() ?>
              </p>
              <p>
                <?= t("saturday") ?>
                <?= $defaults->nth($i)->saturday_start()->toDate("H:i") ?>
                -
                <?= $defaults->nth($i)->saturday_end()->toDate("H:i") ?>
                Mat:
                <?= $defaults->nth($i)->saturday_mat() ?>
              </p>
            </td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</article>
<?php snippet("footer"); ?>
