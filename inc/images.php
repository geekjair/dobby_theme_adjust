<?php

/**
* Get share pictures url
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.3
* @return string url
* @global dobby_option('image_share_default')
*/
function dobby_share_image(){
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $post_thumbnail_id = get_post_thumbnail_id( $post );
        $img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
        $img = $img[0];
    }else{
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        if (!empty($strResult[1])) {
            $img = $strResult[1][0];
        }else{
            $img = dobby_option('image_default_share');
        }
    };
    if (is_home()){
        $img = dobby_option('image_default_share');
    }
    return $img;
}

/**
* Get post thumbnail
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.3
* @global dobby_option('image_default_thumbnail')
*/
add_theme_support( 'post-thumbnails' );

function dobby_thumbnail_image() {
  global $post;
  $img_id = get_post_thumbnail_id();
  $img_url = wp_get_attachment_image_src($img_id,'dobby-entry-thumb');
  $img_url = $img_url[0];
  if ( has_post_thumbnail() ) {
    echo '<a href="'.get_permalink().'"><img class="img-thumbnail" src="'.$img_url.'" alt="'.get_the_title().'" /></a>';
  } else {
    $content = $post->post_content;
    $img_preg = "/<img (.*?) src=\"(.+?)\".*?>/";
    preg_match($img_preg,$content,$img_src);
    $img_count=count($img_src) - 1;
    if (isset($img_src[$img_count]))
      $img_val = $img_src[$img_count];
    if(!empty($img_val)){
      echo '<a href="'.get_permalink().'"><img class="img-thumbnail" src="'.$img_val.'" alt="'.get_the_title().'" /></a>';
    } else {
      echo '<a href="'.get_permalink().'"><img class="img-thumbnail" src="'. dobby_option('image_default_thumbnail') .'" alt="'.get_the_title().'" /></a>';
    }
  }  
}