<?php
/* Theme Support */
function thb_theme_setup() {
	/* WooCommerce Support */
	add_theme_support( 'woocommerce' );
	if( $products_per_page = ot_get_option('products_per_page', '12')) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );
	}
	/* Text Domain */
	load_theme_textdomain('twofold', THB_THEME_ROOT_ABS . '/inc/languages');
	
	/* Background Support */
	add_theme_support( 'custom-background', array( 'default-color' => 'ffffff', 'wp-head-callback' => 'thb_change_custom_background_cb' ) );
	
	/* Title Support */
	add_theme_support( 'title-tag' );
	
	/* Editor Styling */
	$body_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Droid+Serif:200,300,400,500,600,700&subset=latin,latin-ext' );
	$title_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&subset=latin,latin-ext' );
	add_editor_style( array($body_url, $title_url, 'editor-style.css') );
	
	/* Required Settings */
	global $content_width;
	if(!isset($content_width)) $content_width = 1170;
	add_theme_support( 'automatic-feed-links' );
	
	/* Image Settings */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 80, 75, true );
	add_image_size('twofold-1', 800, 600, true );
	add_image_size('twofold-true', 800, 600, true );
	add_image_size('twofold-2', 9999, 380, false );
	add_image_size('twofold-blog-style1', 800, 9999, false );
	add_image_size('twofold-blog-style2', 1050, 640, true );
	add_image_size('twofold-blog-style3', 600, 400, true );
	add_image_size('twofold-collection-style1', 320, 180, true );
	
	if (false === get_option("medium_crop")) {
	    add_option("medium_crop", "1");
	} else {
	    update_option("medium_crop", "1");
	}
	  
	/* HTML5 Galleries */
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'thb_theme_setup' );

/* Adds custom classes to the array of body classes. */
function thb_body_classes( $classes ) {
	$id = get_the_ID();
	$home_layout = get_post_meta($id, 'home_layout', true) ? get_post_meta($id, 'home_layout', true) : 'style1';
	$color_theme = ot_get_option('color_theme', 'light-theme');
	$lightbox_theme = ot_get_option('lightbox_theme', 'light-box');
	$lightbox_downloads = ot_get_option('lightbox_downloads', 'lightbox-download-enabled');
	$lightbox_zoom = ot_get_option('lightbox_zoom', 'lightbox-zoom-enabled');
	$lightbox_autoplay = ot_get_option('lightbox_autoplay', 'lightbox-autoplay-enabled');
	$preloader = ot_get_option('preloader', 'on') !== 'off' ? 'thb-preload' : false ;
	$menu_position = ot_get_option('menu_position', 'thb-menu-left');
	$menu_type = ot_get_option('menu_type', 'thb-mobile-icon') . '-enabled';
	$logo_position = ot_get_option('logo_position', 'thb-logo-left');
	$classes[] = $lightbox_downloads;
	$classes[] = $lightbox_zoom;
	$classes[] = $lightbox_autoplay;
	$classes[] = $color_theme;
	$classes[] = $lightbox_theme;
	$classes[] = $preloader;
	$classes[] = $menu_position;
	$classes[] = $menu_type;
	$classes[] = $logo_position;
	
	if ($home_layout == 'style7') {
		$classes[] = 'thb_video_background';
	}
	return $classes;
}
add_filter( 'body_class', 'thb_body_classes' );

/* Read More */
function thb_excerpt_more( $more ) {
	$blog_style = ot_get_option('blog_style', 'style3');
	$id = get_the_ID();
	if ($blog_style == 'style1' ) {
		return '…';
	} else {
    return '… <a class="excerpt-dot" href="'. get_permalink( $id ) . '" title="'. get_the_title( $id ) . '"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="30.2" height="14.2" viewBox="0 0 30.2 14.2" enable-background="new 0 0 30.167 14.168" xml:space="preserve"><path d="M0.1 7.1c0-0.4 0.4-0.8 0.8-0.8h26.5l-5-4.9c-0.3-0.3-0.3-0.8 0-1.1 0.3-0.3 0.8-0.3 1.1 0l6.3 6.2c0.3 0.3 0.3 0.8 0 1.1l-6.3 6.2c-0.2 0.2-0.4 0.2-0.6 0.2 -0.2 0-0.4-0.1-0.6-0.2 -0.3-0.3-0.3-0.8 0-1.1l4.9-4.8H0.9C0.5 7.9 0.1 7.6 0.1 7.1z"/></svg></a>';
	}
}
add_filter( 'excerpt_more', 'thb_excerpt_more' );

