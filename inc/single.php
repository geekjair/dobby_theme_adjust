<?php

/**
 * Allow Comments on Pages by Default
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 * @return open or close
 */
add_filter( 'get_default_comment_status', 'dobby_open_comments_for_pages', 10, 3 );
function dobby_open_comments_for_pages( $status, $post_type, $comment_type ) {
	if ( 'page' === $post_type ) {
		$status = 'open';
	}
	return $status;
}

/**
 * Private title format
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_filter( 'private_title_format', 'dobby_private_title_format' );
add_filter( 'protected_title_format', 'dobby_private_title_format' );
 
function dobby_private_title_format( $format ) {
    return '%s';
}

/**
 * Link to add nofollow
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function nofollow_compopup_link(){
    return' rel="nofollow"';
  }
add_filter('comments_popup_link_attributes','nofollow_compopup_link');

function imgnofollow( $content ) {
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
add_filter( 'the_content', 'imgnofollow');

/**
 * Points praise
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_love(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'love'){
        $raters = get_post_meta($id,'love',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie('love_'.$id,$id,$expire,'/',$domain,false);
        if (!$raters || !is_numeric($raters)) {
            update_post_meta($id, 'love', 1);
        } 
        else {
            update_post_meta($id, 'love', ($raters + 1));
        }
        echo get_post_meta($id,'love',true);
    } 
    die;
}
add_action('wp_ajax_nopriv_love', 'dobby_love');
add_action('wp_ajax_love', 'dobby_love');

/**
 * Smilies
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/static/images/smilies/'.$img;
}
function disable_emojis_tinymce( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}
function smilies_reset() {
    global $wpsmiliestrans, $wp_smiliessearch, $wp_version;
    if ( !get_option( 'use_smilies' ) || $wp_version < 4.2)
        return;
    $wpsmiliestrans = array(
    ':mrgreen:' => 'mrgreen.png',
    ':exclaim:' => 'exclaim.png',
    ':neutral:' => 'neutral.png',
    ':twisted:' => 'twisted.png',
      ':arrow:' => 'arrow.png',
        ':eek:' => 'eek.png',
      ':smile:' => 'smile.png',
   ':confused:' => 'confused.png',
       ':cool:' => 'cool.png',
       ':evil:' => 'evil.png',
    ':biggrin:' => 'biggrin.png',
       ':idea:' => 'idea.png',
    ':redface:' => 'redface.png',
       ':razz:' => 'razz.png',
   ':rolleyes:' => 'rolleyes.png',
       ':wink:' => 'wink.png',
        ':cry:' => 'cry.png',
        ':lol:' => 'lol.png',
        ':mad:' => 'mad.png',
   ':drooling:' => 'drooling.png',
':persevering:' => 'persevering.png',
    );
}
smilies_reset();

/**
 * Excerpt length
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_excerpt_length($length) {
    return 200;
}
add_filter('excerpt_length', 'dobby_excerpt_length');
function dobby_excerpt_more($more) {
    return '…';
}
add_filter('excerpt_more', 'dobby_excerpt_more');

/**
 * Get postviews
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_set_post_views()
{
  if (is_singular())
  {
    global $post;
    $post_ID = $post->ID;
    if($post_ID)
    {
      $post_views = (int)get_post_meta($post_ID, 'views', true);
      if(!update_post_meta($post_ID, 'views', ($post_views+1)))
      {
        add_post_meta($post_ID, 'views', 1, true);
      }
    }
  }
}
add_action('wp_head', 'dobby_set_post_views');
function dobby_get_post_views($before = '', $after = '', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  return num2tring($views);
}

/**
 * Get categoryname
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_category_name(){
  global $category;
  $category = get_the_category();
  return $category[0]->cat_name;
}

/**
 * Pagelist
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_filter('next_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn btn-primary btn-sm btn-loading"';
}

/**
 * Get the number of comments
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function findSinglecomments($postid=0,$which=0){
$comments = get_comments('status=approve&type=comment&post_id='.$postid);
  if ($comments) {
    $i=0; $j=0; $commentusers=array();
    foreach ($comments as $comment) {
      ++$i;
      if ($i==1) { $commentusers[] = $comment->comment_author_email; ++$j; }
      if ( !in_array($comment->comment_author_email, $commentusers) ) {
        $commentusers[] = $comment->comment_author_email;
        ++$j;
      }
    }
    $output = array($j,$i);
    $which = ($which == 0) ? 0 : 1;
    return $output[$which];
  }
  return 0;
}

/**
 * num optimize
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function num2tring($num) {
    if($num >= 1000) {
        $num = round($num / 1000 * 100) / 100 . 'k';
    } else {
        $num = $num;
    }
    return $num;
}

/**
 * Get the number of days that the article has been published
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function get_single_time(){
  $start = get_the_time('U');
  $difference = ((time() - $start));
  $last = (($difference/86400));
  return $last;
}

/**
 * Single comment alpha
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function comment_alpha($comment, $args, $depth) { $GLOBALS['comment'] = $comment; ?>
<li class="comment cleanfix" id="comment-<?php comment_ID(); ?>">
  <div class="avatar float-left d-inline-block mr-2">
    <?php if(function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 50); } ?>
  </div>
  <div class="info clearfix">
    <div class="clearfix">
      <?php printf('<cite class="author_name">%s</cite>', get_comment_author_link()); ?>
      <div class="content mb-2">
        <?php comment_text(); ?>
      </div>
    </div>
    <div class="clearfix">
      <div class="meta clearfix">
        <div class="date d-inline-block float-left"><?php echo get_comment_date(); ?></div>
        <div class="tool reply ml-2 d-inline-block float-right">
          <?php $defaults = array('add_below' => 'comment', 'respond_id' => 'respond', 'reply_text' => '<i class="dobby v3-reply"></i><span class="ml-1">'.__('Reply', 'dobby').'</span>');comment_reply_link(array_merge( $defaults, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
      </div>  
    </div>
  </div>
<?php }

/**
 * theme support
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_theme_support( 'post-formats', array('aside') );