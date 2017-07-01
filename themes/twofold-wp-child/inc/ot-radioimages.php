<?php

function thb_filter_radio_images( $array, $field_id ) {
  
  /* only run the filter where the field ID is my_radio_images */
  if ( $field_id == 'album_layout' || $field_id == 'gallery_layout' ) {
    $array = array(
      array(
        'value'   => 'style1',
        'label'   => esc_html__( 'Masonry - Style 1', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/album/style1.jpg'
      ),
      array(
        'value'   => 'style2',
        'label'   => esc_html__( 'Masonry - Style 2', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/album/style2.jpg'
      ),
      array(
        'value'   => 'style3',
        'label'   => esc_html__( 'Masonry - Style 3', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/album/style3.jpg'
      ),
      array(
        'value'   => 'style4',
        'label'   => esc_html__( 'Grid', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/album/style4.jpg'
      ),
      array(
        'value'   => 'style6',
        'label'   => esc_html__( 'Grid v2', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/album/style6.jpg'
      ),
      array(
        'value'   => 'style5',
        'label'   => esc_html__( 'Vertical', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/album/style5.jpg'
      )
    );
  }
	if ( $field_id == 'collection_layout') {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Masonry', 'option-tree' ),
	      'src'     => THB_THEME_ROOT . '/assets/img/admin/collection/style1.jpg'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Vertical', 'option-tree' ),
	      'src'     => THB_THEME_ROOT . '/assets/img/admin/collection/style2.jpg'
	    ),
	    array(
	      'value'   => 'style3',
	      'label'   => esc_html__( 'Horizontal', 'option-tree' ),
	      'src'     => THB_THEME_ROOT . '/assets/img/admin/collection/style3.jpg'
	    )
	  );
	}
	if ( $field_id == 'demo-select' ) {
	  $array = array(
	    array(
	      'value'   => '0',
	      'label'   => esc_html__( 'Light Demo', 'option-tree' ),
	      'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/light.jpg'
	    ),
	    array(
	      'value'   => '1',
	      'label'   => esc_html__( 'Dark Demo', 'option-tree' ),
	      'src'     => THB_THEME_ROOT . '/assets/img/admin/demos/dark.jpg'
	    )
	  );
	}
  return $array;
  
}
add_filter( 'ot_radio_images', 'thb_filter_radio_images', 10, 2 );

function thb_filter_options_name() {
	return __('<a href="http://fuelthemes.net">Fuel Themes</a>', 'twofold');
}
add_filter( 'ot_header_version_text', 'thb_filter_options_name', 10, 2 );


function thb_filter_upload_name() {
	return esc_html__('Send to Theme Options', 'twofold');
}
add_filter( 'ot_upload_text', 'thb_filter_upload_name', 10, 2 );

function thb_header_list() {
	echo '<li class="theme_link"><a href="http://fuelthemes.ticksy.com/" target="_blank">Support Forum</a></li>';
	echo '<li class="theme_link right"><a href="http://wpeng.in/fuelt/" target="_blank">Recommended Hosting</a></li>';
	echo '<li class="theme_link right"><a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ" target="_blank">Purchase WPML</a></li>';
}
add_filter( 'ot_header_list', 'thb_header_list' );

function thb_filter_typography_fields( $array, $field_id ) {

	if ( $field_id == "title_type" || $field_id == "body_type") {
	  $array = array( 'font-family');
	}
	
	if ( $field_id == "album_font" || $field_id == "menu_font" || $field_id == "footer_font" || $field_id == "caption_font") {
	   $array = array( 'font-size', 'text-transform', 'font-weight', 'letter-spacing');
	}
	
	if ( $field_id == "footer_social_font") {
	   $array = array( 'font-size');
	}
	
	return $array;

}

add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields', 10, 2 );