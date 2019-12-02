<?php

/**
 * ************
 * Theme assets
 * ************
 */

function sp_load_styles() {
  // Ladda in bootstrap css
  wp_enqueue_style('bootstrap', trailingslashit(get_template_directory_uri()) . 'css/bootstrap.min.css');
  // Ladda in fontawesome css
  wp_enqueue_style('fontawesome', trailingslashit(get_template_directory_uri()) . 'css/fontawesome.min.css');
  wp_enqueue_style('fontawesome-brands', trailingslashit(get_template_directory_uri()) . 'css/brands.min.css');
}
// Kalla på funktionen för att ladda in css vid kroken wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'sp_load_styles');

function sp_load_scripts() {
  // Ladda in wordpress inbyggda jquery
  wp_enqueue_script('jquery');
  // Ladda in popper js som behövs för bootstrap
  wp_enqueue_script('popper-js', trailingslashit(get_template_directory_uri()) . 'js/popper.js');
  // Ladda in bootstrap js som kräver jquery och popper js
  wp_enqueue_script(
    'bootstrap-js',
    trailingslashit(get_template_directory_uri()) . 'js/bootstrap.min.js',
    ['jquery', 'popper-js']
  );
}
// Kalla på funktionen för att ladda in script vid kroken wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'sp_load_scripts');

// Ladda in textdomänen
load_theme_textdomain('sp');

// Ladda in ACF metoder för temat
require('functions/acf.php');

/**
 * ***********************
 * Theme custom post types
 * ***********************
 */

function sp_add_post_types() {
  // Registrera egna post typer
  register_post_type(
    'recipe',
    [
      'labels' => [
        'name' => __('Recipes', 'sp'),
        'singular_name' => __('Recipe', 'sp'),
        'add_new' => __('Add New Recipe', 'sp'),
        'add_new_item' => __('Add New Recipe', 'sp'),
        'edit_item' => __('Edit Recipe', 'sp'),
        'new_item' => __('New Recipe', 'sp'),
        'view_item' => __('View Recipe', 'sp'),
        'view_items' => __('View Recipes', 'sp'),
        'search_items' => __('Search Recipes', 'sp'),
        'not_found' => __('No recipes found', 'sp'),
        'not_found_in_trash' => __('No recipes found in Trash', 'sp'),
        'all_items' => __('All Recipes', 'sp'),
        'featured_image' => __('Recipe Image', 'sp'),
        'set_featured_image' => __('Set recipe image', 'sp'),
        'remove_featured_image' => __('Remove recipe image', 'sp'),
        'use_featured_image' => __('Use as recipe image', 'sp'),
        'filter_items_list' => __('Filter recipes list', 'sp'),
        'items_list_navigation' => __('Recipes list', 'sp'),
        'item_published' => __('Recipe published', 'sp'),
        'item_published_privately' => __('Recipe published privately', 'sp'),
        'item_reverted_to_draft' => __('Recipe reverted to draft', 'sp'),
        'item_scheduled' => __('Recipe scheduled', 'sp'),
        'item_updated' => __('Recipe updated', 'sp'),
      ],
      'description' => __('Recipes of food, desserts and other yummy things', 'sp'),
      'public' => true,
      'menu_icon' => 'dashicons-editor-ol',
      'taxonomies' => [
        'meal'
      ],
      'supports' => [
        'title',
        'editor',
        'comments',
        'revisions',
        'author',
        'excerpt',
        'thumbnail'
      ],
      'has_archive' => true,
      'rewrite' => true,
      'show_in_rest' => true
    ]
  );
}
// Kalla på funktionen för att lägga till egna post typer vid kroken init
add_action('init', 'sp_add_post_types');

/**
 * ***********************
 * Theme custom post types
 * ***********************
 */

function sp_add_taxonimies()
{
  // Registrera egna post typer
  register_taxonomy(
    'meal',
    'recipe',
    [
      'labels' => [
        'name' => __('Mealtimes', 'sp'),
        'singular_name' => __('Mealtime', 'sp'),
        'search_items' => __('Search Mealtimes', 'sp'),
        'popular_items' => __('Popular Mealtimes', 'sp'),
        'edit_item' => __('Edit Mealtime', 'sp'),
        'view_item' => __('View Mealtime', 'sp'),
        'update_item' => __('Update Mealtimes', 'sp'),
        'add_new_item' => __('Add New Mealtime', 'sp'),
        'new_item_name' => __('New Mealtime Name', 'sp'),
        'separate_items_with_commas' => __('Separate mealtimes with commas', 'sp'),
        'add_or_remove_items' => __('Add or remove mealtimes', 'sp'),
        'choose_from_most_used' => __('Choose from the most used mealtime', 'sp'),
        'not_found' => __('No mealtimes found', 'sp'),
        'no_terms' => __('No mealtimes', 'sp'),
        'items_list_navigation' => __('Mealtimes list', 'sp'),
        'items_list' => __('Mealtimes list', 'sp'),
        'back_to_items' => __('Mealtime have been updated', 'sp'),
      ],
      'description' => __('Types of meals you can have', 'sp'),
      'public' => true,
      'has_archive' => true,
      'rewrite' => true,
      'show_in_rest' => true
    ]
  );
}
// Kalla på funktionen för att lägga till egna post typer vid kroken init
add_action('init', 'sp_add_taxonimies');

/**
 * ********************
 * Theme menu locations
 * ********************
 */

