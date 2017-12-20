<?php

/**
* Initialization Plugins
*
* @author Vtrois <seaton@vtrois.com>
* @license GPL-3.0
* @since 0.1.2
*/
require_once( get_template_directory() . '/inc/plugins/plugin-activation.php');

add_action( 'tgmpa_register', 'dobby_register_required_plugins' );

function dobby_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => __('Dobby - Html Compress' , 'dobby'),
			'slug'               => 'dobby-htmlcompress',
			'source'             => get_template_directory() . '/inc/plugins/dobby-htmlcompress.zip',
			'required'           => false,
			'version'            => '1.0',
			'external_url'       => 'https://www.vtrois.com/theme-dobby.html',
		),

	);

	$config = array(
		'id'           => 'dobby',
		'default_path' => '',
		'menu'         => 'dobby-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => false,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}