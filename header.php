<!DOCTYPE html>
<html lang="zh-hans">
	<head>
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="robots" content="index,follow">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="format-detection" content="telphone=no, email=no">
		<meta name="description" itemprop="description" content="<?php dobby_description(); ?>">
		<meta name="keywords" content="<?php dobby_keywords(); ?>">
		<meta itemprop="image" content="<?php echo dobby_share_image(); ?>" />
		<link rel="canonical" href="<?php echo dobby_current_url(); ?>"/>
		<link rel="icon" type="image/x-icon" href="<?php echo dobby_option('global_ico'); ?>">
		<?php wp_head(); ?>
		<?php wp_print_scripts('jquery'); ?>
	</head>
	<body>