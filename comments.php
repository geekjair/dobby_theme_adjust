<?php

/**
 * The template for comments page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');?>
<?php require_once( get_template_directory() . '/inc/smilies.php'); ?>
<?php if ( comments_open() ) { ?>
<div class="comments-alpha mt-3">
	<h3 class="title mb-3"><?php _e('Article Comments','dobby') ?>（<?php comments_number('0', '1', '%'); ?>）</h3>
	<div class="list">
		<?php  wp_list_comments('type=comment&callback=comment_alpha'); ?>
	</div>
	<div id="commentpage" class="nav text-center my-3">
		<?php previous_comments_link( __('Load More' , 'dobby') ); ?>
	</div>
	<div id="respond" class="comment-respond mt-2">
		<?php if ( !comments_open() ) : elseif ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<div class="error text-center">
				<?php printf( __( 'You must <a href="%s">login</a> to comment','dobby' ) , wp_login_url( get_permalink()) ); ?>
			</div>
		<?php else : ?>
		<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
			<div class="comment-from">
				<?php if ( !is_user_logged_in() ) : ?>
				<div class="comment-info mb-3 row">
					<div class="col-md-6 comment-form-author">
						<input class="form-control" id="author" placeholder="昵称" name="author" type="text" value="<?php echo $comment_author; ?>" required="required">
					</div>
					<div class="col-md-6 mt-3 mt-md-0 comment-form-email">
						<input id="email" class="form-control" name="email" placeholder="邮箱" type="email" value="<?php echo $comment_author_email; ?>" required="required">
					</div>
				</div>
				<?php endif; ?>
				<div class="comment-textarea">
					<textarea class="form-control" id="comment" name="comment" rows="7" required="required"></textarea>
					<div class="text-bar clearfix">
						<div class="tool float-left">
							<a class="addbtn" href="#" id="addsmile"><i class="dobby v3-smile"></i></a>
							<div class="smile">
								<div class="clearfix">
									<?php echo $smilies; ?>
								</div>
							</div>
						</div>
						<div class="float-right">
							<?php cancel_comment_reply_link(__('Cancel', 'dobby')); ?>
							<input name="submit" type="submit" id="submit" class="btn btn-primary" value="<?php _e('Enter', 'dobby'); ?>">
						</div>
					</div>
				</div>
			</div>
		    <?php comment_id_fields(); ?>
		    <?php do_action('comment_form', $post->ID); ?>
		</form>

		<?php endif; ?>
	</div>
</div>
<?php } ?>