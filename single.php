<?php
// Hämta header.php
get_header();
?>

<div class="container-fluid">
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
          // Kolla om det finns någon utvald bild
          if (has_post_thumbnail()) {
            ?>

        <div class="col-3">
          <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>">
        </div>

            <?php
          }
        ?>
        <div class="col-9 p-3">

          <div class="bg-light text-muted small">
            <div class="container-fluid">
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
                    // Hämta kategorier
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
