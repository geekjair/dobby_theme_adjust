<?php

/**
 * The template for search page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header(); ?>
<main class="main bg-light pb-4">
	<?php if (have_posts()) : ?>
	<div class="container-fluid">
		<div class="row">
			<div class="banner-panel text-center" style="background-image: url(<?php echo dobby_option('image_default_search'); ?>);">
				<h1 class="mt-4"><?php the_search_query(); ?></h1>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="container pt-4">
		<?php if (have_posts()) : ?>
		<div class="category-list row">
			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; $query = new WP_Query( array('paged'=> $paged ));while (have_posts()) : the_post();get_template_part('/inc/content/content-category', get_post_format());endwhile;wp_reset_query(); ?>
		</div>
		<div class="more text-center mt-4" id="categorypage">
			<?php next_posts_link( __('Load More' , 'dobby') ) ; ?>
		</div>
		<?php else: ?>
		<div class="search-none-from text-center">
		    <span><img src="<?php echo bloginfo('template_url'); ?>/static/images/search.svg"></span>
		    <p class="mt-3"><?php _e('There is nothing you need for the time being','dobby'); ?></p>
		</div>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>