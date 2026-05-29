<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="<?= url(
      "assets/logo-small.png",
    ) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <meta
      name="description"
      content="A welcoming judo club in Brunssum offering accessible training, workshops, demonstrations, and competitions for all ages and levels. Our focus is on enjoyment, personal development, and introducing as many people as possible to the sport of judo."
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.yellow.min.css"
    />
    <title>
      <?= $page->title() ?> | <?= $site->title() ?>
    </title>
    <style>
      img.logo {
          height: 4em;
          margin: 0.25em;
      }
      img.logo.big {
          display: inline;
      }
      img.logo.small {
          display: none;
      }
      /* defines the color of the dark themed logo. https://angel-rs.github.io/css-color-filter-generator/ with #f2df0d */
      [data-theme="dark"] img.icon {
          filter: brightness(0) saturate(100%) invert(92%) sepia(95%) saturate(4120%)
              hue-rotate(341deg) brightness(93%) contrast(106%);
      }
      img.icon {
          filter: brightness(0);
      }
      nav details.dropdown {
        display: inline-block !important;
      }
      header {
          background-image: url(<?= url("assets/yellow-belt.jpg") ?>);
          border-bottom: 1px solid #000000;
          background-repeat: repeat-y;
          position: sticky;
          top: 0;
      }
      [data-theme="dark"] header {
          background-image: url(<?= url("assets/black-belt.jpg") ?>);
          border-bottom: 1px solid #f2df0d;
      }
      div[data-theme] {
          background-color: var(--pico-background-color);
      }
      nav a {
          margin: 0px;
      }
      a {
          cursor: pointer;
      }
      .social-logo {
          width: 4em;
          padding: 0.5em;
          filter: brightness(0);
      }
      [data-theme="dark"] .social-logo {
          filter: none;
      }
      #menu-button {
          display: none;
          width: 2em;
          height: 2em;
          background-size: 100% 100%;
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='none' stroke='%23f2df0d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath fill='currentColor' d='M4,4 h12 M4,10 h12 M4,16 h12' /%3E%3C/svg%3E");
      }
      #menu-button:checked {
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='none' stroke='%231C212C' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath fill='currentColor' d='M4,4 l12,12 M4,16 l12,-12' /%3E%3C/svg%3E");
      }
      hgroup {
          margin-bottom: 0px;
      }
      @media (max-width: 1203px) {
          img.logo.big {
              display: none;
          }
          img.logo.small {
              display: inline;
          }
          [data-theme="dark"] header {
              border-left: 1px solid #f2df0d;
          }
          header {
            border-left: 1px solid #000000;
            width: 9.5em; /*fit-content;*/
            position: absolute;
            right: 0px;
            top: 0px;
          }
          nav, nav ul {
            flex-direction: column;
          }
          #menu-button {
              display: block;
              position: absolute;
              margin: 0.25em;
              right: 0px;
              top: 0px
          }
          #menu-button:not(:checked) + header {
            display: none;
          }
          #menu-button:checked {
            right: 9.5em;
          }
      }
    </style>
  </head>
  <body>
    <div data-theme="dark">
      <input
        aria-label="Open menu"
        id="menu-button"
        type="checkbox"
        style="z-index: 1;"
      />
      <header>
        <nav style="margin-left: 1em;margin-right: 1em">
          <ul>
            <a href="<?= $site->url() ?>" style="flex-shrink: 0;">
              <img alt="JCB Logo" src="<?= url(
                "assets/logo.png",
              ) ?>" class="logo icon big" />
              <img
                alt="JCB Logo"
                src="<?= url("assets/logo-small.png") ?>"
                class="logo icon small"
              />
            </a>
          </ul>
          <ul>
            <li><a href="<?= $site->url() ?>">Home</a></li>
            <li>
              <a role="button" href="<?= page("error")->url() ?>"
class="secondary outline">
                Agenda
              </a>
            </li>
            <li>
              <a role="button" href="<?= page("error")->url() ?>"
class="secondary outline">
                Contact
              </a>
            </li>
            <li>
              <a role="button" href="<?= page(
                "groups",
              )->url() ?>" class="secondary outline">
                Groups
              </a>
            </li>
            <li>
              <details class="dropdown">
                <summary role="button" class="secondary outline">
                  About us
                </summary>
                <ul dir="rtl">
                  <li>
                    <a href="<?= page("trainers") ?>">Trainers</a>
                  </li>
                  <li>
                    <a href="<?= page("counselors") ?>">Counselors</a>
                  </li>
                  <li>
                    <a href="<?= page("club-rules") ?>">Club rules</a>
                  </li>
                  <li>
                    <a href="<?= page("code-of-conduct") ?>">Code of Conduct</a>
                  </li>
                </ul>
              </details>
            </li>
            <li>
              <a role="button" href="<?= page(
                "downloads",
              )->url() ?>" class="secondary outline">
                Downloads
              </a>
            </li>
            <li>
              <details class="dropdown">
                <summary role="button" class="outline">
                  <img
                    alt="Language dropdown"
                    class="icon"
                    src="<?= url("assets/language.svg") ?>"
                  />
                </summary>
                <ul dir="rtl">
                  <li>
                    <a href="<?= $page->url("en") ?>">English</a>
                    <a href="<?= $page->url("nl") ?>">Dutch</a>
                  </li>
                </ul>
              </details>
            </li>
            <li>
              <details class="dropdown">
                <summary role="button" class="outline">
                  <img
                    alt="Theme dropdown"
                    class="icon"
                    src="<?= url("assets/theme.svg") ?>"
                  />
                </summary>
                <ul dir="rtl">
                  <li>
                    <a onclick="document.body.children[0].dataset.theme = 'dark'">Dark</a>
                    <a onclick="document.body.children[0].dataset.theme = 'light'">Light</a>
                  </li>
                </ul>
              </details>
            </li>
          </ul>
        </nav>
      </header>
      <main class="container">
