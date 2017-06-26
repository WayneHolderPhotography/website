<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'thb_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */


function thb_custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  
  $page_meta_box = array(  
    'id'          => 'page_settings',
    'title'       => 'Page Settings',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab1',
    	  'label'       => 'Home Page Layout',
    	  'type'        => 'tab'
    	),
    	array(
    	  'id'          => 'homepage_text',
    	  'label'       => 'About Home Page Settings',
    	  'desc'        => 'Below settings are used when the Home Page template is selected. Not all slide settings are used for every layout.',
    	  'type'        => 'textblock'
    	),
    	array(
    	  'label'       => 'Home Page Layout',
    	  'id'          => 'home_layout',
    	  'type'        => 'radio',
    	  'choices'     => array(
    	  	array(
    	  	  'label'       => 'Image Slider',
    	  	  'value'       => 'style1'
    	  	),
    	  	array(
    	  	  'label'       => 'Image Slider with Ken Burns Effect',
    	  	  'value'       => 'style4'
    	  	),
    	    array(
    	      'label'       => 'Image Slider with Thumbnails',
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => 'Vertical Content Slider - Cube Effect',
    	      'value'       => 'style3'
    	    ),
    	    array(
    	      'label'       => 'Vertical Split Slider',
    	      'value'       => 'style5'
    	    ),
    	    array(
    	      'label'       => 'Vertical Split Slider - Double images (make sure you have even count of images)',
    	      'value'       => 'style6'
    	    ),
    	    array(
    	      'label'       => 'Full Screen Video',
    	      'value'       => 'style7'
    	    )
    	  ),
    	  'std'         => 'style1'
    	),
    	array(
    	  'label'       => 'Auto Play',
    	  'id'          => 'home_autoplay',
    	  'type'        => 'on_off',
    	  'desc'        => 'Do you want to auto-play the slides?',
    	  'std'         => 'off',
    	  'operator' 		=> 'or',
    	  'condition'   => 'home_layout:is(style1),home_layout:is(style2),home_layout:is(style3),home_layout:is(style4),home_layout:is(style5),home_layout:is(style6)'
    	),
    	array(
    	  'label'       => 'Pagination Lines',
    	  'id'          => 'home_pagination',
    	  'type'        => 'on_off',
    	  'desc'        => 'Do you want to display the pagination lines on the side?',
    	  'std'         => 'on',
    	  'operator' 		=> 'or',
    	  'condition'   => 'home_layout:is(style3),home_layout:is(style5),home_layout:is(style6)'
    	),
    	array(
        'id'          => 'home_autoplay_speed',
        'label'       => 'Auto Play Duration',
        'desc'        => 'How long it should pass before the slides change. The numbers are in miliseconds (ms)',
        'std'         => '5000',
        'type'        => 'numeric-slider',
        'min_max_step'=> '500,10000,100',
        'condition'   => 'home_autoplay:is(on)'
      ),
      array(
        'label'       => 'Video URL',
        'id'          => 'home_video_url',
        'type'        => 'text',
        'desc'				=> '<a href="https://codex.wordpress.org/Embeds" target="_blank">oEmbed Video Providers</a> or MP4,OGG, etc files',
        'condition'   => 'home_layout:is(style7)'
      ),
    	array(
    	  'id'          => 'tab2',
    	  'label'       => 'Home Page Slides',
    	  'type'        => 'tab'
    	),
    	array(
    	  'id'          => 'homepage_slides_text',
    	  'label'       => 'About Home Page Slides',
    	  'desc'        => 'Below settings are used when you choose a slider as the Home Page layout.',
    	  'type'        => 'textblock'
    	),
    	array(
    	  'label'       => 'Randomize Slides?',
    	  'id'          => 'home_random',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will randomize the slides regardless of their order below.',
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => 'Home Page Slides',
    	  'id'          => 'home_slides',
    	  'type'        => 'list-item',
    	  'settings'    => array(
    	  	array(
    	  	  'label'       => 'Description',
    	  	  'id'          => 'description',
    	  	  'type'        => 'text',
    	  	  'desc'        => 'Slide Description used on Cube Effect'
    	  	),
    	    array(
    	      'label'       => 'Slide Image',
    	      'id'          => 'image',
    	      'type'        => 'upload',
    	      'class'				=> 'ot-upload-attachment-id',
    	      'desc'        => 'Recommended image size is 1900x1200'
    	    ),
    	    array(
    	      'label'       => 'Logo Color',
    	      'id'          => 'logo_color',
    	      'type'        => 'radio',
    	      'choices'     => array(
    	      	array(
    	      	  'label'       => 'Dark Logo',
    	      	  'value'       => 'logo-dark'
    	      	),
    	        array(
    	          'label'       => 'Light Logo',
    	          'value'       => 'logo-light'
    	        )
    	      ),
    	      'std'         => 'logo-dark'
    	    ),
    	    array(
    	      'label'       => 'Add Button?',
    	      'id'          => 'home_btn',
    	      'type'        => 'on_off',
    	      'desc'        => 'Do you want to display a button? Used on Cube Effect',
    	      'std'         => 'off'
    	    ),
    	    array(
    	      'label'       => 'Button Label',
    	      'id'          => 'btn_text',
    	      'type'        => 'text',
    	      'condition'   => 'home_btn:is(on)'
    	    ),
    	    array(
    	      'label'       => 'Button Link',
    	      'id'          => 'btn_link',
    	      'type'        => 'text',
    	      'condition'   => 'home_btn:is(on)'
    	    ),
    	  )
    	),
    	array(
    	  'id'          => 'tab3',
    	  'label'       => 'Contact Page',
    	  'type'        => 'tab'
    	),
    	array(
    	  'id'          => 'contactpage_text',
    	  'label'       => 'About Contact Page Settings',
    	  'desc'        => 'Below settings are used when the Contact template is selected.',
    	  'type'        => 'textblock'
    	),
    	array(
    	  'label'       => 'Layout',
    	  'id'          => 'contact_layout',
    	  'type'        => 'radio',
    	  'choices'     => array(
    	  	array(
    	  	  'label'       => 'Style 1',
    	  	  'value'       => 'style1'
    	  	),
    	    array(
    	      'label'       => 'Style 2',
    	      'value'       => 'style2'
    	    )
    	  ),
    	  'std'         => 'style1'
    	),
    	array(
    	  'label'       => 'Contact Form 7 Shortcode',
    	  'id'          => 'contact_shortcode',
    	  'type'        => 'text',
    	  'desc'        => 'You can paste the Contact Form 7 shortcode here',
    	  'rows'        => '1'
    	),
    	array(
    	  'id'          => 'tab4',
    	  'label'       => 'General Page Settings',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Show Date',
    	  'id'          => 'page_date',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can toggle page date using this setting',
    	  'std'         => 'on',
    	),
    	array(
    	  'label'       => 'Show Title',
    	  'id'          => 'page_title',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can toggle page title using this setting',
    	  'std'         => 'on',
    	),
    )
  );
  
  $collection_meta_box = array(  
    'id'          => 'collection_settings',
    'title'       => 'Collection Settings',
    'pages'       => array( 'collection' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab1',
    	  'label'       => 'Album Selection',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Show Filter?',
    	  'id'          => 'album_filter',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will display a filter on the top right',
    	  'std'         => 'off',
    	),
    	array(
        'id'          => 'album_taxonomy',
        'label'       => 'Album Categories',
        'desc' 				=> 'Select which albums categories to show the filter for',
        'type'        => 'taxonomy-checkbox',
        'rows'        => '',
        'post_type'   => 'album',
        'taxonomy'    => 'album-category',
        'condition'   => 'album_filter:is(on)'
      ),
    	array(
    	  'id' 					=> 'collection_albums',
    	  'label'       => 'Albums to Display',
    	  'type' 				=> 'album_checkbox',
    	  'desc' 				=> 'Select which albums to display inside this collection'
    	),
    	array(
    	  'id'          => 'tab2',
    	  'label'       => 'Layout',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Page Padding',
    	  'id'          => 'page_padding',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will add spacing at the top and the bottom.',
    	  'std'         => 'off',
    	  'condition'   => 'collection_layout:is(style1)'
    	),
    	array(
    	  'label'       => 'Enable True Aspect Ratio',
    	  'id'          => 'true_aspect_ratio',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will force the theme to display correct aspect ratio for the photos. However, it might break the layouts.',
    	  'std'         => 'off',
    	  'operator' 		=> 'or',
    	  'condition'   => 'collection_layout:is(style1),collection_layout:is(style2)'
    	),
    	array(
    	  'label'       => 'Columns',
    	  'id'          => 'style3-columns',
    	  'type'        => 'radio',
    	  'choices'     => array(
    	  	array(
    	  	  'label'       => '5 Columns',
    	  	  'value'       => '5'
    	  	),
    	    array(
    	      'label'       => '4 Columns',
    	      'value'       => '4'
    	    ),
    	    array(
    	      'label'       => '3 Columns',
    	      'value'       => '3'
    	    ),
    	    array(
    	      'label'       => '2 Columns',
    	      'value'       => '2'
    	    )
    	  ),
    	  'std'         => '5',
    	  'condition'   => 'collection_layout:is(style3)'
    	),
    	array(
    	  'label'       => 'Collection Layout Style',
    	  'id'          => 'collection_layout',
    	  'type'        => 'radio-image',
    	  'std'		  		=> 'style1'
    	),
    )
  );
  
  $album_meta_box = array(  
    'id'          => 'album_settings',
    'title'       => 'Album Settings',
    'pages'       => array( 'album' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab1',
    	  'label'       => 'Album Photos',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Display Share Icon?',
    	  'id'          => 'album_share',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will show a share icon above the photos.',
    	  'std'         => 'on',
    	),
    	array(
    	  'id' 					=> 'album_gallery',
    	  'label'       => 'Galleries to Display',
    	  'type' 				=> 'gallery_checkbox',
    	  'desc' 				=> 'Select which gallery to display inside this album'
    	),
    	array(
    	  'id'          => 'tab2',
    	  'label'       => 'Layout',
    	  'type'        => 'tab'
    	),
    	array(
    		  'label'       => 'Enable True Aspect Ratio',
    		  'id'          => 'true_aspect_ratio',
    		  'type'        => 'on_off',
    		  'desc'        => 'This will force the theme to display correct aspect ratio for the photos. However, it might break the layouts.',
    		  'std'         => 'off',
    		  'operator' 		=> 'or',
    		  'condition'   => 'album_layout:is(style1),album_layout:is(style2),album_layout:is(style3),album_layout:is(style4),album_layout:is(style5)'
    		),
    	array(
    	  'label'       => 'Album Layout Style',
    	  'id'          => 'album_layout',
    	  'type'        => 'radio-image',
    	  'std'		  		=> 'style1'
    	),
    	array(
    	  'id'          => 'tab3',
    	  'label'       => 'Photo Proof',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Enable Photo Proof?',
    	  'id'          => 'photo_proof',
    	  'type'        => 'on_off',
    	  'desc'        => 'This will enable photo proofing so you can allow customers to select images.',
    	  'std'         => 'off',
    	)
    )
  );
 	
 	$gallery_meta_box = array(  
 	  'id'          => 'gallery_settings',
 	  'title'       => 'Gallery Settings',
 	  'pages'       => array( 'gallery' ),
 	  'context'     => 'normal',
 	  'priority'    => 'high',
 	  'fields'      => array(
 	  	array(
 	  	  'id'          => 'tab1',
 	  	  'label'       => 'Gallery Photos',
 	  	  'type'        => 'tab'
 	  	),
 	  	array(
 	  	  'id' 					=> 'gallery_photos',
 	  	  'type' 				=> 'gallery',
 	  	  'post_type' 	=> 'post'
 	  	),
 	  	array(
 	  	  'id'          => 'tab2',
 	  	  'label'       => 'Layout',
 	  	  'type'        => 'tab'
 	  	),
 	  	array(
 	  	  'label'       => 'Page Padding',
 	  	  'id'          => 'page_padding',
 	  	  'type'        => 'on_off',
 	  	  'desc'        => 'This will add spacing at the top and the bottom.',
 	  	  'std'         => 'off',
 	  	),
 	  	array(
 	  	  'label'       => 'Enable True Aspect Ratio',
 	  	  'id'          => 'true_aspect_ratio',
 	  	  'type'        => 'on_off',
 	  	  'desc'        => 'This will force the theme to display correct aspect ratio for the photos. However, it might break the layouts.',
 	  	  'std'         => 'off',
 	  	  'operator' 		=> 'or',
 	  	  'condition'   => 'gallery_layout:is(style1),gallery_layout:is(style2),gallery_layout:is(style3),gallery_layout:is(style4),gallery_layout:is(style5)'
 	  	),
 	  	array(
 	  	  'label'       => 'Grid Columns',
 	  	  'id'          => 'columns',
 	  	  'type'        => 'radio',
 	  	  'choices'     => array(
 	  	  	array(
 	  	  	  'label'       => '5 Columns',
 	  	  	  'value'       => 'thb-twenty'
 	  	  	),
 	  	    array(
 	  	      'label'       => '4 Columns',
 	  	      'value'       => 'large-3'
 	  	    ),
 	  	    array(
 	  	      'label'       => '3 Columns',
 	  	      'value'       => 'large-4'
 	  	    ),
 	  	    array(
 	  	      'label'       => '2 Columns',
 	  	      'value'       => 'large-6'
 	  	    )
 	  	  ),
 	  	  'std'         => 'thb-twenty',
 	  	  'condition'   => 'gallery_layout:is(style4)'
 	  	),
 	  	array(
 	  	  'label'       => 'Gallery Layout Style',
 	  	  'id'          => 'gallery_layout',
 	  	  'type'        => 'radio-image',
 	  	  'std'		  		=> 'style1'
 	  	),
 	  	array(
 	  	  'id'          => 'tab3',
 	  	  'label'       => 'Photo Proof',
 	  	  'type'        => 'tab'
 	  	),
 	  	array(
 	  	  'label'       => 'Enable Photo Proof?',
 	  	  'id'          => 'photo_proof',
 	  	  'type'        => 'on_off',
 	  	  'desc'        => 'This will enable photo proofing so you can allow customers to select images.',
 	  	  'std'         => 'off',
 	  	)
 	  )
 	);
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  ot_register_meta_box( $page_meta_box );
  ot_register_meta_box( $collection_meta_box );
  ot_register_meta_box( $album_meta_box );
  ot_register_meta_box( $gallery_meta_box );
}