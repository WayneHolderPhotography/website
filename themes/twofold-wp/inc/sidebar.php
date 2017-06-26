<?php
function thb_register_sidebars() {
	if ( thb_wc_supported() ) {
		register_sidebar(array('name' => esc_html__('Shop Sidebar', 'twofold'), 'id' => 'shop', 'description' => esc_html__('Sidebar for the Shop page', 'twofold'), 'before_widget' => '<div id="%1$s" class="widget woo cf %2$s">', 'after_widget' => '</div></div>', 'before_title' => '<h6>', 'after_title' => '</h6><div class="widget_content">'));
	}
}
add_action( 'widgets_init', 'thb_register_sidebars' );