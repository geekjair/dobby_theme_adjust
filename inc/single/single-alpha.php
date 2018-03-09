<?php

/**
 * The template for single alpha
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
?>
<main class="main alpha-content bg-white">
	<?php if (have_posts()) : the_post(); update_post_caches($posts);$shareData = array( 'url' => get_permalink(), 'title' => $post->post_title, 'excerpt' => get_the_excerpt(), 'img' => dobby_thumbnail_url(), ); wp_localize_script( 'share', 'sr', $shareData );?>
	    <div class="container">
			<div class="row">
				<div class="col-md-12 d-none d-sm-block pt-1">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="<?php echo get_option('home'); ?>"><?php _e('Home', 'dobby'); ?></a></li>
					    <li class="breadcrumb-item"><?php $cats = get_the_category(); $cat = $cats[0]; echo get_category_parents($cat->term_id,true,''); ?></li>
					    <li class="breadcrumb-item active" aria-current="page"><?php _e('Article', 'dobby'); ?></li>
					  </ol>
					</nav>
				</div>
				<div class="col-md-12 pb-4">
					<div class="post-bar">
						<div class="bg-thumbnail" style="background-image:url(<?php echo dobby_thumbnail_url(); ?>)">
						</div>
						<div class="meta text-center text-white">
							<h1><?php the_title(); ?></h1>
							<div class="about pt-2 pt-md-3">
								<span class="d-inline-block"><i class="dobby v3-activity"></i> <?php echo get_the_date(); ?></span>
								<span class="d-none d-md-inline-block"><i class="dobby v3-interactive"></i> <?php comments_number('0', '1', '%'); ?> <?php _e('Comments' , 'dobby'); ?></span>
								<span class="d-inline-block"><i class="dobby v3-browse"></i> <?php echo dobby_get_post_views(); ?> <?php _e('Views' , 'dobby'); ?></span>
								<span class="d-inline-block"><i class="dobby v3-praise"></i> <?php if( get_post_meta($post->ID,'love',true) ){ echo num2tring(get_post_meta($post->ID,'love',true)); } else { echo '0'; }?> <?php _e('Thumb' , 'dobby'); ?></span>
							</div>
							<div class="share-group pt-3 pt-md-4">
								<a href="javascript:;" class="plain twitter" onclick="share('qq');" rel="nofollow">
									<div class="wrap">
										<i class="dobby v3-qq"></i>
									</div>
								</a>
								<a href="javascript:;" class="plain weibo" onclick="share('weibo');" rel="nofollow">
									<div class="wrap">
										<i class="dobby v3-weibo"></i>
									</div>
								</a>
								<a href="javascript:;" class="plain qzone style-plain" onclick="share('qzone');" rel="nofollow">
									<div class="wrap">
										<i class="dobby v3-qzone"></i>
									</div>
								</a>
								<a href="javascript:;" class="plain twitter style-plain" onclick="share('twitter');" rel="nofollow">
									<div class="wrap">
										<i class="dobby v3-twitter"></i>
									</div>
								</a>
							</div>
						</div>
					</div>
					<div class="container pt-3">
						<div class="row">
							<article class="article col-lg-8">
								<div class="content"><?php the_content(); ?></div>
								<div class="copyright mt-3 clearfix">
									<div class="tags float-left d-none d-md-block d-lg-block">
										<span class="dobby v3-label_fill"></span>
										<?php if ( get_the_tags() ) { the_tags('', ' ', ''); } else{ echo '<a>' . __( 'None' , 'dobby') . '</a>';  }?>
									</div>
									<div class="float-right">
										<span id="copyright"><?php _e('© The copyright belongs to the author','dobby'); ?></span>
									</div>
								</div>
								<?php require_once( get_template_directory() . '/inc/author.php'); ?>
								<?php comments_template(); ?>
							</article>
							<aside class="aside-widget col-lg-4 d-none d-lg-block d-xl-block">
								<div id="stickysingle">
									<?php dynamic_sidebar('sidebar_single'); ?>
								</div>
							</aside>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif;?>
</main>
