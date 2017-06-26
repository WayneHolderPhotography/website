<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {
	global $post;
	
	// Enqueue 
	//wp_enqueue_style('foundation', THB_THEME_ROOT . '/assets/css/foundation.css', null, null);
	wp_enqueue_style("fa", THB_THEME_ROOT . '/assets/css/font-awesome.min.css', null, null);
	wp_enqueue_style('thb-app', THB_THEME_ROOT .  "/assets/css/app.css", null, null);
	wp_enqueue_style('style', get_stylesheet_uri(), null, null);	
	
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont() );
	wp_add_inline_style( 'thb-app', thb_selection() );
	
	if ( is_page_template( 'template-contact.php' ) ) {
		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}

add_action('wp_enqueue_scripts', 'thb_main_styles');


// Main Scripts
function thb_register_js() {
	
	if (!is_admin()) {
		global $post;
		$thb_api_key = ot_get_option('map_api_key');
		
		// Register 
		wp_enqueue_script('thb-vendor', THB_THEME_ROOT . '/assets/js/vendor.min.js', array('jquery'), null, TRUE);
		wp_enqueue_script('thb-app', THB_THEME_ROOT . '/assets/js/app.min.js', array('jquery', 'thb-vendor'), null, TRUE);

		// Enqueue
		if ( is_page_template( 'template-contact.php' ) ) {
			wp_enqueue_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.$thb_api_key.'', false, null, false);
			
			if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ) {
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script('thb-vendor');
		wp_enqueue_script('thb-app');
		wp_localize_script( 'thb-app', 'themeajax', array( 
			'url' => admin_url( 'admin-ajax.php' ),
			'settings' => array (
					'lightbox_autoplay_duration' => ot_get_option('lightbox_autoplay_duration', '5')
			),
			'l10n' => array (
				'loading' => __("Loading ...", 'twofold'),
				'nomore' => __("Nothing left to load", 'twofold'),
				'added' => esc_html__("Added To Cart", 'twofold'),
				'added_svg' => thb_load_template_part('assets/svg/arrows_check.svg')
			)
		) );
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

// Admin Scripts
function thb_admin_scripts() {
	wp_enqueue_script('thb-admin-meta', THB_THEME_ROOT .'/assets/js/admin-meta.min.js', array('jquery'));
	wp_enqueue_style("thb-admin-css", THB_THEME_ROOT . "/assets/css/admin.css");
}
add_action('admin_enqueue_scripts', 'thb_admin_scripts');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
/* WooCommerce */
if(thb_wc_supported()) {
	function thb_woocommerce_scripts() {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}
	add_action('wp_enqueue_scripts', 'thb_woocommerce_scripts');
}