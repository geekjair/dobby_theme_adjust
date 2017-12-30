<?php

/**
* Add the default avatar image
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
* @global dobby_option('image_default_gravatar')
*/
add_filter( 'avatar_defaults', 'dobby_gravatar' );

function dobby_gravatar ($avatar_defaults) {
    $azavatar = dobby_option('image_default_gravatar');
    $myavatar = ($azavatar) ? $azavatar : get_template_directory_uri() . '/images/avatar.png' ;  
    $avatar_defaults[$myavatar] = "Dobby Gravatar";  
    return $avatar_defaults;  
}

/**
* Nofollow the comments and images link
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
add_filter( 'comments_popup_link_attributes', 'dobby_nofollow_comments_link' );

function dobby_nofollow_comments_link() {
	return' rel="nofollow"';
}

add_filter( 'the_content', 'dobby_nofollow_images_link' );

function dobby_nofollow_images_link( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {
            $srcUrl = get_option('siteurl');
            for ($i=0; $i < count($matches); $i++)
            {
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
                $noFollow = '';
                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' target="_blank" ';
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' rel="nofollow" ';
                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}

/**
* Title Settings
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
* @return string title
*/
add_filter( 'wp_title', 'dobby_wp_title', 10, 2 );

function dobby_wp_title( $title, $sep ) {
  global $paged, $page;
  if ( is_feed() )
    return $title;
  $title .= get_bloginfo( 'name' );
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'dobby' ), max( $paged, $page ) );
  return $title;
}

/**
* Keyword Settings
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
* @global dobby_option('global_keywords')
*/
function dobby_keywords(){
  if( is_home() || is_front_page() ){ echo dobby_option('global_keywords'); }
  elseif( is_category() ){ single_cat_title(); }
  elseif( is_single() ){
    if ( has_tag() ) {foreach((get_the_tags()) as $tag ) { echo $tag->name.','; } }
    foreach((get_the_category()) as $category) { echo $category->cat_name; } 
  }
  elseif( is_search() ){ the_search_query(); }
  else{ echo trim(wp_title('',FALSE)); }
}

/**
* Description Settings
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
* @global dobby_option('global_description')
*/
function dobby_description(){
  if( is_home() || is_front_page() ){ echo trim(dobby_option('global_description')); }
  elseif( is_category() ){ $description = strip_tags(category_description());echo trim($description);}
    elseif( is_single() ){ 
    if(get_the_excerpt()){
      echo get_the_excerpt();
    }else{
      global $post;
      $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $post->post_content ) ) ) );
      echo mb_substr( $description, 0, 220, 'utf-8' );
    }
  }
  elseif( is_tag() ){  $description = strip_tags(tag_description());echo trim($description); }
  else{ $description = strip_tags(term_description());echo trim($description); }
}

/**
* Current the page url
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.3
* @return string url
*/
function dobby_current_url(){
    global $wp;
    return get_option( 'permalink_structure' ) == '' ? add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) : home_url( add_query_arg( array(), $wp->request ) );
}