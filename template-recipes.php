<?php

/**
 * Template Name: Recipes
 */

// Hämta header.php
get_header();

// Hämta alla recept med en egen fråga till databasen
$recipes = new WP_query([
  'post_type' => 'recipe',
  'paged' => $paged
]);

?>

<div class="container">
  <?php
  // Kolla om det finns något recept i databasen att hämta
  if ($recipes->have_posts()) {
    // Medans det finns recept i databasen loopa igenom dem
    while ($recipes->have_posts()) {
      // Välj receptet och ta bort den ur listan
      $recipes->the_post();
      ?>
      <div class="row mb-5 p-3 shadow bg-white rounded">
        <div class="row">
          <div class="col">
            <h1>
              <?php
                // Hämta länken till receptet
              ?>
              <a href="<?php echo get_the_permalink(); ?>">
                <?php
                  // Hämta titeln på receptet
                  echo get_the_title();
                ?>
              </a>
            </h1>
          </div>
        </div>
        <div class="row">
          <?php
            $column = 'col-10';
            // Kolla om receptet har någon bild
            if (has_post_thumbnail()) {
              $column = 'col-8';
          ?>

          <div class="col-4">
            <img class="img-fluid img-thumbnail" src="<?php echo get_the_post_thumbnail_url(); ?>">
          </div>

          <?php
            }
          ?>
          <div class="<?php echo $column; ?>">
            <p class="lead p-2">
              <?php
              // Hämta beskrivningen om receptet
                echo get_the_excerpt();
              ?>
            </p>
          </div>
          <div class="col">
            <div class="bg-light text-muted small">
              <div class="container">
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
          </div>
        </div>
      </div>

  <?php
    }
  }

  // Hämta paginations länkar
  sp_pagination($recipes);
  ?>
</div>

<?php
// Hämta footer.php
get_footer();
