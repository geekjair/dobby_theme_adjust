<?php

/**
 * The main template file
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
get_header();if(is_home() && dobby_option('index_status')){ ?>
<main class="main home-page bg-white">
	<?php if (dobby_option("carousel_status")) { ?>
		<div class="container-fluid">
			<div id="home-slider" class="slider row">
				<div class="flexslider">
					<ul class="slides">
						<?php dobby_carousel(); ?>
				  	</ul>
			  	</div>
			</div>
		</div>
	<?php } ?>
	<?php if (dobby_option('index_project_1')) { ?>
	<div class="sort">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h2><?php echo dobby_option('index_project_1'); ?></h2>
					<p class="mt-4"><?php echo dobby_option('index_meta_1'); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<ul class="sortc-list">
					<?php query_posts(array('posts_per_page'=>4, 'post__in' => explode(',', dobby_option('index_single_1'))));?>
					<?php while (have_posts()) : the_post(); ?>
						<li class="sortc" style="background-image: url(<?php echo dobby_thumbnail_url(); ?>); ">
							<a href="<?php the_permalink(); ?>" class="text-white">
								<div class="meta">
									<span><?php foreach((get_the_category()) as $category) { echo $category->cat_name; } ?></span>
									<h2><?php the_title(); ?></h2>
								</div>
							</a>
						</li>
					<?php endwhile;wp_reset_query(); ?>
					</ul>		
				</div>
			</div>
		</div>
	</div>
	<?php } if (dobby_option('index_project_2')) { ?>
	<div class="sort bg-light">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h2><?php echo dobby_option('index_project_2'); ?></h2>
					<p class="mt-4"><?php echo dobby_option('index_meta_2'); ?></p>
				</div>
			</div>
			<div class="row">
				<?php query_posts('showposts=6&cat=' . dobby_option('index_category_2') . '')?> 
				<?php while (have_posts()) : the_post(); ?>
				<div class="col-lg-4 col-md-6">
					<div class="sortb sortb my-3 my-lg-4">
						<a href="<?php the_permalink() ?>"><img class="thumbnail" src="<?php echo dobby_thumbnail_url(); ?>" alt=""></a>
						<div class="meta">
							<h3><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h3>
							<span class="category"><?php foreach((get_the_category()) as $category) { echo $category->cat_name; } ?></span>
							<p><?php echo wp_trim_words(get_the_excerpt(),150); ?></p>
						</div> 
					</div>
				</div>
				<?php endwhile;wp_reset_query(); ?>
			</div>
		</div>
	</div>	
	<?php } if (dobby_option('index_project_3')) { ?>
	<div class="sort">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h2><?php echo dobby_option('index_project_3'); ?></h2>
					<p class="mt-4"><?php echo dobby_option('index_meta_3'); ?></p>
				</div>
			</div>
			<div class="row">
			<?php query_posts('showposts=6&cat=' . dobby_option('index_category_3') . '')?> 
			<?php while (have_posts()) : the_post(); ?>
				<div class="col-md-6 col-lg-4">
					<div class="sorta sortb my-3 my-lg-4" style="background-image:url(<?php echo dobby_thumbnail_url(); ?>);">
						<a href="<?php the_permalink(); ?>" class="desc text-dark">
							<span><?php foreach((get_the_category()) as $category) { echo $category->cat_name; } ?></span>
							<h3 class="mt-2"><?php the_title(); ?></h3>
						</a>
					</div>
				</div>
			<?php endwhile;wp_reset_query();  ?>
			</div>
		</div>
	</div>			
	<?php } ?>
</main>
<?php } elseif(is_home()){?>
<main class="main index-page bg-light pb-4">
<?php if (dobby_option("carousel_status")) { ?>
	<div class="container-fluid">
		<div id="home-slider" class="slider row">
			<div class="flexslider">
				<ul class="slides">
					<?php dobby_carousel(); ?>
			  	</ul>
		  	</div>
		</div>
	</div>
<?php } ?>
	<div class="container pt-4">
		<div class="row">
			<div class="col-lg-8">
				<div class="gamma-list">
					<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; $query = new WP_Query( array('paged'=> $paged ));while (have_posts()) : the_post();get_template_part('/inc/content/content', get_post_format());endwhile;wp_reset_query(); ?>
				</div>
				<div class="more text-center mt-4" id="articlepage">
					<?php next_posts_link( __('Load More' , 'dobby') ) ; ?>
				</div>
			</div>
			<aside class="aside-widget col-lg-4 d-none d-lg-block d-xl-block">
				<div id="stickyindex">
					<?php dynamic_sidebar('sidebar_index'); ?>
				</div>
			</aside>
		</div>
	</div>
</main>
<?php }; get_footer(); ?>