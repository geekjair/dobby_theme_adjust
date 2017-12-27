<?php

function optionsframework_option_name() {
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Global config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' =>  __( 'Example Background', 'dobby' ),
		'desc' => __( 'Change the background CSS.', 'dobby' ),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background'
	);

	$options[] = array(
		'name' => __( 'Site Options' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Banner config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Single' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Page' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Links config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Mail config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Footer configuration' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Donate Component' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Social Component' , 'dobby' ),
		'type' => 'heading');

	return $options;
}