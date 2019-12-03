<?php
/**
 * Template Name: About Us
 */

// Hämta header.php
get_header();
?>

<div class="container bg-white rounded p-3 mb-5">

  <?php
    // Kolla om det finns någon post i databasen
    if (have_posts()) {
    ?>
  <div class="row">
    <?php

      // Medans det finns poster loopa över dem
      while (have_posts()) {

        // Hämta posten och ta bort den ur listan
        the_post();
        ?>

    <div class="col-12">
      <h1 class="text-primary">
      <?php
        _e('About us', 'sp');
      ?>
      </h1>
    </div>
    <?php
      // Kolla om posten har någon utvald bild och sätt storleken på kolumnen
      $column = has_post_thumbnail() === true
        ? 'col-8'
        : 'col-12';

      if (has_post_thumbnail()) {
        // Hämta bilden
        ?>
    <div class="col-4">
      <img src="<?php echo get_the_post_thubmnail_url(); ?>">
    </div>
    <?php
        }
    ?>

    <div class="<?php echo $column ?>">
      <?php
        // Kolla om det finns några medarbetare
        get_template_part('template-parts/acf/staff');
        
        // Hämta innehållet
        the_content();

      ?>
    </div>

    <?php
      }
    ?>
  </div>
    <?php
    }
  ?>

</div>

<?php
// Hämta footer.php
get_footer();