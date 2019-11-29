<?php

/**
 * ************
 * Theme assets
 * ************
 */

function sp_load_styles() {
  // Ladda in bootstrap css
  wp_enqueue_style('bootstrap', trailingslashit(get_template_directory_uri()) . 'css/bootstrap.min.css');
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

/**
 * ********************
 * Theme menu locations
 * ********************
 */

function sp_register_menus() {
  // Registrera tema meny platser
  register_nav_menus([
    'primary' => __('Primary Menu')
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
  $theme_location = get_nav_menu_locations()[$location];
  // Hämta menyn som är länkad till mall platsen
  $menu = wp_get_nav_menu_object($theme_location);

  // Skapa en lista för barn för att exkludera att de redan har lagts till
  $children = [];

  // Lägg till start taggen för menyn
  $menu_list = '<ul class="navbar-nav mr-auto">';

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
          $menu_list .= '<li class="nav-item">';
          $menu_list .= "<a class='nav-link' href='$url'>$title</a>";
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

