<?php 
function thb_ocdi_import_files() {
    return array(
        array(
            'import_file_name'       => 'Light Demo',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/twofold/light/demo-content.xml",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/twofold/light/theme-options.txt"
        ),
        array(
            'import_file_name'       => 'Dark Demo',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/twofold/dark/demo-content.xml",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/twofold/dark/theme-options.txt"
        )
    );
}
add_filter( 'pt-ocdi/import_files', 'thb_ocdi_import_files' );

function thb_ocdi_after_import( $selected_import ) {
	
	/* Set Pages */
	update_option( 'show_on_front', 'page' );
	
	$home = get_page_by_title('Home – Slider');
	$blog = get_page_by_title('Blog');
	
	update_option( 'page_for_posts', $blog->ID );
	update_option( 'page_on_front', $home->ID );
	
	/* Set Menus */
	$top_menu = get_term_by('name', 'navigation', 'nav_menu');
	$footer_menu = get_term_by('name', 'footer', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array('nav-menu' => $top_menu->term_id, 'footer-menu' => $footer_menu->term_id ) );
}
add_action( 'pt-ocdi/after_import', 'thb_ocdi_after_import' );