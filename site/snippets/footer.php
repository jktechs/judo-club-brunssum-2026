      </main>
      <footer class="container">
        <!--<article>
          <p>This site is under development. If something can't be found or accessed go to <a href="http://old.judoclubbrunssum.nl">the old site</a>.</p>
        </article>-->
        <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
          <article>
            <hgroup>
              <h6>Social media</h6>
              <a href="https://www.facebook.com/JCBrunssum/">
                <img
                  alt="Facebook link"
                  class="social-logo"
                  src="<?= url("assets/facebook.svg") ?>"
                />
              </a>
              <a href="https://www.instagram.com/judoclub_brunssum/">
                <img
                  alt="Instagram link"
                  class="social-logo"
                  src="<?= url("assets/instagram.svg") ?>"
                />
              </a>
              <a href="<?= page("whatsapp") ?>">
                <img
                  alt="Whatsapp info"
                  class="social-logo"
                  src="<?= url("assets/whatsapp.svg") ?>"
                />
              </a>
            </hgroup>
          </article>
          <article>
            <hgroup>
              <h6>Contact <?= t("information") ?></h6>
              <p>
                Regentessestraat 47, 6441 GD Brunssum
                <br />
                <?= t("phone_number") ?>:
                <a aria-label="Contact phone number" href="tel:0031622433444">
                  06 - 22 43 34 44
                </a>
                <br />
                Email:
                <a
                  aria-label="Contact email"
                  href="mailto:info@judoclubbrunssum.n"
                >
                  info@judoclubbrunssum.nl
                </a>
              </p>
            </hgroup>
          </article>
          <article>
            <hgroup>
              <h6><?= t("location") ?> <?= t("information") ?></h6>
              <p>
                Heugerstraat 2A, 6443 BS Brunssum
                <br />
                <?= t("phone_number") ?>:
                <a aria-label="Contact phone number" href="tel:0031455270016">
                  045 - 52 700 16
                </a>
              </p>
            </hgroup>
          </article>
        </div>
      </footer>
    </div>
  </body>
</html>
