<?php

/**
 * Template Name: Recipes
 */

// Hämta header.php
get_header();

// Hämta alla recept med en egen fråga till databasen
$recipes = new WP_query([
  'post_type' => 'recipe'
]);

?>

<div class="container">
  <?php
  // Kolla om det finns någon post i databasen att hämta
  if ($recipes->have_posts()) {
    // Medans det finns poster i databasen loopa igenom dem
    while ($recipes->have_posts()) {
      // Välj posten och ta bort den ur listan
      $recipes->the_post();
      ?>

      <div class="row mb-3">
        <div class="col p-3 shadow">
          <h1>
            <?php
                // Hämta länken till posten
                ?>
            <a href="<?php echo get_the_permalink(); ?>">
              <?php
                  // Hämta titeln på posten
                  echo get_the_title();
                  ?>
            </a>
          </h1>
          <p class="lead p-2">
            <?php
                // Kolla om inställningen säger att hela innehållet skall visas eller inte
                if (get_option('rss_use_excerpt')) {
                  echo get_the_excerpt();
                }
                // Hämta innehållet på posten
                else {
                  echo get_the_content();
                }
                ?>
          </p>
          <div class="bg-light text-muted small">
            <div class="container">
              <div class="row">
                <?php
                    // Hämta författaren
                    echo get_the_author_posts_link();
                    ?>
                &nbsp;@&nbsp;
                <?php
                    // Hämta länk till datum arkiv
                    $post_date = explode('-', get_the_date('Y-m-d'));
                    $url = get_day_link($post_date[0], $post_date[1], $post_date[2]);
                    ?>
                <a href="<?php echo $url; ?>">
                  <?php
                      // Hämta datum
                      echo get_the_date();
                      ?>
                </a>
              </div>
              <div class="row">
                <?php
                  _e('Mealtime:', 'sp');
                  echo "&nbsp;";
                    // Hämta kategorier
                    the_terms(get_the_ID(),'meal');
                    ?>
              </div>
            </div>
          </div>
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
