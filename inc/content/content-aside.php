<?php

/**
 * The template for aside
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
?>
<article class="aside-item card">
	<div class="card-body p-0">
		<div class="card-thumb">
			<?php dobby_thumbnail_aside(); ?>
		</div>
		<div class="card-box">
			<h2 class="card-title"><a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="card-text"><?php echo wp_trim_words(get_the_excerpt(),150); ?></p>
		</div>
	</div>
	<div class="card-footer">
		<small class="clearfix">
			<span class="float-left">
				<a href="<?php the_permalink(); ?>"><i class="dobby v3-activity"></i> <?php echo get_the_date(); ?></a>
				<a class="ml-2" href="<?php the_permalink(); ?>"><i class="dobby v3-browse"></i> <?php echo dobby_get_post_views(); ?> <?php _e('Views' , 'dobby'); ?></a>
			</span>
			<span class="float-left d-none d-md-block d-lg-block">
				<a class="ml-2" href="<?php the_permalink(); ?>#respond"><i class="dobby v3-interactive"></i> <?php comments_number('0', '1', '%'); ?> <?php _e('Comments' , 'dobby'); ?></a>
				<a class="ml-2" href="<?php the_permalink(); ?>"><i class="dobby v3-thumbs"></i> <?php if( get_post_meta($post->ID,'love',true) ){ echo num2tring(get_post_meta($post->ID,'love',true)); } else { echo '0'; }?> <?php _e('Thumb' , 'dobby'); ?></a>
			</span>
			<span class="float-right">
				<a href="<?php the_permalink(); ?>"><?php _e('Read More' , 'dobby'); ?> <i class="dobby v3-arrow"></i></a>
			</span>
		</small>
	</div>
</article>