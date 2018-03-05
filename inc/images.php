<?php

/**
 * Get the pictures url
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 * @return string url
 * @global dobby_option('image_thumbnail_inside'), dobby_option('image_thumbnail_share')
 */
function dobby_thumbnail_url(){
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
          if (is_category('document')) {
            $img = dobby_option('image_thumbnail_document');
          } else {
            $img = dobby_option('image_thumbnail_inside');
          }
        }
    };
    return $img;
}

/**
 * Get post thumbnail
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 * @global dobby_option('image_thumbnail_index')
 */
add_theme_support( 'post-thumbnails' );

function dobby_thumbnail() {
  global $post;
  $img_id = get_post_thumbnail_id();
  $img_url = wp_get_attachment_image_src($img_id,'dobby-entry-thumb');
  $img_url = $img_url[0];
  if ( has_post_thumbnail() ) {
    echo '<a href="'.get_permalink().'"><div class="thumbnail" style="background-image: url('.$img_url.')"></div></a>';
  } else {
    $content = $post->post_content;
    $img_preg = "/<img (.*?) src=\"(.+?)\".*?>/";
    preg_match($img_preg,$content,$img_src);
    $img_count=count($img_src) - 1;
    if (isset($img_src[$img_count]))
      $img_val = $img_src[$img_count];
    if(!empty($img_val)){
      echo '<a href="'.get_permalink().'"><div class="thumbnail" style="background-image: url('.$img_val.')"></div></a>';
    } else {
      echo '<a href="'.get_permalink().'"><div class="thumbnail" style="background-image: url('. dobby_option('image_thumbnail_index') .')"></div></a>';
    }
  }  
}

function dobby_thumbnail_aside() {
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
      echo '<a href="'.get_permalink().'"><img class="img-thumbnail" src="'. dobby_option('image_thumbnail_index') .'" alt="'.get_the_title().'" /></a>';
    }
  }  
}