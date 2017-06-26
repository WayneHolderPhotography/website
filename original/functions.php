<?php
/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file.
	You have been warned!

-------------------------------------------------------------------------------------*/

// Define Theme Name for localization
define('THB_THEME_ROOT', get_template_directory_uri());
define('THB_THEME_ROOT_ABS', get_template_directory());

// Option-Tree Theme Mode
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_override_forced_textarea_simple', '__return_true' );
require get_template_directory() .'/inc/ot-fonts.php';
require get_template_directory() .'/inc/ot-radioimages.php';
require get_template_directory() .'/inc/ot-metaboxes.php';
require get_template_directory() .'/inc/ot-themeoptions.php';
require get_template_directory() .'/inc/ot-functions.php';

if ( ! class_exists( 'OT_Loader' ) ) {
	require get_template_directory() .'/admin/ot-loader.php';
}

// TGM Plugin Activation Class
if ( is_admin() ) {
	require get_template_directory() .'/inc/class-tgm-plugin-activation.php';
	require get_template_directory() .'/inc/plugins.php';
}

// Misc
require get_template_directory() .'/inc/misc.php';

// Add Menu Support
require get_template_directory() .'/inc/wp3menu.php';

// Enable Sidebars
require get_template_directory() .'/inc/sidebar.php';

// CSS Output of Theme Options
require get_template_directory() .'/inc/selection.php';

// Script Calls
require get_template_directory() .'/inc/script-calls.php';

// Ajax
require get_template_directory() .'/inc/ajax.php';

// WooCommerce Support
require get_template_directory() .'/inc/woocommerce.php';

