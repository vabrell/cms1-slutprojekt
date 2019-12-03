<?php
// Hämta header.php
get_header();
?>

<div class="container">
  <h1>
    <?php
    // Hämta titeln för vilket arkiv det är
    echo get_the_archive_title();
    ?>
  </h1>
  <?php
  // Kolla om det finns någon post i databasen att hämta
  if (have_posts()) {
    // Medans det finns poster i databasen loopa igenom dem
    while (have_posts()) {
      // Välj posten och ta bort den ur listan
      the_post();
      ?>

      <div class="row mb-5 p-3 shadow">
        <div class="col-12">
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
        </div>
        <?php
          // Kolla om det finns någon utvald bild
          if (has_post_thumbnail()) {
            // Hämta bilden
            ?>
        <div class="col-3">
          <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>">
        </div>
            <?php
          }
        ?>
        <div class="col-9">
          <p class="lead p-2">
            <?php
                // Hämta beskrivningen
                echo get_the_excerpt();
                ?>
          </p>
        </div>
        <div class="col-12">
          <div class="bg-light text-muted small">
            <div class="container">
              <div class="row">
                  <?php
                      echo __('Author', 'sp') . ':&nbsp;';
                      // Hämta författaren
                      echo get_the_author_posts_link();
                      ?>
              </div>
              <div class="row">
                <?php
                    // Hämta kategorier
                    if (count(get_the_category()) > 0) {
                      echo __('Category', 'sp') . ':&nbsp;';
                      the_category(', ');
                    }

                    // Hämta måltider
                    if (has_term('', 'meal')) {
                      echo __('Mealtime', 'sp') . ':&nbsp;';
                      the_terms(get_the_ID(), 'meal');
                    }
                    ?>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php
    }
  }

  // Hämta den globala wp_queryn
  global $wp_query;
  // Hämta paginations länkar
  sp_pagination($wp_query);
  ?>
</div>

<?php
// Hämta footer.php
get_footer();
