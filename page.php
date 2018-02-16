<?php

/**
 * The template for default page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header(); ?>
<main class="main alpha-content bg-white pb-4">
	<div class="container">
		<div class="row">
			<article class="article col-12 fluid pt-4">
				<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
				<div class="text-center text-dark">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="content"><?php the_content(); ?></div>
				<?php endif; ?>
				<?php comments_template(); ?>
			</article>
		</div>
	</div>
</main>
<?php get_footer(); ?>