// WordPress Importer
if ( is_admin() ) {
	require get_template_directory() . '/inc/import.php';
	require get_template_directory() . '/inc/one-click-demo-import/one-click-demo-import.php';
}




 
	
	
	/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer logo Section', 'twentyseventeen' ),
		'id'            => 'footer-logo-section',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Blog Section', 'twentyseventeen' ),
		'id'            => 'footer-blog',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => __( 'Usefull Links', 'twentyseventeen' ),
		'id'            => 'footer-userfull-links',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
			register_sidebar( array(
		'name'          => __( 'Footer Map Section', 'twentyseventeen' ),
		'id'            => 'footer-map-section',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Settings', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Destinations', 'twentyseventeen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );




add_action( 'init', 'my_add_excerpts_to_pages' );

	function my_add_excerpts_to_pages() {

	     add_post_type_support( 'page', 'excerpt' );

	}
	
	
	
	
	function themeoptions_admin_menu() 
{
 // here's where we add our theme options page link to the dashboard sidebar
  add_theme_page("theme Options", "theme Options", 'edit_themes', basename(__FILE__), 'themeoptions_page');
}
function themeoptions_page() 
{
 // here's the main function that will generate our options page
  if ( $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }
  //if ( get_option() == 'checked'
  ?>
<div class="theme-panel">
	<div id="icon-themes" class="icon32"><br /></div>
	<h2>Themes options</h2>
	<form method="POST" id="admin-theme" action="">
		<input type="hidden" name="update_themeoptions" value="true" />
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="padding:20px 0px 20px 0px; border-bottom:#CCC 1px solid;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><h4 style="color:#1386ba; font-size:16px">Header logo section </h4></td>
					</tr>
					<tr>
					<td width="10%"><strong> Logo Name: </strong></td>
					<td width="90%"><input type="text" name="logoname" id="logoname" size="32" value="<?php echo get_option('mytheme_logoname'); ?>"/></td>
					</tr>
					<tr>
					<td width="10%"><strong> Email: </strong></td>
					<td width="90%"><input type="text" name="email" id="email" size="32" value="<?php echo get_option('mytheme_email'); ?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td style="padding:20px 0px 20px 0px; border-bottom:#CCC 1px solid;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><h4 style="color:#1386ba; font-size:16px">About Us</h4></td>
					</tr>
					<tr>
						<td width="10%"><strong>About images: </strong></td>
						<td width="90%"><input type="text" name="aboutimage" id="aboutimage" size="32" value="<?php echo get_option('mytheme_aboutimage'); ?>"/></td>
					</tr>
					<tr>
						<td width="10%"><strong>About images1: </strong></td>
                        <td width="90%"><input type="text" name="images1" id="images1" size="32" value="<?php echo get_option('mytheme_images1'); ?>"/></td>
					</tr>
					<tr>
						<td width="10%"><strong>About images2: </strong></td>
                        <td width="90%"><input type="text" name="images2" id="images2" size="32" value="<?php echo get_option('mytheme_images2'); ?>"/></td>
					</tr>
					<tr>
						<td width="10%"><strong>About images3: </strong></td>
                        <td width="90%"><input type="text" name="images3" id="images3" size="32" value="<?php echo get_option('mytheme_images3'); ?>"/></td>
					</tr> 
				</table>
			</td>
		</tr>
		
		<tr>
			<td style="padding:20px 0px 20px 0px; border-bottom:#CCC 1px solid;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><h4 style="color:#1386ba; font-size:16px">Contact</h4></td>
					</tr>
					<tr>
						<td width="10%"><strong>Contact form name: </strong></td>
                        <td width="90%"><input type="text" name="formname" id="formname" size="32" value="<?php echo get_option('mytheme_formname'); ?>"/></td>
					</tr>
					<tr>
						<td width="10%"><strong>Massage Send Success: </strong></td>
                        <td width="90%"><input type="text" name="msgsuccess" id="msgsuccess" size="32" value="<?php echo get_option('mytheme_msgsuccess'); ?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td style="padding:20px 0px 20px 0px; border-bottom:#CCC 1px solid;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><h4 style="color:#1386ba; font-size:16px">Footer</h4></td>
					</tr>
					<tr>
						<td width="10%"><strong>Google Map: </strong></td>
                        <td width="90%"><input type="text" name="map" id="map" size="32" value="<?php echo get_option('mytheme_map'); ?>"/></td>
					</tr>
					<tr>
						<td width="10%"><strong>Develop By: </strong></td>
                        <td width="90%"><input type="text" name="develop" id="develop" size="32" value="<?php echo get_option('mytheme_develop'); ?>"/></td>
					</tr>
					<tr>
						<td width="10%"><strong>Phone Number: </strong></td>
                        <td width="90%"><input type="text" name="phone" id="phone" size="32" value="<?php echo get_option('mytheme_phone'); ?>"/></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<p><input type="submit" name="search" value="Update Options" class="button" /></p>
	</form>
</div>
 <?php
}

function themeoptions_update()
{
	update_option('mytheme_logoname',  $_POST['logoname']);
	update_option('mytheme_email',  $_POST['email']);
	update_option('mytheme_aboutimage',  $_POST['aboutimage']);
	update_option('mytheme_images1',  $_POST['images1']);
	update_option('mytheme_images2',  $_POST['images2']);
	update_option('mytheme_images3',  $_POST['images3']);
	update_option('mytheme_formname',  $_POST['formname']);
	update_option('mytheme_msgsuccess',  $_POST['msgsuccess']);
	update_option('mytheme_map',  $_POST['map']);
	update_option('mytheme_develop',  $_POST['develop']);
	update_option('mytheme_phone',  $_POST['phone']);
	
		
	if ($_POST['display_sidebar']=='on') { $display = 'checked'; } else { $display = ''; }
	update_option('mytheme_display_sidebar',  $display);
	 
	if ($_POST['display_search']=='on') { $display = 'checked'; } else { $display = ''; }
	update_option('mytheme_display_search',  $display);
	 
	if ($_POST['display_twitter']=='on') { $display = 'checked'; } else { $display = ''; }
	update_option('mytheme_display_twitter',  $display);
	 
	update_option('mytheme_twitter_username',  $_POST['twitter_username']);
}
add_action('admin_menu', 'themeoptions_admin_menu');

/***************Enqueue*************************/
function custom_frontend_scripts()
{
#inlude css
wp_enqueue_style('custom_style',get_template_directory_uri().'/css/main.css');	
wp_enqueue_style('custom_owl.compiled',get_template_directory_uri().'/css/style.css');	




}

add_action('wp_enqueue_scripts','custom_frontend_scripts');

add_action('init', 'session_manager'); 
function session_manager() {
	if (!session_id()) {
		session_start();
	}
}


add_action('wp_logout', 'session_logout');
function session_logout() {
	session_destroy();
}
// Register Custom Post Type
function custom_services_type() {

	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Services', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Services', 'text_domain' ),
		'name_admin_bar'        => __( 'Services', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Services', 'text_domain' ),
		'description'           => __( 'Services Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'services_type', $args );

}
add_action( 'init', 'custom_services_type', 0 );

function ms_image_editor_default_to_gd( $editors ) {
	$gd_editor = 'WP_Image_Editor_GD';

	$editors = array_diff( $editors, array( $gd_editor ) );
	array_unshift( $editors, $gd_editor );

	return $editors;
}
add_filter( 'wp_image_editors', 'ms_image_editor_default_to_gd' );

 /* Add secondary thumbnail (featured image) in posts */
$thumb = new MultiPostThumbnails(
	array(
		'label' => 'Secondary Image',
		'id' => 'secondary-image',
		'post_type' => 'post'
	)
);
add_image_size('post-secondary-image-thumbnail', 1360, 503);
