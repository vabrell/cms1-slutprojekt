<?php

/**
 * Theme assets
 */

function slutprojekt_load_styles() {
  // Ladda in bootstrap css
  wp_enqueue_style('bootstrap', trailingslashit(get_template_directory_uri()) . 'css/bootstrap.min.css');
}
// Kalla på funktionen för att ladda in css vid kroken wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'slutprojekt_load_styles');

function slutprojekt_load_scripts() {
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
add_action('wp_enqueue_scripts', 'slutprojekt_load_scripts');