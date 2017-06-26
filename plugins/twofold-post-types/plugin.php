<?php
/**
 * Plugin Name: TwoFold - Custom Post Types
 * Description: This contains the custom post types needed for the theme functionality
 * Version: 1.0.2
 * Author: fuelthemes
 * Author URI: http://themeforest.net/user/fuelthemes
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */
if (!function_exists('wp_crop_image')) {
	require ABSPATH . 'wp-admin/includes/image.php';
}
/* Albums */
function thb_post_type_album() {
	$album_slug = function_exists('ot_get_option') ? sanitize_title(ot_get_option('album_slug','album')) : 'album';
	$labels = array(
		'name' => __( 'Albums','twofold'),
		'singular_name' => __( 'Album','twofold' ),
		'rewrite' => array('slug' => __( 'album','twofold' )),
		'add_new' => _x('Add New Album', 'album', 'twofold'),
		'add_new_item' => __('Add New Album','twofold'),
		'edit_item' => __('Edit Album','twofold'),
		'new_item' => __('New Album','twofold'),
		'view_item' => __('View Album','twofold')
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => array('slug' => $album_slug, 'with_front' => false),
		'has_archive' => false,
		'menu_icon' => 'dashicons-schedule',
		'capability_type' => 'post',
		'supports' => array('title','editor', 'thumbnail', 'comments')
	  ); 
	  
	  register_post_type('album',$args);
	  flush_rewrite_rules();
	  
	  $category_labels = array(
	  	'name' => __( 'Categories', 'twofold'),
	  	'singular_name' => __( 'Category', 'twofold'),
	  	'search_items' =>  __( 'Search Categories', 'twofold'),
	  	'all_items' => __( 'All Categories', 'twofold'),
	  	'edit_item' => __( 'Edit Category', 'twofold'),
	  	'update_item' => __( 'Update Category', 'twofold'),
	  	'add_new_item' => __( 'Add New Category', 'twofold'),
	    'menu_name' => __( 'Album Categories', 'twofold')
	  ); 	
	  
	  register_taxonomy(
	  		"album-category", 
	  		array("album"), 
	  		array("hierarchical" => true, 
	  				'labels' => $category_labels,
	  				'show_ui' => true,
	      		'query_var' => true
	  ));
}

/* Gallery */
function thb_post_type_gallery() {
	$gallery_slug = function_exists('ot_get_option') ? sanitize_title(ot_get_option('gallery_slug','gallery')) : 'gallery';
	$labels = array(
		'name' => __( 'Galleries','twofold'),
		'singular_name' => __( 'Gallery','twofold' ),
		'rewrite' => array('slug' => __( 'gallery','twofold' )),
		'add_new' => _x('Add New Gallery', 'gallery', 'twofold'),
		'add_new_item' => __('Add New Gallery','twofold'),
		'edit_item' => __('Edit Gallery','twofold'),
		'new_item' => __('New Gallery','twofold'),
		'view_item' => __('View Gallery','twofold')
	  );
	  
	  $args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $gallery_slug, 'with_front' => false),
			'menu_icon' => 'dashicons-images-alt',
			'capability_type' => 'post',
			'supports' => array('title', 'comments')
	  ); 
	  
	  register_post_type('gallery',$args);
	  flush_rewrite_rules();
}

/* Collections */
function thb_post_type_collection() {
	$collection_slug = function_exists('ot_get_option') ? sanitize_title(ot_get_option('collection_slug','collection')) : 'collection';
	$labels = array(
		'name' => __( 'Collections','twofold'),
		'singular_name' => __( 'Collection','twofold' ),
		'rewrite' => array('slug' => __( 'collection','twofold' )),
		'add_new' => _x('Add New Collection', 'collection', 'twofold'),
		'add_new_item' => __('Add New Collection','twofold'),
		'edit_item' => __('Edit Collection','twofold'),
		'new_item' => __('New Collection','twofold'),
		'view_item' => __('View Collection','twofold')
	  );
	  
	  $args = array(
			'labels' => $labels,
			'description' => __('Collections are groups of albums','twofold'),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $collection_slug, 'with_front' => false),
			'hierarchical' => true,
			'menu_icon' => 'dashicons-exerpt-view',
			'capability_type' => 'page',
			'supports' => array('title')
	  ); 
	  
	  register_post_type('collection',$args);
	  flush_rewrite_rules();
}
/* Initialize post types */
add_action( 'init', 'thb_post_type_gallery' );
add_action( 'init', 'thb_post_type_album' );
add_action( 'init', 'thb_post_type_collection' );