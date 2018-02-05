<?php

/**
 * The template for single page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header(); ?>
	<?php if (dobby_option('single_layout') != 'alpha') {
		get_template_part('/inc/single/single-gamma', get_post_format());
	} else {
		get_template_part('/inc/single/single-alpha', get_post_format());
	}; ?>
<?php get_footer(); ?>