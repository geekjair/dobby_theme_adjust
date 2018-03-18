<?php

/**
 * Add the default avatar image
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
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
 * @since 1.0
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
 * @since 1.0
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
 * @since 1.0
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
 * @since 1.0
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
 * @since 1.0
 * @return string url
 */
function dobby_current_url(){
    global $wp;
    return get_option( 'permalink_structure' ) == '' ? add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) : home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Html Compress
 *
 * Sed to compress the page size and improve loading speed.
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
if (dobby_option('global_html')) {
  add_action('get_header', 'dobby_compress_html');
  add_filter( "the_content", "dobby_unCompress");
}

function dobby_compress_html(){
  function dobby_compress_html_main ($buffer){
    $initial=strlen($buffer);
    $buffer=explode("<!--Dobby-Compress-html-->", $buffer);
    $count=count ($buffer);
    for ($i = 0; $i <= $count; $i++){
        if (stristr($buffer[$i], '<!--Dobby-Compress-html-no-compression-->')) {
            $buffer[$i]=(str_replace("<!--Dobby-Compress-html-no-compression-->", " ", $buffer[$i]));
        } else {
            $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
            $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
            $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
            $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
            while (stristr($buffer[$i], '  ')) {
                $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
            }
        }
        $buffer_out.=$buffer[$i];
    }
    $final=strlen($buffer_out);   
    $savings=($initial-$final)/$initial*100;   
    $savings=round($savings, 2);   
    $buffer_out.="\n<!-- Initial: $initial bytes; Final: $final bytes; Reduce：$savings% :D -->";   
    return $buffer_out;
  }
  ob_start("dobby_compress_html_main");
}

function dobby_unCompress($content) {
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--Dobby-Compress-html--><!--Dobby-Compress-html-no-compression-->'.$content;
        $content.= '<!--Dobby-Compress-html-no-compression--><!--Dobby-Compress-html-->';
    }
    return $content;
}

