<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'thb_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function thb_custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'sections'        => array(
      array(
        'title'       => 'General',
        'id'          => 'general'
      ),
      array(
        'title'       => 'Header',
        'id'          => 'header'
      ),
      array(
        'title'       => esc_html__('Shop', 'twofold'),
        'id'          => 'shop'
      ),
      array(
        'title'       => 'Customization',
        'id'          => 'customization'
      ),
      array(
        'title'       => 'Footers',
        'id'          => 'footer'
      ),
      array(
        'title'       => 'Misc',
        'id'          => 'misc'
      ),
      array(
        'title'       => 'Contact Page',
        'id'          => 'contact'
      ),
      array(
        'title'       => 'Demo Content',
        'id'          => 'import'
      )
    ),
    'settings'        => array(
    	array(
    	  'id'          => 'general_tab0',
    	  'label'       => 'General',
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Main Color Theme',
    	  'id'          => 'color_theme',
    	  'type'        => 'radio',
    	  'desc'        => 'You can change the main color theme here',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Light',
    	      'value'       => 'light-theme'
    	    ),
    	    array(
    	      'label'       => 'Dark',
    	      'value'       => 'dark-theme'
    	    )
    	  ),
    	  'std'         => 'light-theme',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Image Hover Effect',
    	  'id'          => 'image_effect',
    	  'type'        => 'radio',
    	  'desc'        => 'You can change the main image hover effect.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Simple',
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => '3D',
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => 'Pan',
    	      'value'       => 'style3'
    	    )
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Mouse Cursor',
    	  'id'          => 'mouse_effect',
    	  'type'        => 'radio',
    	  'desc'        => 'This is the mouse cursor used for sliders.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Angled Square',
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => 'Circular',
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => 'Regular',
    	      'value'       => 'style3'
    	    )
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Preloader',
    	  'id'          => 'preloader',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can disable the page preloader here',
    	  'section'     => 'general',
    	  'std'         => 'on'
    	),
    	array(
    	  'id'          => 'general_tab1',
    	  'label'       => 'Lightbox',
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Lightbox Color Theme',
    	  'id'          => 'lightbox_theme',
    	  'type'        => 'radio',
    	  'desc'        => 'You can change the lightbox color theme here',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Light',
    	      'value'       => 'light-box'
    	    ),
    	    array(
    	      'label'       => 'Dark',
    	      'value'       => 'dark-box'
    	    )
    	  ),
    	  'std'         => 'light-box',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Lightbox Downloads',
    	  'id'          => 'lightbox_downloads',
    	  'type'        => 'radio',
    	  'desc'        => 'You can allow the visitors to download the photos within the lightbox.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Enabled',
    	      'value'       => 'lightbox-download-enabled'
    	    ),
    	    array(
    	      'label'       => 'Disabled',
    	      'value'       => 'lightbox-download-disabled'
    	    )
    	  ),
    	  'std'         => 'lightbox-download-enabled',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Lightbox Zoom',
    	  'id'          => 'lightbox_zoom',
    	  'type'        => 'radio',
    	  'desc'        => 'You can toggle the zoom feature of the lightbox.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Enabled',
    	      'value'       => 'lightbox-zoom-enabled'
    	    ),
    	    array(
    	      'label'       => 'Disabled',
    	      'value'       => 'lightbox-zoom-disabled'
    	    )
    	  ),
    	  'std'         => 'lightbox-zoom-enabled',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Lightbox AutoPlay',
    	  'id'          => 'lightbox_autoplay',
    	  'type'        => 'radio',
    	  'desc'        => 'You can toggle the autoplay feature of the lightbox.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Enabled',
    	      'value'       => 'lightbox-autoplay-enabled'
    	    ),
    	    array(
    	      'label'       => 'Disabled',
    	      'value'       => 'lightbox-autoplay-disabled'
    	    )
    	  ),
    	  'std'         => 'lightbox-autoplay-enabled',
    	  'section'     => 'general'
    	),
    	array(
    		'label'       => esc_html__('Lightbox AutoPlay Duration', 'twofold' ),
    	  'id'          => 'lightbox_autoplay_duration',
    	  'std'         => '5',
    	  'type'        => 'numeric-slider',
    	  'desc'        => 'The amount of time between next slides in seconds.',
    	  'min_max_step'=> '1,10,0.5',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Lightbox Effect',
    	  'id'          => 'lightbox_effect',
    	  'type'        => 'radio',
    	  'desc'        => 'You can change the lightbox photo change effect',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Slide',
    	      'value'       => 'lg-slide'
    	    ),
    	    array(
    	      'label'       => 'Fade',
    	      'value'       => 'lg-fade'
    	    ),
    	    array(
    	      'label'       => 'Zoom In',
    	      'value'       => 'lg-zoom-in'
    	    ),
    	    array(
    	      'label'       => 'Zoom Out',
    	      'value'       => 'lg-zoom-out'
    	    ),
    	    array(
    	      'label'       => 'Soft Zoom',
    	      'value'       => 'lg-soft-zoom'
    	    ),
    	    array(
    	      'label'       => 'Slide Circular',
    	      'value'       => 'lg-slide-circular'
    	    ),
    	    array(
    	      'label'       => 'Slide Vertical',
    	      'value'       => 'lg-slide-vertical'
    	    ),
    	    array(
    	      'label'       => 'Slide Skew',
    	      'value'       => 'lg-slide-skew'
    	    )
    	  ),
    	  'std'         => 'lg-slide',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Display EXIF Info?',
    	  'id'          => 'lightbox_exif',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can disable the exif information on lightboxes here',
    	  'section'     => 'general',
    	  'std'         => 'on'
    	),
    	array(
    	  'id'          => 'general_tab2',
    	  'label'       => 'Blog',
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Blog Style',
    	  'id'          => 'blog_style',
    	  'type'        => 'radio',
    	  'desc'        => 'You can choose different blog styles here',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Style 1 - Masonry',
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => 'Style 2 - Vertical',
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => 'Style 3 - List',
    	      'value'       => 'style3'
    	    )
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Blog Pagination Style',
    	  'id'          => 'blog_pagination_style',
    	  'type'        => 'radio',
    	  'desc'        => 'You can choose different blog pagination styles here. The regular pagination will be used for archive pages.',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Regular Pagination',
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => 'Load More Button',
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => 'Infinite Scroll',
    	      'value'       => 'style3'
    	    )
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => 'Blog Header',
    	  'id'          => 'blog_header',
    	  'type'        => 'textarea',
    	  'desc'        => 'This content appears on top of the main blog page.',
    	  'rows'        => '4',
    	  'section'     => 'general'
    	),
    	array(
    	  'id'          => 'general_tab3',
    	  'label'       => 'Permalink Slugs',
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Gallery Slug', 'twofold' ),
    	  'id'          => 'gallery_slug',
    	  'type'        => 'text',
    	  'section'     => 'general',
    	  'std' 				=> 'gallery'
    	),
    	array(
    	  'label'       => esc_html__('Album Slug', 'twofold' ),
    	  'id'          => 'album_slug',
    	  'type'        => 'text',
    	  'section'     => 'general',
    	  'std' 				=> 'album'
    	),
    	array(
    	  'label'       => esc_html__('Collection Slug', 'twofold' ),
    	  'id'          => 'collection_slug',
    	  'type'        => 'text',
    	  'section'     => 'general',
    	  'std' 				=> 'collection'
    	),
    	array(
    	  'id'          => 'header_tab2',
    	  'label'       => 'General Settings',
    	  'type'        => 'tab',
    	  'section'     => 'header'
    	),
    	array(
    	  'label'       => 'Logo Position',
    	  'id'          => 'logo_position',
    	  'type'        => 'radio',
    	  'desc'        => 'Where would you like to show your logo?',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Left',
    	      'value'       => 'thb-logo-left'
    	    ),
    	    array(
    	      'label'       => 'Center',
    	      'value'       => 'thb-logo-center'
    	    )
    	  ),
    	  'std'         => 'thb-logo-left',
    	  'section'     => 'header'
    	),
    	array(
    	  'label'       => 'Mobile Menu Position',
    	  'id'          => 'menu_position',
    	  'type'        => 'radio',
    	  'desc'        => 'Where would you like to show your menu?',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Left',
    	      'value'       => 'thb-menu-left'
    	    ),
    	    array(
    	      'label'       => 'Right',
    	      'value'       => 'thb-menu-right'
    	    )
    	  ),
    	  'std'         => 'thb-menu-left',
    	  'section'     => 'header'
    	),
    	array(
    	  'label'       => 'Menu Type',
    	  'id'          => 'menu_type',
    	  'type'        => 'radio',
    	  'desc'        => 'This changes how the menu is displayed. <strong>Only available in Left Logo option.</strong>',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Mobile Icon',
    	      'value'       => 'thb-mobile-icon'
    	    ),
    	    array(
    	      'label'       => 'Full Menu',
    	      'value'       => 'thb-full-menu'
    	    )
    	  ),
    	  'std'         => 'thb-mobile-icon',
    	  'section'     => 'header'
    	),
    	array(
    	  'label'       => 'Mobile Menu Animation Speed',
    	  'id'          => 'menu_speed',
    	  'type'        => 'numeric-slider',
    	  'desc'        => 'This changes the speed of the menu items appearing. A larger value means a slower animation.',
    	 	'min_max_step'=> '0.1,1.00,0.01',
    	  'std'         => '0.5',
    	  'section'     => 'header'
    	),
    	array(
    	  'label'       => 'Submenu Behaviour',
    	  'id'          => 'submenu_behaviour',
    	  'type'        => 'radio',
    	  'desc'        => 'You can choose how your + signs work',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Default - Clickable parent links',
    	      'value'       => 'thb-default'
    	    ),
    	    array(
    	      'label'       => 'Open Submenu - Parent links open submenus',
    	      'value'       => 'thb-submenu'
    	    )
    	  ),
    	  'std'         => 'thb-default',
    	  'section'     => 'header'
    	),
      array(
        'id'          => 'header_tab3',
        'label'       => 'Logo Settings',
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Light Logo Upload',
        'id'          => 'logo_light',
        'type'        => 'upload',
        'desc'        => 'You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong>',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Dark Logo Upload',
        'id'          => 'logo_dark',
        'type'        => 'upload',
        'desc'        => 'You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong>',
        'section'     => 'header'
      ),
      array(
        'label'       => 'Logo Height',
        'id'          => 'logo_height',
        'type'        => 'measurement',
        'desc'        => 'You can modify the logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside header',
        'section'     => 'header'
      ),
      array(
        'id'          => 'shop_tab0',
        'label'       => esc_html__('General', 'twofold'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Shop Sidebar', 'twofold' ),
        'id'          => 'shop_sidebar',
        'type'        => 'radio',
        'desc'        => esc_html__('Would you like to display sidebar on shop main and category pages?', 'twofold'),
        'choices'     => array(
          array(
            'label'       => esc_html__('No Sidebar', 'twofold'),
            'value'       => 'no'
          ),
          array(
            'label'       => esc_html__('Right Sidebar', 'twofold'),
            'value'       => 'right'
          ),
          array(
            'label'       => esc_html__('Left Sidebar', 'twofold'),
            'value'       => 'left'
          )
        ),
        'std'         => 'no',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Products Per Page', 'twofold' ),
        'id'          => 'products_per_page',
        'type'        => 'text',
        'section'     => 'shop',
        'std' 				=> '12'
      ),
      array(
      	'label'       => esc_html__('Products Per Row', 'twofold' ),
        'id'          => 'products_per_row',
        'std'         => '4',
        'type'        => 'numeric-slider',
        'section'     => 'shop',
        'min_max_step'=> '2,6,1'
      ),
      array(
        'id'          => 'misc_tab1',
        'label'       => 'General',
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Extra CSS',
        'id'          => 'extra_css',
        'type'        => 'css',
        'desc'        => 'Any CSS that you would like to add to the theme.',
        'section'     => 'misc'
      ),
	    array(
        'id'          => 'misc_tab12',
        'label'       => '404 Page',
        'type'        => 'tab',
        'section'     => 'misc'
      ),
	    array(
        'label'       => '404 Page Image',
        'id'          => '404-image',
        'type'        => 'upload',
        'desc'        => 'This will change the actual 404 image in the middle.',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab13',
        'label'       => 'Preloader',
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Preloader Image',
        'id'          => 'preloader-image',
        'type'        => 'upload',
        'desc'        => 'This will change the preloader logo in the middle. Should be 500x500 pixels maximum.',
        'section'     => 'misc'
      ),
      array(
        'label'       => 'Select Your Demo',
        'id'          => 'demo-select',
        'type'        => 'radio-image',
        'std'         => '0',
        'section'     => 'import'
      ),
      array(
        'id'          => 'demo_import',
        'label'       => 'About Importing Demo Content',
        'desc'        => '
        <div id="thb-import-messages"></div>
        <p style="text-align:center;"><a class="button button-primary button-hero" id="import-demo-content" href="#">Import Demo Content</a><br /><br />
        <small>Please press only once, and wait till you get the success message above.<br />If you \'re having trouble with import, please see: <a href="https://fuelthemes.ticksy.com/article/2706/">What To Do If Demo Content Import Fails</a></p>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'import'
      ),
      array(
        'id'          => 'customization_tab0',
        'label'       => 'Colors',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Accent Color',
        'id'          => 'accent_color',
        'type'        => 'colorpicker',
        'std'         => '#e03737',
        'desc'        => 'Change the accent color used throughout the theme',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Accent Color 2',
        'id'          => 'accent_color2',
        'type'        => 'colorpicker',
        'std'         => '#fcef1a',
        'desc'        => 'Change the accent color used throughout the theme',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab2',
        'label'       => 'Typography',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Font Subsets',
        'id'          => 'font_subsets',
        'type'        => 'radio',
        'desc'        => 'You can add additional character subset specific to your language.',
        'choices'     => array(
        	array(
        	  'label'       => 'No Subset',
        	  'value'       => 'no-subset'
        	),
          array(
            'label'       => 'Greek',
            'value'       => 'greek'
          ),
          array(
            'label'       => 'Cyrillic',
            'value'       => 'cyrillic'
          ),
          array(
            'label'       => 'Vietnamese',
            'value'       => 'vietnamese'
          )
        ),
        'std'         => 'no-subset',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Title Typography',
        'id'          => 'title_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for the titles',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Body Text Typography',
        'id'          => 'body_type',
        'type'        => 'typography',
        'desc'        => 'Font Settings for general body font',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab3',
        'label'       => 'Font Adjustments',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Album Title Font Typography',
        'id'          => 'album_font',
        'type'        => 'typography',
        'desc'        => 'Font Settings for album titles',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Full Menu Font Adjustment',
        'id'          => 'full_menu_font',
        'type'        => 'typography',
        'desc'        => 'Font Settings for menu.',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Mobile Menu Font Adjustment',
        'id'          => 'menu_font',
        'type'        => 'typography',
        'desc'        => 'Font Settings for menu.',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Lightbox Caption Font',
        'id'          => 'caption_font',
        'type'        => 'typography',
        'desc'        => 'Font Settings for lightbox captions.',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Footer Menu Font Adjustment',
        'id'          => 'footer_font',
        'type'        => 'typography',
        'desc'        => 'Font Settings for menu in the footer.',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Footer Social Icon Font Adjustment',
        'id'          => 'footer_social_font',
        'type'        => 'typography',
        'desc'        => 'Font Settings for social icons in the footer.',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab4',
        'label'       => 'Backgrounds',
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => '404 Page Background',
        'id'          => 'page404_bg',
        'type'        => 'background',
        'desc'        => 'Background settings for the 404 Page. You can change the center image inside Theme Options > Misc.',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Password Protected Page Background',
        'id'          => 'password_bg',
        'type'        => 'background',
        'desc'        => 'Background settings for the password protected pages',
        'section'     => 'customization'
      ),
      array(
        'label'       => 'Preloader Background',
        'id'          => 'preloader_bg',
        'type'        => 'background',
        'desc'        => 'Background settings for the Preloader. You can change the center image inside Theme Options > Misc.',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'footer_tab1',
        'label'       => 'General',
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Footer Left content',
        'id'          => 'footer_left_content',
        'type'        => 'radio',
        'desc'        => 'You can change the left content of the footer here.',
        'choices'     => array(
          array(
            'label'       => 'Menu',
            'value'       => 'menu'
          ),
          array(
            'label'       => 'Text',
            'value'       => 'text'
          )
        ),
        'std'         => 'menu',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Text Content',
        'id'          => 'footer_left_text',
        'type'        => 'textarea',
        'desc'        => 'Text Content of the footer',
        'section'     => 'footer',
        'condition'   => 'footer_left_content:is(text)'
      ),
	  	array(
	  	  'id'          => 'footer_tab2',
	  	  'label'       => 'Social Links in Footer',
	  	  'type'        => 'tab',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Facebook Link',
	  	  'id'          => 'fb_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Facebook profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Pinterest Link',
	  	  'id'          => 'pinterest_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Pinterest profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Twitter Link',
	  	  'id'          => 'twitter_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Twitter profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Google Plus Link',
	  	  'id'          => 'googleplus_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Google Plus profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Linkedin Link',
	  	  'id'          => 'linkedin_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Linkedin profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Instagram Link',
	  	  'id'          => 'instragram_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Instagram profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Xing Link',
	  	  'id'          => 'xing_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Xing profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Tumblr Link',
	  	  'id'          => 'tumblr_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Tumblr profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Vkontakte Link',
	  	  'id'          => 'vk_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Vkontakte profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'SoundCloud Link',
	  	  'id'          => 'soundcloud_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'SoundCloud profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Dribbble Link',
	  	  'id'          => 'dribbble_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Dribbbble profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'YouTube Link',
	  	  'id'          => 'youtube_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Youtube profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Spotify Link',
	  	  'id'          => 'spotify_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Spotify profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Behance Link',
	  	  'id'          => 'behance_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Behance profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'DeviantArt Link',
	  	  'id'          => 'deviantart_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'DeviantArt profile/page link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Vimeo Link',
	  	  'id'          => 'vimeo_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Vimeo profile/video link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => '500px Link',
	  	  'id'          => 'fivehundred_link',
	  	  'type'        => 'text',
	  	  'desc'        => '500px profile link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'label'       => 'Flickr Link',
	  	  'id'          => 'flickr_link',
	  	  'type'        => 'text',
	  	  'desc'        => 'Flickr link',
	  	  'section'     => 'footer'
	  	),
	  	array(
	  	  'id'          => 'contact_text',
	  	  'label'       => 'About Contact Page Settings',
	  	  'desc'        => 'These settings will be used for the map inside Contact Page template.',
	  	  'std'         => '',
	  	  'type'        => 'textblock',
	  	  'section'     => 'contact'
	  	),
	  	array(
	  	  'label'       => 'Display Map?',
	  	  'id'          => 'contact_map',
	  	  'type'        => 'on_off',
	  	  'desc'        => 'You can disable map if you want',
	  	  'section'     => 'contact',
	  	  'std'         => 'on'
	  	),
	  	array(
	  	  'label'       => 'Google Maps API Key',
	  	  'id'          => 'map_api_key',
	  	  'type'        => 'text',
	  	  'desc'        => 'Please enter the Google Maps Api Key. <small>You need to create a browser API key. For more information, please visit: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a></small>',
	  	  'section'     => 'contact'
	  	),
	  	array(
	  		'label'       => 'Map Zoom Amount',
	  	  'id'          => 'contact_zoom',
	  	  'desc'        => 'Value should be between 1-18, 1 being the entire earth and 18 being right at street level.',
	  	  'std'         => '17',
	  	  'type'        => 'numeric-slider',
	  	  'section'     => 'contact',
	  	  'min_max_step'=> '1,18,1'
	  	),
	  	array(
	  	  'label'       => 'Map Pin Image',
	  	  'id'          => 'map_pin_image',
	  	  'type'        => 'upload',
	  	  'desc'        => 'If you would like to use your own pin, you can upload it here',
	  	  'section'     => 'contact'
	  	),
	  	array(
	  	  'label'       => 'Map Center Latitude',
	  	  'id'          => 'map_center_lat',
	  	  'type'        => 'text',
	  	  'desc'        => 'Please enter the latitude for the maps center point. <small>You can get lat-long coordinates using <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Latlong.net</a></small>',
	  	  'section'     => 'contact'
	  	),
	  	array(
	  	  'label'       => 'Map Center Longtitude',
	  	  'id'          => 'map_center_long',
	  	  'type'        => 'text',
	  	  'desc'        => 'Please enter the longitude for the maps center point.',
	  	  'section'     => 'contact'
	  	),
	  	array(
	  	  'label'       => 'Google Map Pin Locations',
	  	  'id'          => 'map_locations',
	  	  'type'        => 'list-item',
	  	  'desc'        => 'Coordinates to shop on the map',
	  	  'settings'    => array(
	  	    array(
	  	      'label'       => 'Coordinates',
	  	      'id'          => 'lat_long',
	  	      'type'        => 'text',
	  	      'desc'        => 'Coordinates of this location separated by comma. <small>You can get lat-long coordinates using <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Latlong.net</a></small>',
	  	      'rows'        => '1'
	  	    ),
	  	    array(
	  	      'label'       => 'Information',
	  	      'id'          => 'information',
	  	      'type'        => 'textarea',
	  	      'desc'        => 'This content appears below the title of the tooltip',
	  	      'rows'        => '2',
	  	    ),
	  	  ),
	  	  'section'     => 'contact'
	  	)
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
}

