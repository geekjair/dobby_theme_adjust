<?php

/**
 * The template for optionsframework option page
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
function optionsframework_option_name() {
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	$imagepath =  get_template_directory_uri() . '/inc/options/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Global Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Function status' , 'dobby' ),
		'desc' => __( 'Whether to enable the web compression?' , 'dobby' ),
		'id' => 'global_html',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'Navbar layout' , 'dobby' ),
		'id' => "global_nav_layout",
		'std' => "alpha",
		'type' => "select",
		'class' => 'mini',
		'options' => array(
			'alpha' => __( 'Style 1', 'dobby' ),
			'gamma' => __( 'Style 2', 'dobby' ),
	));	

	$options[] = array(
		'name' => __( 'Favicon ico' , 'dobby' ),
		'id' => 'global_ico',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Default gravatar' , 'dobby' ),
		'id' => 'image_default_gravatar',
		'std' => get_template_directory_uri() . '/static/images/default/gravatar.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Keywords' , 'dobby' ),
		'id' => 'global_keywords',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Description' , 'dobby' ),
		'id' => 'global_description',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Login page url' , 'dobby' ),
		'id' => 'global_login',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __( 'ICP number' , 'dobby' ),
		'id' => 'footer_icp_num',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'GA number' , 'dobby' ),
		'id' => 'footer_gov_num',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'GA link' , 'dobby' ),
		'id' => 'footer_gov_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Index Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Function status' , 'dobby' ),
		'desc' => __( 'Whether to enable the index page?' , 'dobby' ),
		'id' => 'index_status',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'Project name' , 'dobby' ),
		'id' => 'index_project_1',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Project meta' , 'dobby' ),
		'id' => 'index_meta_1',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'Project single' , 'dobby' ),
		'id' => 'index_single_1',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Project name' , 'dobby' ),
		'id' => 'index_project_2',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Project meta' , 'dobby' ),
		'id' => 'index_meta_2',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'Project category' , 'dobby' ),
		'id' => 'index_category_2',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Project name' , 'dobby' ),
		'id' => 'index_project_3',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Project meta' , 'dobby' ),
		'id' => 'index_meta_3',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'Project category' , 'dobby' ),
		'id' => 'index_category_3',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Image Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Category banner' , 'dobby' ),
		'id' => 'image_default_category',
		'std' => get_template_directory_uri() . '/static/images/default/banner.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Tag banner' , 'dobby' ),
		'id' => 'image_default_tag',
		'std' => get_template_directory_uri() . '/static/images/default/banner.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Search banner' , 'dobby' ),
		'id' => 'image_default_search',
		'std' => get_template_directory_uri() . '/static/images/default/banner.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Default share images' , 'dobby' ),
		'id' => 'image_default_share',
		'std' => get_template_directory_uri() . '/static/images/default/thumbnail.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Default author images' , 'dobby' ),
		'id' => 'image_default_author',
		'std' => get_template_directory_uri() . '/static/images/default/author.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( '404 images' , 'dobby' ),
		'id' => 'image_default_404',
		'std' => get_template_directory_uri() . '/static/images/default/404.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Single Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Single layout' , 'dobby' ),
		'id' => "single_layout",
		'std' => "alpha",
		'type' => "select",
		'class' => 'mini',
		'options' => array(
			'alpha' => __( 'Style 1', 'dobby' ),
			'gamma' => __( 'Style 2', 'dobby' ),
	));	

	$options[] = array(
		'name' => __( 'WeChat push' , 'dobby' ),
		'desc' => __( 'Whether to enable Server Chan?' , 'dobby' ),
		'id' => 'single_comment_sc',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'SCKEY' , 'dobby' ),
		'id' => 'single_comment_key',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Index thumbnail' , 'dobby' ),
		'id' => 'image_thumbnail_index',
		'std' => get_template_directory_uri() . '/static/images/default/thumbnail.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Inside thumbnail' , 'dobby' ),
		'id' => 'image_thumbnail_inside',
		'std' => get_template_directory_uri() . '/static/images/default/thumbnail.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Copyright content' , 'dobby' ),
		'id' => 'single_copyright',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Page Config' , 'dobby' ),
		'type' => 'heading');
			
	$options[] = array(
		'name' => __( 'Page permalink' , 'dobby' ),
		'desc' => __( 'Whether to enable Page permalink?' , 'dobby' ),
		'id' => 'page_html',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'Mail Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'SMTP service' , 'dobby' ),
		'desc' => __( 'Whether to enable SMTP service?' , 'dobby' ),
		'id' => 'mail_smtps',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'Sender' , 'dobby' ),
		'id' => 'mail_name',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Mail server' , 'dobby' ),
		'id' => 'mail_host',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Server port' , 'dobby' ),
		'id' => 'mail_port',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Mail account' , 'dobby' ),
		'id' => 'mail_username',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Email password' , 'dobby' ),
		'id' => 'mail_passwd',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Enable SMTPAuth service' , 'dobby' ),
		'desc' => __( 'Whether to enable SMTPAuth service?' , 'dobby' ),
		'id' => 'mail_smtpauth',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'SMTPSecure set' , 'dobby' ),
		'id' => 'mail_smtpsecure',
		'std' => 'ssl',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'Carousel Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Function status' , 'dobby' ),
		'desc' => __( 'Whether to enable the carousel?' , 'dobby' ),
		'id' => 'carousel_status',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'The first image' , 'dobby' ),
		'id' => 'carousel_img_1',
		'type' => 'upload');

	$options[] = array(
		'name' => __( 'The first url' , 'dobby' ),
		'id' => 'carousel_url_1',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The first title' , 'dobby' ),
		'id' => 'carousel_title_1',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The first meta' , 'dobby' ),
		'id' => 'carousel_meta_1',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'The second image' , 'dobby' ),
		'id' => 'carousel_img_2',
		'type' => 'upload');

	$options[] = array(
		'name' => __( 'The second url' , 'dobby' ),
		'id' => 'carousel_url_2',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The second title' , 'dobby' ),
		'id' => 'carousel_title_2',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The second meta' , 'dobby' ),
		'id' => 'carousel_meta_2',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'The third image' , 'dobby' ),
		'id' => 'carousel_img_3',
		'type' => 'upload');

	$options[] = array(
		'name' => __( 'The third url' , 'dobby' ),
		'id' => 'carousel_url_3',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The third title' , 'dobby' ),
		'id' => 'carousel_title_3',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The third meta' , 'dobby' ),
		'id' => 'carousel_meta_3',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'The fourth image' , 'dobby' ),
		'id' => 'carousel_img_4',
		'type' => 'upload');

	$options[] = array(
		'name' => __( 'The fourth url' , 'dobby' ),
		'id' => 'carousel_url_4',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The fourth title' , 'dobby' ),
		'id' => 'carousel_title_4',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The fourth meta' , 'dobby' ),
		'id' => 'carousel_meta_4',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'The fifth image' , 'dobby' ),
		'id' => 'carousel_img_5',
		'type' => 'upload');

	$options[] = array(
		'name' => __( 'The fifth url' , 'dobby' ),
		'id' => 'carousel_url_5',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The fifth title' , 'dobby' ),
		'id' => 'carousel_title_5',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __( 'The fifth meta' , 'dobby' ),
		'id' => 'carousel_meta_5',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __( 'Donate Config' , 'dobby' ),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Function status' , 'dobby' ),
		'desc' => __( 'Whether to enable the donate?' , 'dobby' ),
		'id' => 'donate_status',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __( 'Alipay QR Code' , 'dobby' ),
		'id' => 'donate_alipay_qr',
		'std' => get_template_directory_uri() . '/static/images/default/qr.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __( 'Wechat QR Code' , 'dobby' ),
		'id' => 'donate_wechat_qr',
		'std' => get_template_directory_uri() . '/static/images/default/qr.png',
		'type' => 'upload');

	return $options;
}