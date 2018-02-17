<?php

/**
 * The template for 404 page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header(); ?>
<main class="main page404 bg-white py-4">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="thumbnail" style="background-image: url(<?php echo dobby_option('image_default_404'); ?>">
					<div class="overlay"></div>
				</div>
			</div>
			<div class="col-md-12 text-center meta py-3">
				<h2><?php _e( 'Sorry, that page you visited does not exist' , 'dobby' ); ?></h2>
            	<h3 class="pt-3"><?php _e( 'It may be the incorrect input address or the address has been deleted' , 'dobby' ); ?></h3>
            	<p class="pt-3">
            		<a href="javascript:history.go(-1)" class="btn btn-outline-primary back-prevpage"><?php _e( 'Return' , 'dobby' ); ?></a>
            		<a href="<?php echo get_option('home'); ?>" class="btn btn-outline-primary ml-3 back-index"><?php _e( 'Homepage' , 'dobby' ); ?></a>
            	</p>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>