/**
 * Page Permalink
 *
 * Open the pseudo-static rule of the page.
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_action('init', 'dobby_page_permalink', -1);
function dobby_page_permalink() {
    if (dobby_option('page_html')){
        global $wp_rewrite;
        if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
            $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
        }
    }
}
/**
 * Carousel
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_carousel(){
  $output = '';
  $carousel = dobby_option("carousel_status") ? dobby_option("carousel_status") : 0;
  if($carousel){
    for($i=1; $i<6; $i++){
        $dobby_carousel_img{$i} = dobby_option("carousel_img_{$i}") ? dobby_option("carousel_img_{$i}") : "";
        $dobby_carousel_url{$i} = dobby_option("carousel_url_{$i}") ? dobby_option("carousel_url_{$i}") : "";
        $dobby_carousel_title{$i} = dobby_option("carousel_title_{$i}") ? dobby_option("carousel_title_{$i}") : "";
        $dobby_carousel_meta{$i} = dobby_option("carousel_meta_{$i}") ? dobby_option("carousel_meta_{$i}") : "";
        if($dobby_carousel_img{$i} ){
            $carousel_img[] = $dobby_carousel_img{$i};
            $carousel_url[] = $dobby_carousel_url{$i};
            $carousel_title[] = $dobby_carousel_title{$i};
            $carousel_meta[] = $dobby_carousel_meta{$i};
        }
    }
    $count = count($carousel_img);
    for($i=0; $i<$count; $i++){
        $output .= '<li style="background-image: url('.$carousel_img[$i].');"><div class="overlay-gradient"></div><div class="container"><div class="row"><div class="col-lg-6 slider-text"><div class="slider-text-inner"><div class="desc"><h2>'.$carousel_title[$i].'</h2><p class="meta">'.$carousel_meta[$i].'</p><p class="more"><a href="'.$carousel_url[$i].'" class="btn btn-outline-primary">'.__('Read More','dobby').'</a></p></div></div></div></div></div></li>';
    };
  };
  echo $output;
}

/**
 * Timeago
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function timeago($ptime){
  $ptime = strtotime($ptime);
  $etime = time() - $ptime;
  if($etime < 1)
    return'刚刚';
  $interval = array(
    12*30*24*60*60 => ' 年前（'.date('m月d日',$ptime).'）',
    30*24*60*60 => ' 个月前（'.date('m月d日',$ptime).'）',
    7*24*60*60 => ' 周前（'.date('m月d日',$ptime).'）',
    24*60*60 => ' 天前（'.date('m月d日',$ptime).'）',
    60*60 => ' 小时前（'.date('m月d日',$ptime).'）',
    60 => ' 分钟前（'.date('m月d日',$ptime).'）',
    1 => ' 秒前（'.date('m月d日',$ptime).'）',
  );
  foreach($interval as$secs=>$str){
    $d=$etime/$secs;
    if($d>=1){
    $r=round($d);
    return$r.$str;
    }
  };
}

/**
 * String cut
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_string_cut($string, $sublen, $start = 0, $code = 'UTF-8') {
   if($code == 'UTF-8') {
      $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
      preg_match_all($pa, $string, $t_string);
      if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)) . "...";
      return join('', array_slice($t_string[0], $start, $sublen));
  } else {
    $start = $start * 2;
    $sublen = $sublen * 2;
    $strlen = strlen($string);
    $tmpstr = '';
    for($i = 0; $i < $strlen; $i++) {
    if($i >= $start && $i < ($start + $sublen)) {
        if(ord(substr($string, $i, 1)) > 129) $tmpstr .= substr($string, $i, 2);
        else $tmpstr .= substr($string, $i, 1);
   }
      if(ord(substr($string, $i, 1)) > 129) $i++;
    }
      return $tmpstr;
  }
}

/**
 * Latest comments
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_latest_comments($list_number=5, $cut_length=50) {
  global $wpdb,$output;
  $comments = $wpdb->get_results("SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, comment_content AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND user_id != '1' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $list_number");
  foreach ($comments as $comment) {
    $output .= '<a href="'. get_the_permalink($comment->comment_post_ID) .'#dobby-comments" title="'. __( 'Publish in:' , 'dobby').' '. $comment->post_title .'"><div class="meta clearfix"><div class="avatar float-left">'.get_avatar( $comment, 60 ).'</div><div class="profile d-block"><span class="date">发布于 '.timeago($comment->comment_date_gmt).'</span><span class="message d-block">'.convert_smilies(dobby_string_cut(strip_tags($comment->com_excerpt), $cut_length)).'</span></div></div></a>';
  }
  return $output;
}

/**
 * Add the smilies button for admin
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_action('media_buttons_context', 'dobby_smilies_custom_button');
function dobby_smilies_custom_button($context) {
    $context .= '<style>.smilies-wrap{background:#fff;border: 1px solid #ccc;box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.24);padding: 10px;position: absolute;top: 60px;width: 400px;display:none}.smilies-wrap img{height:24px;width:24px;cursor:pointer;margin-bottom:5px} .is-active.smilies-wrap{display:block}</style><a id="insert-media-button" style="position:relative" class="button insert-smilies add_smilies" data-editor="content" href="javascript:;"><span class="dashicons dashicons-smiley" style="line-height: 26px;"></span>'.__( 'Add the expression', 'dobby' ).'</a><div class="smilies-wrap">'. dobby_get_wpsmiliestrans() .'</div><script>jQuery(document).ready(function(){jQuery(document).on("click", ".insert-smilies",function() { if(jQuery(".smilies-wrap").hasClass("is-active")){jQuery(".smilies-wrap").removeClass("is-active");}else{jQuery(".smilies-wrap").addClass("is-active");}});jQuery(document).on("click", ".add-smily",function() { send_to_editor(" " + jQuery(this).data("smilies") + " ");jQuery(".smilies-wrap").removeClass("is-active");return false;});});</script>';
    return $context;
}

function dobby_get_wpsmiliestrans(){
    global $wpsmiliestrans;
    global $output;
    $wpsmilies = array_unique($wpsmiliestrans);
    foreach($wpsmilies as $alt => $src_path){
        $output .= '<a class="add-smily" data-smilies="'.$alt.'"><img class="wp-smiley" src="'.get_bloginfo('template_directory').'/static/images/smilies/'.rtrim($src_path, "png").'png" /></a>';
    }
    return $output;
}