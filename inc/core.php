<?php

/**
* Initialization Theme
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
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
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.1
*/
if (!function_exists('optionsframework_init')) {
  define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options/');
  require_once dirname(__FILE__) . '/options/options-framework.php';
  $optionsfile = locate_template( 'options.php' );
  load_template( $optionsfile );
}

add_filter( 'optionsframework_menu', 'dobby_options_menu_filter' );

function dobby_options_menu_filter( $menu ) {
  $menu['mode'] = 'menu';
  $menu['page_title'] = __( 'Theme Options', 'dobby' );
  $menu['menu_title'] = __( 'Theme Options', 'dobby' );
  $menu['menu_slug'] = 'Dobby';
  return $menu;
}

add_action('admin_init','dobby_optionscheck_change_santiziation', 100);

function dobby_optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'dobby_custom_sanitize_textarea' );
}
function dobby_custom_sanitize_textarea($input) {
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
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.1
* @todo Only Chinese and English are currently supported
*/
add_action ('after_setup_theme', 'dobby_theme_languages');

function dobby_theme_languages(){
  //theme languages
  load_theme_textdomain('dobby', get_template_directory() . '/languages');
  //theme option languages(inc/options)
  load_theme_textdomain('theme-textdomain', get_template_directory() . '/languages');
}

/**
* User list show last login time
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/

add_action( 'wp_login', 'dobby_insert_last_login' );

function dobby_insert_last_login( $login ) {
  global $user_id;
  $user = get_userdatabylogin( $login );
  update_user_meta( $user->ID, 'last_login', current_time( 'mysql' ) );
}

add_filter( 'manage_users_columns', 'dobby_add_last_login_column' );

function dobby_add_last_login_column( $columns ) {
  $columns['last_login'] = __('Last login time' , 'dobby');
  return $columns;
}

add_action( 'manage_users_custom_column', 'dobby_add_last_login_column_value', 10, 3 );

function dobby_add_last_login_column_value( $value, $column_name, $user_id ) {
  $user = get_userdata( $user_id );
  $single = true;
  if ( 'last_login' == $column_name && $user->last_login )
    $value = get_user_meta( $user->ID, 'last_login', $single );
  else $value = __('No record' , 'dobby');
  return $value;
}

/**
* Show the id for all thing
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_action('admin_init', 'dobby_ssid_add');

function dobby_ssid_column($cols) {
  $cols['ssid'] = 'ID';
  return $cols;
}

function dobby_ssid_value($column_name, $id) {
  if ($column_name == 'ssid')
    echo $id;
}
 
function dobby_ssid_return_value($value, $column_name, $id) {
  if ($column_name == 'ssid')
    $value = $id;
  return $value;
}

function dobby_ssid_css() {
?>
<style type="text/css">
  #ssid { width: 50px; }
</style>
<?php 
}

function dobby_ssid_add() {
  add_action('admin_head', 'dobby_ssid_css');
 
  add_filter('manage_posts_columns', 'dobby_ssid_column');
  add_action('manage_posts_custom_column', 'dobby_ssid_value', 10, 2);
 
  add_filter('manage_pages_columns', 'dobby_ssid_column');
  add_action('manage_pages_custom_column', 'dobby_ssid_value', 10, 2);
 
  add_filter('manage_media_columns', 'dobby_ssid_column');
  add_action('manage_media_custom_column', 'dobby_ssid_value', 10, 2);
 
  add_filter('manage_link-manager_columns', 'dobby_ssid_column');
  add_action('manage_link_custom_column', 'dobby_ssid_value', 10, 2);
 
  add_action('manage_edit-link-categories_columns', 'dobby_ssid_column');
  add_filter('manage_link_categories_custom_column', 'dobby_ssid_return_value', 10, 3);
 
  foreach ( get_taxonomies() as $taxonomy ) {
    add_action("manage_edit-${taxonomy}_columns", 'dobby_ssid_column');     
    add_filter("manage_${taxonomy}_custom_column", 'dobby_ssid_return_value', 10, 3);
  }
 
  add_action('manage_users_columns', 'dobby_ssid_column');
  add_filter('manage_users_custom_column', 'dobby_ssid_return_value', 10, 3);
 
  add_action('manage_edit-comments_columns', 'dobby_ssid_column');
  add_action('manage_comments_custom_column', 'dobby_ssid_value', 10, 2);
}

/**
* Loading theme resources
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_action('wp_enqueue_scripts', 'dobby_theme_scripts');

function dobby_theme_scripts() {  
  $dir = get_template_directory_uri();

  //css
  wp_enqueue_style( 'bootstrap', $dir . '/css/bootstrap.min.css', array(), DOBBY_VERSION);
  wp_enqueue_style( 'animate', $dir . '/css/animate.min.css', array(), DOBBY_VERSION);
  wp_enqueue_style( 'layer', $dir . '/css/layer.min.css', array(), DOBBY_VERSION);

  //javascript
  wp_enqueue_script( 'jquery', $dir . '/js/jquery.min.js' , array(), DOBBY_VERSION);
  wp_enqueue_script( 'easing', $dir . '/js/jquery.easing.min.js', array(), DOBBY_VERSION);
  wp_enqueue_script( 'sticky', $dir . '/js/sticky.min.js', array(), DOBBY_VERSION);
  wp_enqueue_script( 'wow', $dir . '/js/wow.min.js', array(), DOBBY_VERSION);
  wp_enqueue_script( 'layer', $dir . '/js/layer.min.js', array(), DOBBY_VERSION);

  if (is_singular()) {
    wp_enqueue_script( 'qrcode', $dir . '/js/jquery.qrcode.min.js', array(), DOBBY_VERSION);
  }

  if(is_page()){
    wp_enqueue_style( 'dobby-page', $dir . '/css/dobby.page.css', array(), DOBBY_VERSION);
  }

  $dataToDobby = array(
    'site' => home_url(),
    'directory' => get_stylesheet_directory_uri(),
  );
  wp_localize_script( 'dobby', 'db', $dataToDobby );

}

/**
* Replace the jquery resources
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_action( 'wp_enqueue_scripts', 'dobby_enqueue_scripts', 1 );

function dobby_enqueue_scripts() {
  wp_deregister_script('jquery');
}

/**
* Optimized built-in functions
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_filter( 'emoji_svg_url', '__return_false' );
add_filter( 'show_admin_bar', '__return_false' );

remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content', 'wptexturize'); 
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('embed_head', 'print_emoji_detection_script');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

/**
* Disable open sans
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_filter('gettext_with_context', 'dobby_disable_open_sans', 888, 4 );

function dobby_disable_open_sans( $translations, $text, $context, $domain )
{
    if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
        $translations = 'off';
    }
    return $translations;
}

/**
* Replace the default avatar server
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_filter( 'get_avatar', 'dobby_get_avatar' );

function dobby_get_avatar( $avatar ) {
  $avatar = str_replace( array( 'www.gravatar.com', '0.gravatar.com', '1.gravatar.com', '2.gravatar.com', '3.gravatar.com', 'secure.gravatar.com' ), 'cn.gravatar.com', $avatar );
  return $avatar;
}

/**
* Add the default avatar image
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
* @global dobby_option('tool_avatar')
*/
add_filter( 'avatar_defaults', 'dobby_gravatar' );

function dobby_gravatar ($avatar_defaults) {
    $azavatar = dobby_option('tool_avatar');
    $myavatar = ($azavatar) ? $azavatar : get_template_directory_uri() . '/images/avatar.png' ;  
    $avatar_defaults[$myavatar] = "Dobby Gravatar";  
    return $avatar_defaults;  
}

/**
* Add the default avatar image
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
