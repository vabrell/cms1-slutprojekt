<?php
/**
 * Theme functions for Advanced Custom Fields plugin
 */

// Kolla om ACF finns
if (is_dir(trailingslashit(WP_PLUGIN_DIR) . 'advanced-custom-fields-pro')) {
  
  /**
   * *************
   * Options pages
   * *************
   */

  function sp_register_option_pages() {
    // Kolla om funktionen finns för att registrera en inställningssida
    if (function_exists('acf_add_options_page')) {

      // Lägg till menyn för Tema inställningar
      acf_add_options_page([
        'page_title' => __('Theme settings', 'sp'),
        'menu_slug' => 'theme-settings',
        'redirect' => true
      ]);

    }

    // Kolla om funktionen finns för att registrera undersidor till en inställningssida
    if (function_exists('acf_add_options_sub_page')) {
      // Lägg till undermenyn för nyhetsbrev
      acf_add_options_sub_page([
        'page_title' => __('Newsletter', 'sp'),
        'parent_slug' => 'theme-settings'
      ]);

      // Lägg till undermenyn för redaktörer
      acf_add_options_sub_page([
        'page_title' => __('Editors', 'sp'),
        'parent_slug' => 'theme-settings'
      ]);
    }
  }
  add_action('acf/init', 'sp_register_option_pages');

}