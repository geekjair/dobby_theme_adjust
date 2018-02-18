<?php

/**
 * The template for category page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header(); ?>
<main class="main bg-light pb-4">
	<div class="container-fluid">
		<div class="row">
			<div class="banner-panel text-center" style="background-image: url(<?php echo dobby_option('image_default_category'); ?>);">
				<h1 class="wow bounceInLeft"><?php echo single_cat_title('', false); ?></h1>
				<p class="wow bounceInRight pt-2 px-3"><?php echo strip_tags(category_description()); ?></p>
			</div>
		</div>
	</div>
	<div class="container pt-4">
		<div class="category-list row">
			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; $query = new WP_Query( array('paged'=> $paged ));while (have_posts()) : the_post();get_template_part('/inc/content/content-category', get_post_format());endwhile;wp_reset_query(); ?>
		</div>
		<div class="more text-center mt-4" id="categorypage">
			<?php next_posts_link( __('Load More' , 'dobby') ) ; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>