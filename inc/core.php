<?php

/**
* Initialization Theme
*
* Jumps to the options page when using this theme
* @author Vtrois <seaton@vtrois.com>
* @since 0.1.1
*/
add_action( 'load-themes.php', 'dobby_init_theme' );
function dobby_init_theme(){
  global $pagenow;
  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    wp_redirect( admin_url( 'themes.php?page=Dobby' ) );
    exit;
  }
}

/**
* Loads the Options Panel
*
* Initialization Options Framework and disable the textarea security configuration
* @author Vtrois <seaton@vtrois.com>
* @since 0.1.1
*/
if (!function_exists('optionsframework_init')) {
  define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options/');
  require_once dirname(__FILE__) . '/options/options-framework.php';
  $optionsfile = locate_template( 'options.php' );
  load_template( $optionsfile );
}

add_filter( 'optionsframework_menu', 'options_menu_filter' );
function options_menu_filter( $menu ) {
  $menu['mode'] = 'menu';
  $menu['page_title'] = __( 'Theme Options', 'dobby' );
  $menu['menu_title'] = __( 'Theme Options', 'dobby' );
  $menu['menu_slug'] = 'Bobby';
  return $menu;
}

add_action('admin_init','optionscheck_change_santiziation', 100);
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
        "src" => array(),
        "type" => array(),
        "allowfullscreen" => array(),
        "allowscriptaccess" => array(),
        "height" => array(),
        "width" => array()
      );
    $custom_allowedtags["script"] = array( "type" => array(),"src" => array() );
    $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
    $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

/**
* i18n theme languages
*
* Loading theme languages when setup this theme
* @author Vtrois <seaton@vtrois.com>
* @since 0.1.1
* @todo Only Chinese and English are currently supported
*/
function dobby_theme_languages(){
  load_theme_textdomain('dobby', get_template_directory() . '/languages');
}
add_action ('after_setup_theme', 'dobby_theme_languages');