/* Social Icons */
function thb_social_footer() {
	?>
		<?php if ($fb = ot_get_option('fb_link')) { ?>
		<a href="<?php echo esc_url($fb); ?>" class="social facebook" target="_blank"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if ($pi = ot_get_option('pinterest_link')) { ?>
		<a href="<?php echo esc_url($pi); ?>" class="social pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>
		<?php } ?>
		<?php if ($tw = ot_get_option('twitter_link')) { ?>
		<a href="<?php echo esc_url($tw); ?>" class="social twitter" target="_blank"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if ($li = ot_get_option('linkedin_link')) { ?>
		<a href="<?php echo esc_url($li); ?>" class="social linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
		<?php } ?>
		<?php if ($in = ot_get_option('instragram_link')) { ?>
		<a href="<?php echo esc_url($in); ?>" class="social instagram" target="_blank"><i class="fa fa-instagram"></i></a>
		<?php } ?>
		<?php if ($xi = ot_get_option('xing_link')) { ?>
		<a href="<?php echo esc_url($xi); ?>" class="social xing" target="_blank"><i class="fa fa-xing"></i></a>
		<?php } ?>
		<?php if ($tu = ot_get_option('tumblr_link')) { ?>
		<a href="<?php echo esc_url($tu); ?>" class="social tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>
		<?php } ?>
		<?php if ($vk = ot_get_option('vk_link')) { ?>
		<a href="<?php echo esc_url($vk); ?>" class="social vk" target="_blank"><i class="fa fa-vk"></i></a>
		<?php } ?>
		<?php if ($gp = ot_get_option('googleplus_link')) { ?>
		<a href="<?php echo esc_url($gp); ?>" class="social google-plus" target="_blank"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
		<?php if ($sc = ot_get_option('soundcloud_link')) { ?>
		<a href="<?php echo esc_url($sc); ?>" class="social soundcloud" target="_blank"><i class="fa fa-soundcloud"></i></a>
		<?php } ?>
		<?php if ($dr = ot_get_option('dribbble_link')) { ?>
		<a href="<?php echo esc_url($dr); ?>" class="social dribbble" target="_blank"><i class="fa fa-dribbble"></i></a>
		<?php } ?>
		<?php if ($yt = ot_get_option('youtube_link')) { ?>
		<a href="<?php echo esc_url($yt); ?>" class="social youtube" target="_blank"><i class="fa fa-youtube"></i></a>
		<?php } ?>
		<?php if ($sp = ot_get_option('spotify_link')) { ?>
		<a href="<?php echo esc_url($sp); ?>" class="social spotify" target="_blank"><i class="fa fa-spotify"></i></a>
		<?php } ?>
		<?php if ($be = ot_get_option('behance_link')) { ?>
		<a href="<?php echo esc_url($be); ?>" class="social behance" target="_blank"><i class="fa fa-behance"></i></a>
		<?php } ?>
		<?php if ($da = ot_get_option('deviantart_link')) { ?>
		<a href="<?php echo esc_url($da); ?>" class="social deviantart" target="_blank"><i class="fa fa-spotify"></i></a>
		<?php } ?>
		<?php if ($vi_link = ot_get_option('vimeo_link')) { ?>
		<a href="<?php echo esc_url($vi_link); ?>" target="_blank" class="social vimeo"><i class="fa fa-vimeo"></i></a>
		<?php } ?>
		<?php if ($fivehundred_link = ot_get_option('fivehundred_link')) { ?>
		<a href="<?php echo esc_url($fivehundred_link); ?>" target="_blank" class="social fivehundred"><i class="fa fa-500px"></i></a>
		<?php } ?>
		<?php if ($flickr_link = ot_get_option('flickr_link')) { ?>
		<a href="<?php echo esc_url($flickr_link); ?>" target="_blank" class="social flickr"><i class="fa fa-flickr"></i></a>
		<?php } ?>
	<?php
}
add_action( 'thb_social_footer', 'thb_social_footer',3 );

/* Pagination */
function thb_pagination() {
	$blog_pagination_style = ot_get_option('blog_pagination_style', 'style1');
	
	if ($blog_pagination_style == 'style1' || is_archive()) {
	?>
		<div class="row align-center">
			<div class="small-12 medium-10 large-9 columns">
				<?php the_posts_pagination(array(
					'prev_text' 	=> '<span>'.esc_html__( "Older", 'twofold' ).'</span>',
					'next_text' 	=> '<span>'.esc_html__( "Newer", 'twofold' ).'</span>',
					'mid_size'		=> 4
				)); ?>
			</div>
		</div>
	<?php
	} else if ($blog_pagination_style == 'style2') {
	?>
	<div class="row pagination-space">
		<div class="small-12 columns text-center">
			<a href="#" class="thb_load_more btn" title="<?php esc_html_e('Load More', 'twofold'); ?>" data-count="<?php echo esc_attr(get_option('posts_per_page')); ?>"><?php esc_html_e('Load More', 'twofold'); ?></a>
		</div>
	</div>
	<?php
	}
}
add_action( 'thb_pagination', 'thb_pagination',3 );

/* Swiper Navigation */
function thb_swiper_nav() {
	$mouse_effect = ot_get_option('mouse_effect','style1');
	
	if ($mouse_effect == 'style1') {
	?>
	<div class="swiper-button-next swiper-nav swiper-cursor square">
		<svg version="1.1" class="thb-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="79.333px" height="79.417px" viewBox="0 0 79.333 79.417" enable-background="new 0 0 79.333 79.417" xml:space="preserve">
	  	<path class="thb-tmp" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M39.667,1.829l38,38l-38,38l-38-38L39.667,1.829z"/>
	  	<path class="thb-progress" fill="none" stroke="#F9ED25" stroke-width="2" stroke-miterlimit="10" d="M39.667,1.829l38,38l-38,38l-38-38L39.667,1.829z"/>
	  	<path fill="none" class="thb-arrow-inner" stroke="#000000" stroke-miterlimit="10" d="M44.418,24.171l16,15.995 M59.783,40.087L44.379,55.487"/>
		</svg>
	</div>
	<div class="swiper-button-prev swiper-nav swiper-cursor square">
		<svg version="1.1" class="thb-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="79.333px" height="79.417px" viewBox="0 0 79.333 79.417" enable-background="new 0 0 79.333 79.417" xml:space="preserve">
		<path class="thb-tmp" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M39.667,1.829l38,38l-38,38l-38-38L39.667,1.829z"/>
		<path class="thb-progress" fill="none" stroke="#F9ED25" stroke-width="2" stroke-miterlimit="10" d="M39.667,1.829l38,38l-38,38l-38-38L39.667,1.829z"/>
		<path fill="none" class="thb-arrow-inner" stroke="#000000" stroke-miterlimit="10" d="M19.379,40.167l16-15.995 M35.417,55.487L20.014,40.087"/>
		</svg>
	</div>
	<?php
	} else if ($mouse_effect == 'style2') {
	?>
	<div class="swiper-button-next swiper-nav swiper-cursor circle">
		
		<svg version="1.1" class="thb-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="79.333px" height="79.417px" viewBox="0 0 79.333 79.417" enable-background="new 0 0 79.333 79.417" xml:space="preserve">
		<path class="thb-arrow-inner" fill="none" stroke="#000000" stroke-miterlimit="10" d="M34.418,24.171l16,15.995 M49.784,40.087l-15.404,15.4"/>
		<circle class="thb-tmp" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" cx="39.667" cy="39.829" r="38"/>
		<path class="thb-progress" fill="none" stroke="#F9ED25" stroke-width="2" stroke-miterlimit="10" d="M39.666,1.83c20.986,0,37.999,17.014,37.999,38
			s-17.013,38-37.999,38c-20.987,0-38-17.014-38-38S18.679,1.83,39.666,1.83z"/>
		</svg>
	</div>
	<div class="swiper-button-prev swiper-nav swiper-cursor circle">
		<svg version="1.1" class="thb-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="79.333px" height="79.417px" viewBox="0 0 79.333 79.417" enable-background="new 0 0 79.333 79.417" xml:space="preserve">
		<path class="thb-arrow-inner" fill="none" stroke="#000000" stroke-miterlimit="10" d="M30.379,40.166l16-15.995 M46.418,55.487l-15.404-15.4"/>
		<circle class="thb-tmp" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" cx="39.667" cy="39.829" r="38"/>
		<path class="thb-progress" fill="none" stroke="#F9ED25" stroke-width="2" stroke-miterlimit="10" d="M39.666,1.83c20.986,0,37.999,17.014,37.999,38
			s-17.013,38-37.999,38c-20.987,0-38-17.014-38-38S18.679,1.83,39.666,1.83z"/>
		</svg>
	</div>
	<?php
	} else if ($mouse_effect == 'style3') {
	?>
	<div class="swiper-button-next swiper-nav swiper-cursor regular"></div>
	<div class="swiper-button-prev swiper-nav swiper-cursor regular"></div>
	<?php
	}
}
add_action( 'thb_swiper_nav', 'thb_swiper_nav', 3, 3 );

/* Column Sizes */
function thb_get_column_size($style = 'style1', $i = 0) {
	$prefix = 'twofold-';
	if ($style == 'style1') {
		switch ($i) {
			case 0:
			case 2:
			case 6:
			case 10:
			case 14:
			case 18:
			case 22:
			case 26:
				$image_size = 'thb-twenty height-3';
				break;
			case 1:
			case 7:
			case 13:
			case 19:
			case 25:
			case 31:
				$image_size = 'thb-twenty height-1-5';
				break;
			case 3:
			case 8:
			case 15:
			case 20:
				$image_size = 'thb-twenty height-2';
				break;
			case 4:
			case 5:
			case 9:
			case 16:
			case 17:
			case 23:
			case 24:
				$image_size = 'thb-twenty height-3-4';
				break;
			default:
				$image_size = 'thb-twenty height-3-4';
				break;
		}
	} else if ($style == 'style2') {
		switch ($i) {
			case 0:
			case 8:
				$image_size = 'thb-forty height-2';
				break;
			case 1:
			case 2:
			case 4:
			case 5:
			case 7:
			default:
				$image_size = 'thb-twenty height-1-5';
				break;
			case 3:
			case 6:
				$image_size = 'thb-twenty height-3';
				break;
		}
	} else if ($style == 'style3') {
		switch ($i) {
			case 0:
			case 3:
			case 5:
			case 7:
			case 9:
			case 11:
			case 13:
			case 15:
			case 17:
			case 19:
			case 21:
			case 23:
			case 25:
				$image_size = 'thb-twentyfive height-3';
				break;
			case 2:
			case 4:
			case 6:
			case 8:
			case 10:
			case 12:
			case 14:
			case 16:
			case 18:
			case 18:
			case 20:
			case 22:
			case 24:
				$image_size = 'thb-twentyfive height-3-4';
				break;
			default:
				$image_size = 'thb-twentyfive height-2';
				break;
		}
	} else if ($style == 'style4') {
		$image_size = 'thb-twenty height-1-5';
	}
	return $image_size;
}

/* Article Prev/Next */
function thb_article_nav() {
	$prev = get_previous_post();
	$next = get_next_post();
	if ($prev) {
	?>
		<a href="<?php echo get_permalink($prev->ID); ?>" class="post_nav prev"><div class="rel"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9.981px" height="17.982px" viewBox="0 0 9.981 17.982" enable-background="new 0 0 9.981 17.982" xml:space="preserve"><polygon fill-rule="evenodd" clip-rule="evenodd" points="9.981,1.111 8.873,0 0,8.952 0.04,8.991 0,9.031 8.873,17.982 9.981,16.872 2.171,8.992"/></svg><span><?php echo esc_attr($prev->post_title); ?></span></div></a>
	<?php
	}
	if ($next) {
	?>
		<a href="<?php echo get_permalink($next->ID); ?>" class="post_nav next"><div class="rel"><span><?php echo esc_attr($next->post_title); ?></span><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9.981px" height="17.982px" viewBox="0 0 9.981 17.982" enable-background="new 0 0 9.981 17.982" xml:space="preserve"><polygon fill-rule="evenodd" clip-rule="evenodd" points="0,16.872 1.108,17.982 9.981,9.031 9.942,8.991 9.981,8.951 1.108,0 0,1.11 7.811,8.991"/></svg></div></a>
	<?php
	}
}
add_action( 'thb_article_nav', 'thb_article_nav', 3, 3 );

/* Collection Filter */
function thb_collection_nav() {
	$id = get_the_ID();
	$album_filter = get_post_meta($id, 'album_filter', true);
	$album_taxonomy = get_post_meta($id, 'album_taxonomy', true);
	$cats = get_terms(array('album-category'), array('include' => $album_taxonomy));
	if ($album_filter == 'on') {
	?>
	<aside class="collection_filter">
		<select>
			<option value="*"><?php esc_html_e('All', 'twofold'); ?></option>
			<?php 
				foreach($cats as $cat) {
					
					echo '<option value=".filter-' . $cat->slug . '">' . $cat->name . '</option>';
					
				}
			?>
		</select>	
	</aside>
	<?php
	}
}
add_action( 'thb_collection_nav', 'thb_collection_nav', 3, 3 );

/* Collection Filter */
function thb_render_buynow($photo) {
	$attachment_fields = get_post_custom( $photo );
	$product_id = ( isset( $attachment_fields['_thb_product_id'][0] ) && ! empty( $attachment_fields['_thb_product_id'][0] ) ) ? $attachment_fields['_thb_product_id'] : '';
	if ($product_id && thb_wc_supported()) {
		$product = wc_get_product($product_id[0]);
		
		if ($product) {
		?>
			<a href="<?php echo get_permalink($product_id[0]); ?>" title="<?php echo get_the_title($product_id[0]); ?>" class="button rounded white"><?php esc_html_e('Buy This Photo', 'twofold'); ?></a>
		<?php	
		}
	}
}
add_action( 'thb_render_buynow', 'thb_render_buynow', 3, 1 );

/* Render Photo */
function thb_render_photo($photo_proof, $proof_class, $photo, $image_url, $full_url, $rand) {
	$style = ot_get_option('image_effect');
	$attachment_fields = get_post_custom( $photo );
	$video_url = ( isset( $attachment_fields['_video_url'][0] ) && ! empty( $attachment_fields['_video_url'][0] ) ) ? $attachment_fields['_video_url'] : '';
	$full_url = $video_url ? $video_url : $full_url;
	$html5 = false;
	if( !(strpos($full_url[0], 'youtu.be') !== false || strpos($full_url[0], 'youtube.com') !== false || strpos($full_url[0], 'vimeo.com')) ) {
		$html5 = true;
	}
	$html5check = $html5 && ( isset( $attachment_fields['_video_url'][0] ) && ! empty( $attachment_fields['_video_url'][0] ) );
	if ( $html5 && ( isset( $attachment_fields['_video_url'][0] ) && ! empty( $attachment_fields['_video_url'][0] ) ) ) {
	?>
		<div id="video-html-<?php echo esc_attr($rand); ?>" style="display: none;">
			<video class="lg-video-object lg-html5" controls preload="none">
	        <source src="<?php echo esc_url($full_url[0]); ?>">
	    </video>
		</div>
	<?php	
	}
	if ($style == 'style2') {
	?>
		<div class="photo atvImg <?php echo esc_attr($proof_class); ?>">
			<?php if ($photo_proof == 'on') { ?>
			<div class="atvImg-layer"><div class="inside"><span class="label">#<?php echo esc_attr($photo); ?></span>
				<a class="proof-it" data-id="<?php echo esc_attr($photo); ?>"></a></div></div>
			<?php } ?>
			<div class="atvImg-layer photo_layer" data-img="<?php echo esc_url($image_url[0]); ?>" rel="lightbox" <?php if ($html5check) { ?>data-html="#video-html-<?php echo esc_attr($rand); ?>" href=""<?php } else { ?>href="<?php echo esc_attr($full_url[0]); ?>"<?php } ?> data-sub-html="#photo-caption-<?php echo esc_attr($rand); ?>"></div>
		</div>
	<?php
	} else if ($style == 'style1') {
	?>
		<div class="photo simple-hover <?php echo esc_attr($proof_class); ?>" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);">
			<?php if ($photo_proof == 'on') { ?>
			<div class="inside"><span class="label">#<?php echo esc_attr($photo); ?></span><a class="proof-it" data-id="<?php echo esc_attr($photo); ?>"></a></div>
			<?php } ?>
			<a class="photo_link" rel="lightbox" <?php if ($html5check) { ?>data-html="#video-html-<?php echo esc_attr($rand); ?>" href=""<?php } else { ?>href="<?php echo esc_attr($full_url[0]); ?>"<?php } ?> data-sub-html="#photo-caption-<?php echo esc_attr($rand); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="30" height="30" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><rect fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect x="28" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect x="20" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect y="20" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect y="28" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect x="28" y="20" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect x="20" y="28" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect x="14" y="10" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect x="10" y="14" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/></svg>
			</a>
		</div>
	<?php	
	} else if ($style == 'style3') {
	?>
		<div class="photo pan-hover <?php echo esc_attr($proof_class); ?>">
			<?php if ($photo_proof == 'on') { ?>
			<div class="inside"><span class="label">#<?php echo esc_attr($photo); ?></span><a class="proof-it" data-id="<?php echo esc_attr($photo); ?>"></a></div>
			<?php } ?>
			<a class="photo_link" rel="lightbox" <?php if ($html5check) { ?>data-html="#video-html-<?php echo esc_attr($rand); ?>" href=""<?php } else { ?>href="<?php echo esc_attr($full_url[0]); ?>"<?php } ?> data-sub-html="#photo-caption-<?php echo esc_attr($rand); ?>">
				<div class="pan-hover-inside" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></div>
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="30" height="30" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><rect fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect x="28" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect x="20" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect y="20" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect y="28" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect x="28" y="20" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect x="20" y="28" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/><rect x="14" y="10" fill-rule="evenodd" clip-rule="evenodd" width="2" height="10"/><rect x="10" y="14" fill-rule="evenodd" clip-rule="evenodd" width="10" height="2"/></svg>
			</a>
		</div>
	<?php	
	}
}
add_action( 'thb_render_photo', 'thb_render_photo', 6, 6 );

/* Share Lightbox */
add_action( 'thb_share', array ( 'THB_share', 'thb_render_button' ), 2 );
class THB_share {
  protected static $rand = '';
	protected static $id = '';
  public static function thb_render_button($id) { 
    self::$rand = rand(0,1000);
    self::$id = $id;
    ?>
    	<a href="#share-<?php echo esc_attr(self::$rand); ?>" class="photo_action share_button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16.008px" height="19.995px" viewBox="0 0 16.008 19.995" enable-background="new 0 0 16.008 19.995" xml:space="preserve"><polygon points="12.463,4.315 8.076,0 3.689,4.315 4.387,5.001 7.644,1.797 7.644,13.732 8.562,13.732 8.562,1.85 11.766,5.001"/><path d="M5.193,7.986H0V7.188h5.193V7.986z M16.008,7.188h-5.193v0.799h5.193V7.188z M15.209,7.987v12.008h0.799V7.987H15.209z M16.008,19.188H0v0.799h16.008V19.188z M0,7.986v12.009h0.799V7.986H0z"/></svg></a>
    <?php
    add_action( 'wp_footer', array ( __CLASS__, 'thb_share_footer' ) );
  }
  public static function thb_share_footer() {
	  $id = self::$id == '' ? get_the_ID() : self::$id;
	  $permalink = get_permalink($id);
	  $title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	  $image_id = get_post_thumbnail_id($id);
	  $image = wp_get_attachment_image_src($image_id,'full');
	  ?>
	  	<aside id="share-<?php echo esc_attr(self::$rand); ?>" class="share_screen">
	  		<ul class="photo-actions">
	  			<li><a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon facebook social"><span><i class="fa fa-facebook"></i></span></a></li>
	  			<li><a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( get_bloginfo( 'name' ) ) . ''; ?>" class="boxed-icon twitter social"><span><i class="fa fa-twitter"></i></span></a></li>
	  			<li><a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon google-plus social"><span><i class="fa fa-google-plus"></i></span></a></li>
	  			<li><a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . ''; ?>" class="boxed-icon pinterest social" nopin="nopin" data-pin-no-hover="true"><span><i class="fa fa-pinterest"></i></span></a></li>
	  			<li><a href="mailto:?Subject=<?php echo htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&Body=<?php echo esc_url( $permalink ); ?>" class="boxed-icon social mail"><span><i class="fa fa-envelope"></i></span></a></li>
	  		</ul>
	  	</aside>
	  <?php
  }
}

/* Get Exif Data */
function thb_get_exif_data($img) {
	$exif = array();
	$lightbox_exif = ot_get_option('lightbox_exif', 'on');
	if (function_exists('wp_read_image_metadata') && $lightbox_exif == 'on') {
		$uploads = wp_upload_dir();
		$image_path = str_replace( $uploads['baseurl'], $uploads['basedir'], $img );
		$image_data = wp_read_image_metadata($image_path);
		
		
		if ($image_data["aperture"]) {
			$exif["aperture"] = array(
			 'title' => esc_html__('Aperture', 'twofold'),
			 'data' => 'ƒ/'.$image_data["aperture"]
			);
		}
		if ($image_data["focal_length"]) {
			$exif["focal_length"] =array(
			'title' => esc_html__('F.Length', 'twofold'),
			'data' => $image_data["focal_length"]. 'mm'
			);
		}
		if ($image_data["iso"]) {
			$exif["iso"] = array(
			'title' => esc_html__('ISO', 'twofold'),
			'data' => $image_data["iso"]
			);
		}
		if ($image_data["shutter_speed"]) {
			$exif["exposure"] = array(
			'title' => esc_html__('Exposure', 'twofold'),
			'data' => '1/'.round(1 / $image_data["shutter_speed"]).'ms'
			);
		}
	}
	return $exif;
}

/* Proofing Class */
function thb_proof_class( $attachment_id ) {
	$data = wp_get_attachment_metadata( $attachment_id );

	if ( isset( $data[ 'checked' ] ) && ! empty( $data[ 'checked' ] ) && $data[ 'checked' ] == 'true' ) {
		return 'checked';
	} else {
		return '';
	}
}

/* Remove Inline Image Width */
add_filter('img_caption_shortcode_width', 'fix_caption_width_hack', 10, 3);
function fix_caption_width_hack( $caption_width, $atts, $content ) {
   return 0;
}

/* Custom Password Protect Form */
function thb_password_form() {
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p class="password-text">' . esc_html__( "This is a protected area. Please enter your password:", 'twofold' ) . '</p>
    <input name="post_password" type="password" placeholder="' . esc_html__('Password', 'twofold') . '"/><br />
    <input type="submit" name="Submit" class="btn" value="' . esc_attr__( 'Submit', 'twofold' ) . '" /></form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'thb_password_form' );

/* Add Collections to Front Page dropdown */
function thb_add_pages_to_dropdown( $pages, $r ){
  $args = array(
      'post_type' => 'collection'
  );
  $stacks = get_posts($args);
  $pages = array_merge($pages, $stacks);

  return $pages;
}
add_filter( 'get_pages', 'thb_add_pages_to_dropdown', 10, 2 );



/* Video URL field for Attachments */
function thb_register_attachments(){

	// add video support for attachments
	function thb_attachment_fields($form_fields, $post){
		if ( !isset($form_fields["product_id"]) ) {
			$form_fields["thb_product_id"] = array(
				"label" => __("Product ID", 'twofold' ),
				"input" => "text", // this is default if "input" is omitted
				"value" => esc_attr( get_post_meta($post->ID, "_thb_product_id", true) ),
				"helps" => __("<p class='desc'>This is the WooCommerce product ID.</p>", 'twofold' ),
			);
		}
		if ( !isset($form_fields["video_url"]) ) {
			$form_fields["video_url"] = array(
				"label" => __("Video URL", 'twofold' ),
				"input" => "text", // this is default if "input" is omitted
				"value" => esc_url( get_post_meta($post->ID, "_video_url", true) ),
				"helps" => __("<p class='desc'>You can add Youtube, Vimeo, VK or HTML5 video formats. Such as MP4, WebM and Ogg.</p>", 'twofold' ),
			);
		}
		return $form_fields;
	}
	add_filter("attachment_fields_to_edit", "thb_attachment_fields", 99999, 2);

	function thb_attachment_fields_save( $post, $attachment ) {
		if ( isset( $attachment['thb_product_id'] ) ) {
			update_post_meta( $post['ID'], '_thb_product_id', esc_attr($attachment['thb_product_id']) );
		}
		if ( isset( $attachment['video_url'] ) ) {
			update_post_meta( $post['ID'], '_video_url', esc_url($attachment['video_url']) );
		}
		return $post;
	}
	add_filter("attachment_fields_to_save", "thb_attachment_fields_save", 9999 , 2);
}

add_action('init', 'thb_register_attachments');

/* Youtube & Vimeo Embeds */
function thb_remove_youtube_controls($code){
  if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false || strpos($code, 'player.vimeo.com') !== false){
  		if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false) {
      	$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&modestbranding=1", $code);
  		} else {
      	$return = $code;
  		}
      $return = '<div class="flex-video widescreen'.(strpos($code, 'player.vimeo.com') !== false ? ' vimeo' : ' youtube').'">'.$return.'</div>';
  } else {
      $return = $code;
  }
  return $return;
}
 
