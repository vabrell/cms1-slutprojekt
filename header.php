<!DOCTYPE html>
<?php
// Hämta locale inställningarna som är satta i WordPress
?>
<html lang="<?php echo get_locale(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    <?php
      // Hämta namnet i WordPress inställningarna
      bloginfo('name');
    ?>
  </title>

  <?php
    // Lägg till wp_head kroken
    wp_head();
  ?>
</head>
<?php
// Lägg till alla body classer
?>
<body <?php body_class(); ?>>

<?php
// Lägg till huvudmenyn via en mall-del
get_template_part('template-parts/menu/primary');
?>