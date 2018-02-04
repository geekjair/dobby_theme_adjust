<?php

/**
 * The template for content
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
?>
<article class="gamma-item globe-block p-3">
	<div class="header mt-1">
		<h2 class="title text-center">
			<a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="metas text-center mb-3">
			<span><?php echo get_the_date(); ?></span>
			<span class="d-none d-xl-inline-block"><?php comments_number('0', '1', '%'); ?> <?php _e('Comments' , 'dobby'); ?></span>
			<span><?php echo dobby_get_post_views(); ?> <?php _e('Views' , 'dobby'); ?></span>
			<span><?php if( get_post_meta($post->ID,'love',true) ){ echo num2tring(get_post_meta($post->ID,'love',true)); } else { echo '0'; }?> <?php _e('Thumb' , 'dobby'); ?></span>
		</div>
	</div>
	<div class="thumb mb-3">
		<?php dobby_thumbnail(); ?>
	</div>
	<div class="summary text-secondary">
		<p><?php echo wp_trim_words(get_the_excerpt(),150); ?></p>
	</div>
</article>