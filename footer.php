    <footer class="container-fluid p-4 bg-dark text-light">
      <div class="row justify-content-lg-center">
        <div class="col-md-6">
          <h5>
            <?php
            // Hämta inställningen som är gjord för newsletter-title
            echo get_field('newsletter-title', 'options');
            ?>
          </h5>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newsletter">
            <?php
            // Hämta inställningen som är gjord för newsletter-action-text
            echo get_field('newsletter-action-text', 'options');
            ?>
          </button>
        </div>
      </div>

      <div class="row justify-content-lg-center mt-3 mb-3">
        <div class="col-md-6">
          <?php
          // Hämta navigations meny för plats social
          sp_get_nav_menu('social');
          ?>
        </div>
      </div>

      <div class="row justify-content-lg-center">
        <div class="col-md-4 col-lg-2">
          <?php
          // Hämta navigations meny för plats secondary
          sp_get_nav_menu('secondary');
          ?>
        </div>
        <div class="col-md-4">
          <h6><?php _e('Address', 'sp'); ?></h6>
          <p>
            <?php
              // Hämta adressen från inställningarna
              echo get_field('location_address', 'options');
            ?>
          </p>
          <?php
            // Hämta Leaflet kartan
            echo do_shortcode(get_field('leaflet_map', 'options'));
          ?>
        </div>
        <div class="col-md-4 col-lg-2">
          <h6>
            <?php _e('Editors', 'sp'); ?>
          </h6>
          <ul class="navbar-nav">
            <?php
            // Kolla om det finns några redaktörer i inställningarna
            if (have_rows('editors', 'options')) {
              // Medans det finns rader i inställningarna loppa igenom dem
              while (have_rows('editors', 'options')) {
                // Välj raden och plocka bort den ur listan
                the_row();
                ?>

                <li class="nav-item">
                  <?php
                      // Hämta e-posten för redaktören
                      ?>
                  <a class="nav-link" href="mailto:<?php echo get_sub_field('email'); ?>">
                    <?php
                        // Hämta namnet på redaktören
                        echo get_sub_field('name');
                        ?>
                  </a>
                </li>

            <?php
              }
            }
            ?>
          </ul>
        </div>
      </div>
      </div>

      <div class="modal fade mt-5" id="newsletter" tabindex="-1" role="dialog" aria-labelledby="newsletterLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-dark" id="newsletterLabel">
                <?php
                // Hämta inställningen som är gjord för newsletter-modal-title
                echo get_field('newsletter-modal-title', 'options');
                ?>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-dark">
              <?php
              // Hämta inställningen som är gjord för newsletter-modal-content
              echo get_field('newsletter-modal-content', 'options');
              ?>
            </div>
            <div class="modal-footer justify-content-center">
              <form method="post">
                <div class="input-group">
                  <input class="form-control" name="newsletter_email" id="newsletter_email" placeholder="<?php _e('E-mail', 'sp'); ?>">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-success"><?php _e('Send', 'sp'); ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </footer>

    <?php
    // Lägg till wp_footer kroken
    wp_footer();
    ?>

    </body>

    </html>