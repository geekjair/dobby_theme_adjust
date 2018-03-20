<?php

/**
 * The template for author page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header(); ?>
<main class="main author-page bg-light pb-4">
	<div class="container-fluid">
		<div class="row">
			<div class="banner-panel text-center" style="background-image: url(<?php echo dobby_option('image_default_author'); ?>);">
			</div>
			<div class="bg-white text-center w-100 pb-4">
				<div class="information">
				    <div class="author">
				        <div class="authorimg">
				        	<?php echo get_avatar( get_the_author_meta( 'user_email' ) ,115 ); ?>
				        </div>
				    </div>
				    <div class="content pt-5">
				        <p class="name pt-4"><?php echo get_the_author_meta('nickname'); ?></p>
				        <p class="motto"><?php if (get_the_author_meta('description')) { echo strip_tags(get_the_author_meta('description'));} else {_e('The person is so lazy that he left nothing.','dobby');} ?></p>
				    </div>
				</div>
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