function sp_register_menus() {
  // Registrera tema meny platser
  register_nav_menus([
    'primary' => __('Primary Menu', 'sp'),
    'secondary' => __('Secondary Menu'),
    'social' => __('Social Media', 'sp')
  ]);
}
// Kalla på funktionen för att ladda in tema meny platser vid korken after_setup_theme
add_action('after_setup_theme', 'sp_register_menus');

/**
 * *************
 * Theme support
 * *************
 */

//  Tillåt att skapa menyer
add_theme_support('menus');
add_theme_support('post-thumbnails');

/**
 * ***************
 * Theme functions
 * ***************
 */

/**
 * Render navigation menu from location that have been supplied
 * 
 * @param string $location
 *  Name of the theme_location for the menu
 * 
 * @return string $menu_list
 *  Returns a string of rendered menu
 */
function sp_get_nav_menu(string $location) {
  // Hämta mall platsen
  if (!array_key_exists($location, $theme_location = get_nav_menu_locations())) {
    // Om inte platsen finns returnera
    return;
  }

  // Hämta menyn som är länkad till mall platsen
  $menu = wp_get_nav_menu_object($theme_location[$location]);

  // Skapa en lista för barn för att exkludera att de redan har lagts till
  $children = [];

  // Lägg till start taggen för menyn
  if ($location === 'social') {
    $menu_list = '<ul class="nav">';
  }else {
    $menu_list = '<ul class="navbar-nav mr-auto">';
  }

  // Lägg till meny innehållet i $menu_items om det finns något
  if ($menu_items = wp_get_nav_menu_items($menu->term_id)) {
    // Loopa igenom allt innehåll
    foreach ($menu_items as $item) {
      if (!in_array($item->ID, $children)) {
        // Hämta ID på länken
        $id = $item->ID;
        // Hämta texten på länken
        $title = $item->title;
        // Hämta adressen på länken
        $url = $item->url;
  
        // Kolla om länken har några barn
        if (count($the_children = sp_get_children($id, $menu_items)) > 0) {
          // Skapa en listmeny
          $menu_list .= '<li class="nav-item dropdown">';
          $menu_list .= "<a class='nav-link dropdown-toggle'
                            href='$url'
                            id='$title-dropdown'
                            role='button'
                            data-toggle='dropdown'
                            aria-haspopup='true'
                            aria-expanded='false'                          
                            >$title</a>";
          $menu_list .= "<div class='dropdown-menu' aria-labelledby='$title-dropdown'>";
  
          // Lägg till alla barn i listmenyn
          foreach ($the_children as $child) {
            // Hämta barnets länk text
            $child_title = $child->title;
            // Hämta barnets länk adress
            $child_url = $child->url;

            // Lägg till barn länken
            $menu_list .= "<a class='dropdown-item' href='$child_url'>$child_title</a>";

            // Lägg till barnets ID i listan för exkludering
            array_push($children, $child->ID);
          }
  
          $menu_list .= '</div>';
          $menu_list .= '</li>';
        }
        // Annars lägg till länken
        else {
          $location === 'social'
          ? $class = 'class="ml-2 mr-3"'
          : $class = 'class="nav-link"';

          $menu_list .= '<li class="nav-item">';
          $menu_list .= sp_get_social_media_icon($url);
          $menu_list .= "<a $class href='$url'>$title</a>";
          $menu_list .= '</li>';
        }
      }
    }
  }

  // Lägg till slut taggen för menyn
  $menu_list .= '</ul>';

  echo $menu_list;
}

/**
 * Get the menu item children
 * 
 * @param int $id
 *  The ID of a menu item
 * 
 * @param array $menu_items
 *  Array of menu items to check if they are children
 *  and add them to the list of children
 * 
 * @return array $children
 *  Returns list of child items
 */
function sp_get_children(int $id, array $menu_items){
  $children = [];

  foreach ($menu_items as $item) {
    // Kolla om meny länken är ett barn till den specificerade länken
    if ((int) $item->menu_item_parent === $id) {
      array_push($children, $item);
    }
  }

  return $children;
}

/**
 * Get icon for social media
 * 
 * @param string $link
 *  Link to check if and what social media it is
 * 
 * @return string $icon
 *  Returns string of icon or an empty string
 */
function sp_get_social_media_icon(string $link) {
  switch ($link) {
    case (preg_match('/facebook/', $link) ? true : false):
      $icon = '<i class="fab fa-facebook-square"></i>';
      break;

    case (preg_match('/instagram/', $link) ? true : false):
      $icon = '<i class="fab fa-instagram"></i>';
      break;

    case (preg_match('/twitter/', $link) ? true : false):
      $icon = '<i class="fab fa-twitter-square"></i>';
      break;

    case (preg_match('/pintrest/', $link) ? true : false):
      $icon = '<i class="fab fa-pinterest-square"></i>';
      break;

    default:
      $icon = '';
  }

  return $icon;
}

/**
 * Print out Open Graph tags
 * 
 * @param string $title
 *  The title of the post
 * 
 * @param string $image
 * 
 * @return echo Open Graph Tags
 * 
 */
function sp_get_open_graph_tags(string $title = '', string $image = '') {
  // Sätt standardvärden om de inte är satta
  empty($title) ? $title = get_bloginfo('name') : $title;
  empty($image) ? $image = trailingslashit(get_template_directory_uri()) . 'img/logo.png' : $image;

  // Skapa taggarna
  $open_graphs = "<meta property='og:title' content='$title'>\n";
  $open_graphs .= "  <meta property='og:image' content='$image'>\n";
  
  // Skriv ut taggarna
  echo $open_graphs;
}