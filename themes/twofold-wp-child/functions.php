<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
function enqueue_styles() {
   wp_enqueue_style('child_theme', get_stylesheet_uri());
}

add_action( 'wp_enqueue_scripts', 'enqueue_javascript' );
function enqueue_javascript() {
  wp_enqueue_script( 'main_javascript', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), '1.0.0', true);
}

function twofold_child_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twofold-wp-child' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twofold-wp-child' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Column Left', 'twofold-wp-child' ),
		'id'            => 'footer-column-left',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twofold-wp-child' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Column Centre Left', 'twofold-wp-child' ),
		'id'            => 'footer-column-center-left',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twofold-wp-child' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => __( 'Footer Column Centre Right', 'twofold-wp-child' ),
		'id'            => 'footer-column-center-right',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twofold-wp-child' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
			register_sidebar( array(
		'name'          => __( 'Footer Column Right', 'twofold-wp-child' ),
		'id'            => 'footer-column-right',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twofold-wp-child' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'twofold_child_widgets_init' );
add_action( 'init', 'my_add_excerpts_to_pages' );

function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

function themeoptions_admin_menu() {
 // here's where we add our theme options page link to the dashboard sidebar
  add_theme_page("theme Options", "theme Options", 'edit_themes', basename(__FILE__), 'themeoptions_page');
}

function themeoptions_page() {
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
<?php }

function themeoptions_update() {
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
$thumb = new MultiPostThumbnails(
	array(
		'label' => 'Secondary Image',
		'id' => 'secondary-image',
		'post_type' => 'post'
	)
);
add_image_size('post-secondary-image-thumbnail', 1360, 503);
