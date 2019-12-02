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

        // Skriv ut allt innehåll
        echo get_the_content();
      }
    }
  ?>
</div>

<?php
// Hämta footer.php
get_footer();