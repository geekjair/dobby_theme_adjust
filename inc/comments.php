<?php

/**
 * Add the reply WeChat push
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
if (dobby_option('single_comment_sc')) {
    add_action('comment_post', 'sc_send', 19, 2);
    function sc_send($comment_id) {
        $comment = get_comment($comment_id);
        $key = dobby_option('single_comment_key');
        $postdata = http_build_query(  
            array(  
            'text' => __('You have a new review','dobby'),  
            'desp' => $comment->comment_content
            )
        );
        $opts = array('http' =>  
            array(
            'method'  => 'POST',  
            'header'  => 'Content-type: application/x-www-form-urlencoded',  
            'content' => $postdata  
            )  
        );
        $context = stream_context_create($opts);
        return $result = file_get_contents('https://sc.ftqq.com/'.$key.'.send', false, $context);  
    }
}

/**
 * Add @ for reply
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
add_filter( 'comment_text' , 'dobby_comment_add_at', 20, 2);

function dobby_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<span">@'.get_comment_author( $comment->comment_parent ) . '</span> ' . $comment_text;
  }
  return $comment_text;
}

/**
 * Include scripts files
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_comment_scripts(){
    wp_enqueue_script( 'comment', get_template_directory_uri() . '/static/js/comments.min.js' , array(), DOBBY_VERSION);
    wp_localize_script( 'comment', 'ajaxcomment', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'order' => get_option('comment_order'),
        'formpostion' => 'bottom',
    ) );
}

/**
 * Comment 500 error
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

/**
 * Comment ajax callback
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function dobby_comment_callback(){
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
    if ( is_wp_error( $comment ) ) {
        $data = $comment->get_error_data();
        if ( ! empty( $data ) ) {
        	dobby_comment_err($comment->get_error_message());
        } else {
            exit;
        }
    }
    $user = wp_get_current_user();
    do_action('set_comment_cookies', $comment, $user);
    $GLOBALS['comment'] = $comment;
    ?>
    <li class="comment cleanfix" id="comment-<?php comment_ID(); ?>">
        <div class="avatar float-left d-inline-block mr-2">
            <?php if(function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 50); } ?>
        </div>
        <div class="info clearfix">
            <div class="clearfix">
                <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
                <div class="content mb-2">
                    <?php comment_text(); ?>
                </div>
            </div>
            <div class="clearfix">
                <div class="meta clearfix">
                    <span class="date float-left"><?php echo get_comment_date(); ?></span>
                </div>  
            </div>
        </div>
    </li>
    <?php die();
}

add_action('wp_enqueue_scripts', 'dobby_comment_scripts');
add_action('wp_ajax_nopriv_ajax_comment', 'dobby_comment_callback');
add_action('wp_ajax_ajax_comment', 'dobby_comment_callback');

function plc_comment_post( $incoming_comment ) { 
    $incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']); 
    $incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] ); 
    return( $incoming_comment ); 
} 
function plc_comment_display( $comment_to_display ) { 
    $comment_to_display = str_replace( '&apos;', "'", $comment_to_display ); 
    return $comment_to_display; 
} 

add_filter( 'preprocess_comment', 'plc_comment_post', '', 1); 
add_filter( 'comment_text', 'plc_comment_display', '', 1); 
add_filter( 'comment_text_rss', 'plc_comment_display', '', 1); 
add_filter( 'comment_excerpt', 'plc_comment_display', '', 1);