<?php

/**
 * The template for header
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
?>
<!DOCTYPE html>
<html lang="zh-hans">
	<head>
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="robots" content="index,follow">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="format-detection" content="telphone=no, email=no">
		<meta name="description" content="<?php dobby_description(); ?>">
		<meta name="keywords" content="<?php dobby_keywords(); ?>">
		<meta itemprop="image" content="<?php if (is_home()) { echo dobby_option('image_default_share'); }else{ echo dobby_thumbnail_url(); } ?>"/>
		<meta name="description" itemprop="description" content="<?php dobby_description(); ?>" />
		<link rel="icon" type="image/x-icon" href="<?php echo dobby_option('global_ico'); ?>">
		<link rel="canonical" href="<?php echo dobby_current_url(); ?>"/>
		<?php wp_head(); ?>
		<?php wp_print_scripts('jquery'); ?>
	</head>
	<body>
		<header>
			<?php if (dobby_option('global_nav_layout') != 'alpha') { ?>
				<nav class="navbar navbar-expand-md fixed-top navbar-dark site-header">
					<div class="container d-flex justify-content-between">
					  <?php if ( has_nav_menu('header_menu') ) {?>
					  <button class="navbar-toggler p-0 border-0 nav-list" type="button" data-toggle="menu">
					    <span class="line first-line"></span>
					    <span class="line second-line"></span>
					    <span class="line third-line"></span>
					  </button>
					  <?php } ?>
					  <a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
					    <?php if ( is_user_logged_in() ) { ?> 
					      <a class="navbar-toggler avatars p-0 border-0" href="<?php echo admin_url(); ?>">
					        <?php global $current_user; wp_get_current_user(); echo get_avatar( $current_user->user_email ); ?>
					      </a>
					    <?php } else { ?> 
					      <a class="navbar-toggler p-0 border-0" href="<?php if(dobby_option('global_login')){ echo dobby_option('global_login');} else {echo wp_login_url( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );}?>">
					              <span class="dobby v3-users"></span>
					          </a>
					    <?php } ?>

					  <div class="navbar-collapse collapse">
					    <?php wp_nav_menu( array('theme_location' => 'header_menu','depth' => 2, 'container' => null, 'menu_class' => 'navbar-nav mr-auto', 'walker' => new WP_Bootstrap_Navwalker())); ?>
					  </div>
					</div>
				</nav>
			<?php } else{ ?>
			    <nav class="navbar navbar-expand-md fixed-top navbar-dark site-header">
			    	<?php if ( has_nav_menu('header_menu') ) {?>
			        <button class="navbar-toggler p-0 border-0 nav-list" type="button" data-toggle="menu">
			            <span class="line first-line"></span>
			            <span class="line second-line"></span>
			            <span class="line third-line"></span>
			        </button> 
			        <?php } ?>
			        <a class="navbar-brand navbar-full" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
			        <?php if ( is_user_logged_in() ) { ?> 
						<a class="navbar-toggler avatars p-0 border-0" href="<?php echo admin_url(); ?>">
							<?php global $current_user; wp_get_current_user(); echo get_avatar( $current_user->user_email ); ?>
				        </a>
					<?php } else { ?> 
						<a class="navbar-toggler p-0 border-0" href="<?php if(dobby_option('global_login')){ echo dobby_option('global_login');} else {echo wp_login_url( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );}?>">
				            <span class="dobby v3-users"></span>
				        </a>
					<?php } ?>
			        <div class="navbar-collapse full-collapse collapse ">
	        		<?php wp_nav_menu( array('theme_location' => 'header_menu', 'depth' => 2, 'container' => null, 'menu_class' => 'navbar-nav mr-auto', 'walker' => new WP_Bootstrap_Navwalker())); ?>
			            <form class="form-inline d-none d-lg-block" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
			              <input class="form-control mr-sm-2" type="search" id="search" name="s" placeholder="Search" aria-label="Search">
			              <button class="btn-search" type="submit">Search</button>
			            </form>
						<?php if ( is_user_logged_in() ) { ?> 
				            <div class="nav-brush ml-3 mr-2 d-none d-md-block">
								<?php if ( is_single() || is_page() ) { ?>
									<?php echo edit_post_link('<span class="dobby v3-brush"></span>'); ?>
								<?php } else { ?>
				                <a href="<?php echo admin_url(); ?>post-new.php"><span class="dobby v3-editor"></span></a>
				                <?php } ?>
				            </div>
						<?php } ?>
			            <div class="nav-users ml-3 mr-0 d-none d-md-block">
				        <?php if ( is_user_logged_in() ) { ?> 
							<a class="avatars" href="<?php echo admin_url(); ?>">
								<?php global $current_user; wp_get_current_user(); echo get_avatar( $current_user->user_email ); ?>
					        </a>
						<?php } else { ?> 
							<a href="<?php if(dobby_option('global_login')){ echo dobby_option('global_login');} else {echo wp_login_url( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );}?>">
					            <span class="text-gray">登录</span>
					        </a>
						<?php } ?>
			            </div>
			        </div>
			    </nav>
		    <?php } ?>
		</header>