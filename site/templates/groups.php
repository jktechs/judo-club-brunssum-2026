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
    }
}
</style>
<article>
  <h1>Groups</h1>
</article>
<article>
  <p>
    Hieronder vind je de lestijden en de groepsindeling. De leeftijden
    die genoemd staan, zijn grove richtlijnen. De daadwerkelijke
    indeling wordt door de trainers op individuele basis gemaakt, om
    ervoor te zorgen dat iedereen op zijn/haar eigen niveau kan trainen
    en voldoende uitgedaagd wordt.
  </p>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Timeslots</th>
      </tr>
    </thead>
    <tbody>
        <?php $defaults = $page->content("default")->groups()->toStructure(); ?>
        <?php foreach ($page->groups()->toStructure() as $i => $group): ?>
          <tr>
            <td data-label="Name">
              <?= $group->name()->html() ?>
            </td>
            <td
              data-label="Description"
            >
              <?= $group->desc()->html() ?>
            </td>
            <td data-label="Price">
              € <?= $defaults->nth($i)->price()->toFloat() ?>
            </td>
            <td
              data-label="Timeslots"
            >
              <p>
                Monday
                <?= $defaults->nth($i)->monday_start()->toDate("H:i") ?>
                -
                <?= $defaults->nth($i)->monday_end()->toDate("H:i") ?>
              </p>
              <p>
                Saturday
                <?= $defaults->nth($i)->saturday_start()->toDate("H:i") ?>
                -
                <?= $defaults->nth($i)->saturday_end()->toDate("H:i") ?>
              </p>
            </td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <p>
    Daarnaast bieden we gratis aanvullende trainingen in de vorm van
    wedstrijdtraining voor onze jeugd en conditie-/krachttraining voor
    onze senioreleden. Heb je interesse in één van deze trainingen,
    vraag dan even aan je leraar of het geschikt voor je is.
  </p>
</article>
<?php snippet("footer"); ?>
