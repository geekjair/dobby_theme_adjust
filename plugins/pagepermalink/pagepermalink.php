<?php
/*
Plugin Name: Page Permalink
Plugin URI: https://github.com/Vtrois/Dobby/tree/master/plugins
Description: Open the pseudo-static rule of the page.
Version: 1.1.3
Author: Vtrois
Author URI: https://www.vtrois.com/
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

add_action('init', 'dobby_page_permalink', -1);

function dobby_page_permalink() {
  global $wp_rewrite;
  if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
      $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
  }
}