add_filter('embed_handler_html', 'thb_remove_youtube_controls');
add_filter('embed_oembed_html', 'thb_remove_youtube_controls');

/* Video Embed */
function thb_video_embed($embed_url) {
	global $wp_embed;
	$file = wp_check_filetype($embed_url);
	if ($file['ext']) {
		echo wp_video_shortcode(array(
			'src' => $embed_url,
			'autoplay' => 'on'
		));
	} else {
		echo $wp_embed->run_shortcode('[embed]'.$embed_url.'[/embed]');
	}

}
add_action( 'thb_video_embed', 'thb_video_embed', 3, 3 );

/* Custom Background Support */
function thb_change_custom_background_cb() {
    $background = get_background_image();
    $color = get_background_color();
 
    if ( ! $background && ! $color )
        return;
 
    $style = $color ? "background-color: #$color;" : '';
 
    if ( $background ) {
        $image = " background-image: url('$background');";
 
        $repeat = get_theme_mod( 'background_repeat', 'repeat' );
 
        if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
            $repeat = 'repeat';
 
        $repeat = " background-repeat: $repeat;";
 
        $position = get_theme_mod( 'background_position_x', 'left' );
 
        if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
            $position = 'left';
 
        $position = " background-position: top $position;";
 
        $attachment = get_theme_mod( 'background_attachment', 'scroll' );
 
        if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
            $attachment = 'scroll';
 
        $attachment = " background-attachment: $attachment;";
 
        $style .= $image . $repeat . $position . $attachment;
    }
?>
<style type="text/css">
body.custom-background #wrapper { <?php echo trim( $style ); ?> }
</style>
<?php
}

/* Add Lightbox Class */
function thb_image_rel($content) {	
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox"$6>$7</a>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
add_filter('the_content', 'thb_image_rel');

/* Load Template */
function thb_load_template_part($template_name) {
    ob_start();
    get_template_part($template_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}
/* WooCommerce Check */
function thb_wc_supported() {
	return is_array( get_option( 'active_plugins' ) ) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}
function thb_is_woocommerce() {
	if (!thb_wc_supported()) {
		return false;	
	}
	return (is_woocommerce() || is_cart() || is_checkout() || is_account_page());
}