/**
 * Gallery Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_gallery_checkbox' ) ) {
  
  function ot_type_gallery_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
      echo '<ul class="option-tree-setting-wrap option-tree-sortable" data-name="' . esc_attr( $field_id ) . '" data-id="' . esc_attr( $post_id ) . '" data-type="' . esc_attr( $type ) . '">'; 
        
        $field_value = is_array($field_value) ?  $field_value : array();
        /* get gallery array */
        $args = array(
        	'posts_per_page' => -1,  
        	'post_type'=>'gallery', 
        	'post_status' => 'publish', 
        	'no_found_rows' => true
        );
        $gallerys = new WP_Query($args);

        $gallery_ids = wp_list_pluck( $gallerys->posts, 'ID' );
        $all_galleries = array_combine($gallery_ids,$gallery_ids);
        $merged_array = array_replace($field_value, $all_galleries);
        
        $args = array( 
        	'posts_per_page' => -1,
        	'post_type' => 'gallery', 
        	'post_status' => 'publish', 
        	'post__in' => $merged_array,
        	'orderby' => 'post__in',
        	'no_found_rows' => true
        );
        $gallerys = new WP_Query($args);
        /* build categories */
        if ( ! empty( $gallerys->posts ) ) {
          foreach ( $gallerys->posts as $gallery ) {
            echo '<li class="ui-state-default list-list-item"><div class="option-tree-setting"><div class="open">';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $gallery->ID ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $gallery->ID ) . '" value="' . esc_attr( $gallery->ID ) . '" ' . ( isset( $field_value[$gallery->ID] ) ? checked( $field_value[$gallery->ID], $gallery->ID, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $gallery->ID ) . '">' . esc_attr( $gallery->post_title ) . '</label>';
            echo '</li>';
          } 
        } else {
          echo '<li>' . __( 'No Galleries Found', 'option-tree' ) . '</li>';
        }
      
      echo '</ul>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Album Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_album_checkbox' ) ) {
  
  function ot_type_album_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
      echo '<ul class="option-tree-setting-wrap option-tree-sortable" data-name="' . esc_attr( $field_id ) . '" data-id="' . esc_attr( $post_id ) . '" data-type="' . esc_attr( $type ) . '">'; 
      
      	$field_value = is_array($field_value) ?  $field_value : array();
        /* get album array */
        $args = array(
        	'posts_per_page' => -1,  
        	'post_type' => 'album', 
        	'post_status' => 'publish', 
        	'no_found_rows' => true
        );
        $albums = new WP_Query($args);
        $album_ids = wp_list_pluck( $albums->posts, 'ID' );
        $all_albums = array_combine($album_ids,$album_ids);
        $merged_array = array_replace($field_value, $all_albums);
        
        $args = array( 
        	'posts_per_page' => -1,
        	'post_type' => 'album', 
        	'post_status' => 'publish', 
        	'post__in' => $merged_array,
        	'orderby' => 'post__in',
        	'no_found_rows' => true
        );
        $albums = new WP_Query($args);
        /* build categories */
        if ( ! empty( $albums->posts ) ) {
          foreach ( $albums->posts as $album ) {
            echo '<li class="ui-state-default list-list-item"><div class="option-tree-setting"><div class="open">';
            
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $album->ID ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $album->ID ) . '" value="' . esc_attr( $album->ID ) . '" ' . ( isset( $field_value[$album->ID] ) ? checked( $field_value[$album->ID], $album->ID, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $album->ID ) . '">' . esc_attr( $album->post_title ) . '</label>';
            echo '</div></div></li>';
          } 
        } else {
          echo '<li>' . __( 'No Albums Found', 'option-tree' ) . '</li>';
        }
      
      echo '</ul>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}