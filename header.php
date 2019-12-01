<!DOCTYPE html>
<?php
// Hämta locale inställningarna som är satta i WordPress
?>
<html lang="<?php echo get_locale(); ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:locale" content="sv_SE">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?> ">
  <?php
    // Lägg till specifika Open Graph taggar

    // Kolla om det är ett enkillt inlägg
    if (is_singular()) {
      if (!($image = get_the_post_thumbnail_url())) {
        $image = '';
      }
      sp_get_open_graph_tags(get_the_title(), $image);
    } else {
      sp_get_open_graph_tags();
    }
  ?>
  
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