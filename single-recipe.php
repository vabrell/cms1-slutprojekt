<?php
// Hämta header.php
get_header();
?>

<div class="container bg-white mb-5 p-4 rounded">
  <?php
  // Kolla om det finns någon post i databasen att hämta
  if (have_posts()) {
    // Medans det finns poster i databasen loopa igenom dem
    while (have_posts()) {
      // Välj posten och ta bort den ur listan
      the_post();
      ?>
      <div class="row">
        <div class="col">
          <h1 class="text-primary">
            <?php
                // Hämta titeln på posten
                echo get_the_title();
                ?>
          </h1>
        </div>
      </div>
      <div class="row mb-3">
        <?php
          $column = 'col-10';
          // Kolla om det finns någon utvald bild
          if (has_post_thumbnail()) {
            $column = 'col-8';
        ?>

          <div class="col-4">
            <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>">
          </div>

        <?php
            }
            ?>
        <div class="<?php echo $column; ?> p-3">

          <div class="text-muted small">
            <div class="container-fluid">
              <div class="row">
                <?php
                  _e('Author', 'sp');
                    echo ":&nbsp;";
                  // Hämta författaren
                  echo get_the_author_posts_link();
                ?>
              </div>
              <div class="row">
                <?php
                    _e('Mealtime', 'sp');
                    echo ":&nbsp;";
                    // Hämta kategorier
                    the_terms(get_the_ID(), 'meal');
                    ?>
              </div>
            </div>
          </div>

          <div class="p-2">
            <?php
                // Hämta utdraget på posten
                the_excerpt();
                ?>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col">
          <?php
              // Kolla om det finns några rader för receptet
              if (have_rows('recipe')) {
                // Medans det finns rader loopa igenom dem
                while (have_rows('recipe')) {
                  // Välj raden och ta bort den ut listan
                  the_row();

                  // Kolla vilken layout som har valts
                  if (get_row_layout() === 'recipe_ingredients') {

                    // Kolla om det finns några rader för ingredienser
                    if (have_rows('ingredients')) {
                      echo '<h3>' . __('Ingredients', 'sp') . '</h3>';;
                      echo '<ul>';

                      // Medans det finns rader loopa igenom dem
                      while (have_rows('ingredients')) {
                        // Välj raden och ta bort den ur listan
                        the_row();

                        // Hämta ingrediens informationen
                        $volume = get_sub_field('volume');
                        $volume_type = get_sub_field('volume_type');
                        $ingredient = get_sub_field('ingredient');

                        echo "<li>$volume $volume_type $ingredient</li>";
                        
                      }

                      echo '</ul>';
                    }

                  } else if (get_row_layout() === 'recipe_steps') {

                    // Kolla om det finns några rader för instruktionerna
                    if (have_rows('step')) {
                      echo '<h3>' . __('Instructions', 'sp') . '</h3>';;
                      echo '<ol>';

                      // Medans det finns rader loopa igenom dem
                      while (have_rows('step')) {
                        // Välj raden och ta bort den ur listan
                        the_row();

                      // Hämta instruktionen
                      $instruction = get_sub_field('instruction');

                        echo "<li>$instruction</li>";
                      }

                      echo '</ol>';
                    }
                  }

                }
                // Hämta innehållet för att få med knapparna för att dela på sociala medier
                the_content();
              }
              ?>
        </div>
      </div>

  <?php
    }
  }
  ?>
</div>

<?php
// Hämta footer.php
get_footer();
