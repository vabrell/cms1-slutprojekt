<?php
// Hämta header.php
get_header();
?>

<div class="container">
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
            ?>
        <div class="col-3">
          <img src="<?php echo get_the_post_thumbnail(); ?>">
        </div>
            <?php
          }
        ?>
        <div class="col-9">
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
        </div>
        <div class="col-12">
          <div class="bg-light text-muted small">
            <div class="container">
              <div class="row">
                <?php
                  // Hämta författaren
                  echo __('Author', 'sp') . ':&nbsp;' . get_the_author_posts_link();
                ?>
              </div>
              <div class="row">
                <?php
                  // Hämta kategorier
                  echo __('Category', 'sp') . ':&nbsp;';
                  the_category(', ');
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
