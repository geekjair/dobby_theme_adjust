<?php

/**
 * About author for single
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
?>
<div class="author mt-3 clearfix">
	<div class="meta float-md-left mb-2">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ) ,56 ); ?>
		<p class="name"><?php echo get_the_author_meta('nickname'); ?></p>
		<p class="motto mb-0"><?php if (get_the_author_meta('description')) { echo strip_tags(get_the_author_meta('description'));} else {_e('The person is so lazy that he left nothing.','dobby');} ?></p>
	</div>
	<div class="share float-md-right text-center">
		<?php if (dobby_option('donate_status')) { ?>
		<a href="javascript:;" id="donate" class="btn btn-donate mr-3" role="button"><i class="dobby v3-donate"></i> <?php _e('Donate','dobby')?></a>
		<?php } ?>
		<a href="javascript:;" id="thumbs" data-action="love" data-id="<?php the_ID(); ?>" role="button" class="btn btn-thumbs <?php if(isset($_COOKIE['love_'.$post->ID])) echo 'done';?>" ><i class="dobby v3-thumbs"></i><span class="ml-1"><?php _e('Thumbs','dobby')?></span></a>
	</div>
</div>