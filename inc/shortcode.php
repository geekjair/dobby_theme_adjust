<?php

function success($atts, $content=null, $code="") {
    $return = '<div class="alert alert-success">';
    $return .= $content;
    $return .= '</div>';
    return $return;
}
add_shortcode('success' , 'success' );

function info($atts, $content=null, $code="") {
    $return = '<div class="alert alert-info">';
    $return .= $content;
    $return .= '</div>';
    return $return;
}
add_shortcode('info' , 'info' );

function warning($atts, $content=null, $code="") {
    $return = '<div class="alert alert-warning">';
    $return .= $content;
    $return .= '</div>';
    return $return;
}
add_shortcode('warning' , 'warning' );

function danger($atts, $content=null, $code="") {
    $return = '<div class="alert alert-danger">';
    $return .= $content;
    $return .= '</div>';
    return $return;
}
add_shortcode('danger' , 'danger' );

function title($atts, $content=null, $code="") {
    $return = '<h2>';
    $return .= $content;
    $return .= '</h2>';
    return $return;
}
add_shortcode('title' , 'title' );

function wymusic($atts, $content=null, $code="") {
    $return = '<iframe style="width:100%" frameborder="no" border="0" marginwidth="0" marginheight="0" height=86 src="//music.163.com/outchain/player?type=2&id=';
    $return .= $content;
    $return .= '&auto='. dobby_option('tool_music') .'&height=66"></iframe>';
    return $return;
}
add_shortcode('music' , 'wymusic' );

function download($atts, $content=null, $code="") {
    extract(shortcode_atts(array("title"=>__('Download' , 'dobby')),$atts));
    $return = '<div class="mt-2 mb-2 text-center"><a class="downbtn" href="';
    $return .= $content;
    $return .= '" target="_blank" rel="nofollow"><i class="dobby v3-download"></i> ';
    $return .= $title;
    $return .= '</a></div>';
    return $return;
}
add_shortcode('download' , 'download' );

function img($atts, $content=null, $code="") {
    $return = '<img class="alignnone" src="';
    $return .= htmlspecialchars($content);
    $return .= '" alt="" width="100%" height="auto" />';
    return $return;
}
add_shortcode('img' , 'img' );

function pre($atts, $content=null, $code="") {
    $content = htmlspecialchars($content);
    $return = '<div class="code-highlight"><pre><code class="hljs">';
    $return .= ltrim($content, '\n');
    $return .= '</code></pre></div>';
    return $return;
}
add_shortcode('pre' , 'pre' );

function code($atts, $content=null, $code="") {
    $content = htmlspecialchars($content);
    $return = '<div class="code-highlight"><pre><code class="hljs">';
    $return .= ltrim($content, '\n');
    $return .= '</code></pre></div>';
    return $return;
}
add_shortcode('code' , 'code' );

function kbd($atts, $content=null, $code="") {
    $return = '<kbd>';
    $return .= $content;
    $return .= '</kbd>';
    return $return;
}
add_shortcode('kbd' , 'kbd' );

function nrmark($atts, $content=null, $code="") {
    $return = '<mark>';
    $return .= $content;
    $return .= '</mark>';
    return $return;
}
add_shortcode('mark' , 'nrmark' );

function striped($atts, $content=null, $code="") {
    $num = $content;
    $return = '<div class="progress"><div class="progress-bar progress-bar-striped" role="progressbar" style="width:'.$num.'%">'.$num.'%</div></div>';
    return $return;
}
add_shortcode('striped' , 'striped' );

function successbox($atts, $content=null, $code="") {
    extract(shortcode_atts(array("title"=>__('Title' , 'dobby')),$atts));
    $return = '<div class="panel panel-success"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= $content;
    $return .= '</div></div>';
    return $return;
}
add_shortcode('successbox' , 'successbox' );

function infobox($atts, $content=null, $code="") {
    extract(shortcode_atts(array("title"=>__('Title' , 'dobby')),$atts));
    $return = '<div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= $content;
    $return .= '</div></div>';
    return $return;
}
add_shortcode('infobox' , 'infobox' );

