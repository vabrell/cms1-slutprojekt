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
        <div class="col-12">
          <h1>
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
          <img class="img-fluid img-thumbnail" src="<?php echo get_the_post_thumbnail_url(); ?>">
        </div>

        <?php
          }
        ?>
        <div class="<?php echo $column; ?> p-3">

          <div class="text-muted small">
            <div class="container-fluid">
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

          <div class="p-2">
            <?php
              // Hämta innehållet på posten
              the_content();
            ?>
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
