<?php
// Kolla om det finns några slides tillagda
if (have_rows('latest')) {

  // Om det finns några slides loopa igenom dem
  while (have_rows('latest')) {

    // Ta raden och plocka ur den ur listan
    the_row();

    // Kolla om raden har utseende för senaste inläggen
    if (get_row_layout() === 'latest_posts') {

      // Hämta de tre senate inläggen
      $posts = new WP_query([
        'post_type' => 'post',
        'posts_per_page' => 3
      ]);

      // Loopa igenom dem om det finns några
      if ($posts->have_posts()) {
        ?>
        <div class="row p-3">
          <div class="col-12">
            <h2 class="text-center p-2 rounded text-white m-5">Senaste inläggen</h2>
          </div>
          <?php
                  while ($posts->have_posts()) {
                    // Hämta posten och ta bort den ur listan
                    $posts->the_post();
                    ?>
            <div class="col-lg-3 mb-5 p-3 shadow bg-white rounded">
              <div class="row">
                <div class="col-12">
                  <a href="<?php echo get_the_permalink(); ?>">
                  <?php
                  // Hämta titeln på inlägget
                  echo '<h1>' . get_the_title() . '</h1>';
                  ?>
                  </a>
                </div>

                <?php
                // Om det finns en utvald bild, visa den
                if (has_post_thumbnail()) {
                  ?>

                  <div class="col-4">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>">
                  </div>

                <?php
                }
                ?>

                <div class="col-8">
                  <?php
                  // Hämta beskrivningen av inlägget
                  echo get_the_excerpt();
                  ?>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      <?php
            }

            // Nollställ frågan till databasen
            wp_reset_postdata();
          }

          // Kolla om raden har utseende för senaste recepten
          if (get_row_layout() === 'latest_recipes') {

            // Hämta de tre senate recepten
            $recipes = new WP_query([
              'post_type' => 'recipe',
              'posts_per_page' => 3
            ]);

            // Loopa igenom dem om det finns några
            if ($recipes->have_posts()) {
              ?>
        <div class="row p-3">
          <div class="col-12">
            <h2 class="text-center p-2 rounded text-white m-5">Senaste recepten</h2>
          </div>

          <?php
          while ($recipes->have_posts()) {
            // Hämta receptet och ta bort den ur listan
            $recipes->the_post();
            ?>
            <div class="col-lg-3 mb-5 p-3 shadow bg-white rounded">
              <div class="row">
                <div class="col-12">
                  <a href="<?php echo get_the_permalink(); ?>">
                  <?php
                  // Hämta titeln på receptet
                  echo '<h4>' . get_the_title() . '</h4>';
                  ?>
                  </a>
                </div>

                <?php
                // Om det finns en utvald bild, visa den
                if (has_post_thumbnail()) {
                  ?>

                  <div class="col-4">
                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>">
                  </div>

                <?php
                }
                ?>

                <div class="col-8">
                  <?php
                  // Hämta beskrivningen av receptet
                  echo get_the_excerpt();
                  ?>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
<?php
      }
    }

    // Nollställ frågan till databasen
    wp_reset_postdata();
  }
}
