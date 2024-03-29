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
  // Ladda in egen css
  wp_enqueue_style('slutprojekt', trailingslashit(get_template_directory_uri()) . 'css/slutprojekt.css');
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
function sp_load_text_domain() {
  load_theme_textdomain('sp', trailingslashit(get_template_directory()) . '/languages');
}
add_action('after_setup_theme', 'sp_load_text_domain');

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
        'revisions',
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

// Fix för att få med recepten på arkiv sidan för författare
function sp_post_author_archive($query)
{
  if ($query->is_author)
    $query->set('post_type', array('recipe', 'post'));
  remove_action('pre_get_posts', 'sp_post_author_archive');
}
add_action('pre_get_posts', 'sp_post_author_archive');

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
    'secondary' => __('Secondary Menu', 'sp'),
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

/**
 * Get the pagination links
 * 
 * @param WP_query $query
 *  Supply the current WordPress query
 * 
 * @return echo pagination links
 */

function sp_pagination($query)
{

  $current = max(1, get_query_var('paged'));
  $total = $query->max_num_pages;
  $count = $total + 1;
  $end_size = 1;
  $mid_size = 2;
  $links = [];
  $prev = '';
  $next = '';

  // Kolla om det bara är en sida och returnera
  if ($total < 2) {
    return;
  }

  // Offseten för nästa länk
  if ($current < $total)
    $count--;

  // Tidigare länk
  if ($current > 1) {
    $prev = sp_pagination_link($current - 1, 'page-item', 'page-link', __('Previous'));
  }

  // Tidigare sidor
  $prev_separator = false;
  for ($i = 1; $i < $count; $i++) {
    $page = $i;
    if ($page < $current) {
      if (!($page < $current - $mid_size) || $page == 1) {
        $links[] = sp_pagination_link($page, 'page-item', 'page-link',);
      } else if (!$prev_separator) {
        $links[] = sp_pagination_link($page, 'page-item disabled', 'page-link', '...');
        $prev_separator = true;
      }
    }
  }

  // Nuvarande sida
  $links[] = sp_pagination_link($current, 'page-item active', 'page-link');

  // Nästa sidor
  $next_separator = false;
  for ($i = 1; $i < $count; $i++) {
    $page = $current + $i;
    if ($page <= $total) {
      if (!($page > $current + $mid_size) || $page == $total) {
        $links[] = sp_pagination_link($page, 'page-item', 'page-link');
      } else if (!$next_separator) {
        $links[] = sp_pagination_link($page, 'page-item disabled', 'page-link', '...');
        $next_separator = true;
      }
    }
  }

  // Nästa länk
  if ($current < $total) {
    $next = sp_pagination_link($current + 1, 'page-item', 'page-link', __('Next'));
  }

  // Skriv ut alla länkar
  echo '<nav>';
  echo '<ul class="pagination">';
  echo $prev;
  echo join('', $links);
  echo $next;
  echo '</ul>';
  echo '</nav>';
}

/**
 * Skapa en paginations länk
 * 
 * @param int|bool $page
 *  The page that the link belongs to
 * 
 * @param string $li_class
 *  The classes that should be added to the LI element.
 *  To add multiple classes separate with a whitespace
 * 
 * @param string $a_class
 *  The classes that should be added to the A element.
 *  To add multiple classes separate with a whitespace
 * 
 * @param string $label
 *  The label for the link
 * 
 * @return string $formated_link
 *  Returns a formated link
 */
function sp_pagination_link($page = false, $li_class = '', $a_class = '' , $label = '')
{
  // Kolla så sidan har skickats med
  if (!$page) {
    return;
  }

  // Kolla om någon text har skickats med annars sätt sidnummret
  $label = $label ? $label : $page;

  // Sätt länken till sidan
  $link = esc_url_raw(get_pagenum_link($page));

  // Formatera länken
  $formated_link = '<li class="' . $li_class . '"><a class="' . $a_class . '" href="' . $link . '">' . $label . '</a></li>';

  // Returnera länken
  return $formated_link;
}