function warningbox($atts, $content=null, $code="") {
    extract(shortcode_atts(array("title"=>__('Title' , 'dobby')),$atts));
    $return = '<div class="panel panel-warning"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= $content;
    $return .= '</div></div>';
    return $return;
}
add_shortcode('warningbox' , 'warningbox' );

function dangerbox($atts, $content=null, $code="") {
    extract(shortcode_atts(array("title"=>__('Title' , 'dobby')),$atts));
    $return = '<div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">';
    $return .= $title;
    $return .= '</h3></div><div class="panel-body">';
    $return .= $content;
    $return .= '</div></div>';
    return $return;
}
add_shortcode('dangerbox' , 'dangerbox' );

function youku($atts, $content=null, $code="") {
    $return = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" height="498" width="750" src="//player.youku.com/embed/';
    $return .= $content;
    $return .= '" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
    return $return;
}
add_shortcode('youku' , 'youku' );

function vqq($atts, $content=null, $code="") {
    extract(shortcode_atts(array("auto"=>'0'),$atts));
    $return = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" frameborder="0" width="640" height="498" src="//v.qq.com/iframe/player.html?vid=';
    $return .= $content;
    $return .= '&tiny=0&auto=';
    $return .= $auto;
    $return .= '" allowfullscreen></iframe></div>';
    return $return;
}
add_shortcode('vqq' , 'vqq' );

function youtube($atts, $content=null, $code="") {
    $return = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" height="498" width="750" src="//www.youtube.com/embed/';
    $return .= $content;
    $return .= '" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
    return $return;
}
add_shortcode('youtube' , 'youtube' );

function bilibili($atts, $content=null, $code="") {
    extract(shortcode_atts(array("cid"=>__('CID' , 'dobby')),$atts));
    $return = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" frameborder="0" scrolling="no" src="https://www.bilibili.com/blackboard/html5player.html?cid=';
    $return .= $cid;
    $return .= '&aid=';
    $return .= $content;
    $return .= '&enable_ssl=1&crossDomain=1&as_wide=1" allowfullscreen="true"></iframe></div>';
    return $return;
}
add_shortcode('bilibili' , 'bilibili' );

add_action('init', 'more_button_a');
function more_button_a() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons', 'register_button' );
   }
}

add_action('init', 'more_button_b');
function more_button_b() {
 if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
   return;
 }
 if ( get_user_option('rich_editing') == 'true' ) {
   add_filter( 'mce_external_plugins', 'add_plugin_b' );
   add_filter( 'mce_buttons_2', 'register_button_b' );
 }
}

function register_button( $buttons ) {
    array_push( $buttons, " ", "kbd" );
    array_push( $buttons, " ", "mark" );
    array_push( $buttons, " ", "striped" );
    array_push( $buttons, " ", "download" );
    array_push( $buttons, " ", "music" );
    array_push( $buttons, " ", "youku" );
    array_push( $buttons, " ", "vqq" );
    array_push( $buttons, " ", "youtube" );
    array_push( $buttons, " ", "bilibili" );
    return $buttons;
}

function register_button_b( $buttons ) {
  array_push( $buttons, " ", "success" );
  array_push( $buttons, " ", "info" );
  array_push( $buttons, " ", "warning" );
  array_push( $buttons, " ", "danger" );
  return $buttons;
}

function add_plugin( $plugin_array ) {
  $plugin_array['kbd'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['mark'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['striped'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['download'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['music'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['youku'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['vqq'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['youtube'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['bilibili'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  return $plugin_array;
}

function add_plugin_b( $plugin_array ) {
  $plugin_array['success'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['info'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['warning'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  $plugin_array['danger'] = get_bloginfo( 'template_url' ) . '/inc/buttons/more.js';
  return $plugin_array;
}

function add_more_buttons($buttons) {
  $buttons[] = 'hr';
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  $buttons[] = 'styleselect';
  return $buttons;
}
add_filter("mce_buttons_2", "add_more_buttons");

add_action('after_wp_tiny_mce', 'add_button_pre');
function add_button_pre($mce_settings) {
    ?>
    <script type="text/javascript">    
      QTags.addButton( 'pre', 'pre', "[pre]\n", "\n[/pre]\n" );
    </script>
    <?php
}

// add_filter('comment_text', 'do_shortcode');