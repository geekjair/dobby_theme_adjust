<?php

/**
* Allow Comments on Pages by Default
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
* @return open or close
*/
add_filter( 'get_default_comment_status', 'dobby_open_comments_for_pages', 10, 3 );
function dobby_open_comments_for_pages( $status, $post_type, $comment_type ) {
	if ( 'page' === $post_type ) {
		$status = 'open';
	}
	return $status;
}

