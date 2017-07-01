<?php 
if ( !thb_wc_supported() ) {
	return;
}
/* Setup WooCommerce */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	add_action( 'init', 'thb_woocommerce_image_dimensions', 1 );
	function thb_woocommerce_setup() {
	  $catalog = array(
			'width' 	=> '640',	// px
			'height'	=> '560',	// px
			'crop'		=> 1 		// true
		);
	
		$single = array(
			'width' 	=> '1100',	// px
			'height'	=> '1240',	// px
			'crop'		=> 0 		// true
		);
	
		$thumbnail = array(
			'width' 	=> '50',	// px
			'height'	=> '50',	// px
			'crop'		=> 1 		// true
		);
	
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		
	}
}

/* Side Cart */
function thb_side_cart() {
	echo '<aside class="cart_placeholder"></aside>';
 	echo '<nav id="side-cart"></nav>';
}
add_action( 'thb_side_cart', 'thb_side_cart',3 );

/* Side Cart Update */
function thb_woocomerce_side_cart_update($fragments) {
	ob_start();
	?>
	<nav id="side-cart">
		<a class="quick_cart" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php _e('View your Shopping Cart','twofold'); ?>">
				<div>
				<?php get_template_part('assets/svg/cart.svg'); ?>
				<span class="float_count"><?php echo WC()->cart->cart_contents_count; ?></span>
			</div>
		</a>
		<div id="cart-container" class="cart-container <?php if (WC()->cart->cart_contents_count < 1) { ?>empty<?php }?>">
		 	<header class="item">
		 		<h6><?php _e('SHOPPING BAG','twofold'); ?></h6>
		 		<a href="#" class="panel-close"></a>
		 	</header>
			<?php if (WC()->cart->cart_contents_count>0) : ?>
				<div class="custom_scroll" id="cart-scroll">
					<div>
						<ul>
						<?php foreach (WC()->cart->cart_contents as $cart_item_key => $cart_item) :
						    $_product = $cart_item['data'];
						    if ($_product->exists() && $cart_item['quantity']>0) :?>
								<li class="item cf">
									<figure>
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
											if ( ! $_product->is_visible() )
												echo $thumbnail;
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
										?>
									</figure>
									<div class="list_content">
										<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">×</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __('Remove this item','twofold') ), $cart_item_key ); ?>
										<?php
										 $product_title = $_product->get_title();
									       echo '<h5><a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a></h5>';
									       echo '<div>';
									       echo '<span class="quantity">'.$cart_item['quantity'].'</span><span class="cross">×</span>';
									       echo '<div class="price">'.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ).'</div>';
									       
									       echo WC()->cart->get_item_data( $cart_item );
									       echo '</div>';
										?>
									</div>
								</li>
						<?php endif; endforeach; ?>
						</ul>
						<div class="subtotal item">
						    <?php _e('Subtotal', 'twofold'); ?><?php echo WC()->cart->get_cart_total(); ?>
						</div>
					</div>
				</div>
				<div class="buttons item">
					<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="btn grey large full"><?php _e('Continue', 'twofold'); ?></a>
					<a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="btn alt large full"><?php _e('Checkout', 'twofold'); ?></a>
				</div>
			<?php else: ?>
				<div class="table">
					<div class="cart-empty text-center">
						<p class="message item"><?php _e( 'Your cart is currently empty.', 'twofold') ?></p>
						<?php do_action( 'woocommerce_cart_is_empty' ); ?>
					
						<p class="return-to-shop item"><a class="button alt large" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'twofold' ) ?></a></p>
					</div>
				</div>
			<?php endif; ?>
			</div>
	</nav>
	<?php
	if ($fragments) {
		$fragments['#side-cart'] = ob_get_clean();
		return $fragments;
	} else {
		return ob_get_clean();
	}

}
add_filter('add_to_cart_fragments', 'thb_woocomerce_side_cart_update');
add_action('thb_side_cart', 'thb_woocomerce_side_cart_update');

/* Add To Cart */
add_filter( 'woocommerce_product_add_to_cart_text', 'thb_custom_cart_button_text' );
function thb_custom_cart_button_text($text) {
	return '<div class="thb_button_icon">'.thb_load_template_part('assets/svg/arrows_plus.svg').'</div> <span>' . $text . '</span>';
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'thb_add_to_cart_link', 10, 2 );
function thb_add_to_cart_link( $link, $product ){
    $link = sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
    		esc_url( $product->add_to_cart_url() ),
    		esc_attr( isset( $quantity ) ? $quantity : 1 ),
    		esc_attr( $product->id ),
    		esc_attr( $product->get_sku() ),
    		esc_attr( isset( $class ) ? $class : 'add_to_cart_button ajax_add_to_cart' ),
    		$product->add_to_cart_text()
    	);
    return $link;
}
/* Ajax Cart Update */
function thb_woocomerce_ajax_cart_update($fragments) {
	ob_start();
	?>
		<span class="float_count"><?php echo WC()->cart->cart_contents_count; ?></span>
	<?php
	$fragments['.float_count'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update');

/* Shop Header */
// Remove orderby & breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_breadcrumb', 'woocommerce_breadcrumb', 30 );

/* Product Page */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'thb_woocommerce_after_single_product', 'woocommerce_upsell_display', 0 );
add_action( 'thb_woocommerce_after_single_product', 'woocommerce_output_related_products', 5 );


/* Post Listing */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
//woocommerce_before_shop_loop_item
add_action( 'woocommerce_before_shop_loop_item', function() {
	echo '<div class="product_holder">';
}, 5 );
//woocommerce_after_shop_loop_item
add_action( 'woocommerce_after_shop_loop_item', function() {
	echo '</div>';
}, 20 );

//woocommerce_before_shop_loop_item_title
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);
add_action( 'woocommerce_before_shop_loop_item_title', function() {
	echo '<div class="product_image_holder">';
}, 5 );
//woocommerce_before_shop_loop_item_title
add_action( 'woocommerce_before_shop_loop_item_title', function() {
	echo '</div>';
}, 20 );
//woocommerce_shop_loop_item_title
add_action( 'woocommerce_shop_loop_item_title', function() {
	echo '<div class="product_title_holder">';
}, 0 );
//woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action( 'woocommerce_after_shop_loop_item_title', function() {
	echo '</div>';
}, 20 );


// Change Thumbnail
function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
  global $post, $product;
  $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
	
	$featured = wp_get_attachment_url( get_post_thumbnail_id(), 'shop_catalog' );
	$attachment_ids = $product->get_gallery_attachment_ids();
	if ( $attachment_ids ) {
		$loop = 0;
		foreach ( $attachment_ids as $attachment_id ) {
			$image_link = wp_get_attachment_url( $attachment_id );
			if (!$image_link) continue;
			$loop++;
			$thumbnail_second = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
			if ($image_link !== $featured) {
				if ($loop == 1) break;
			}
		}
	}
	
	$style = $class = '';
	if (isset($thumbnail_second[0])) {            
		$style = 'background-image:url(' . $thumbnail_second[0] . ')';

		echo '<span class="product_thumbnail_hover" style="'.esc_attr($style).'"></span>';
	}
	
  if ( has_post_thumbnail() ) {
    $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
    return get_the_post_thumbnail( $post->ID, $image_size, array(
      'title'   => $props['title'],
      'alt'    => $props['alt']
    ) );
  } elseif ( wc_placeholder_img_src() ) {
    return wc_placeholder_img( $image_size );
  }
}

/* Post Detail */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display');
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products');
add_action('thb_woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 10);
add_action('thb_woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price');
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);

remove_action('woocommerce_before_single_product', 'wc_print_notices');
if (is_product()) {
add_action('thb_before_shop_loop_breadcrumb', 'wc_print_notices', 0);
}
add_filter( 'woocommerce_review_gravatar_size', function() {
	return 88;
} );

/* Cart Page - Move Cross Sells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

apply_filters( 'woocommerce_cross_sells_total', 3 );

/* Checkout */
add_action('woocommerce_checkout_before_customer_details', function() {
	echo '<div class="row"><div class="small-12 large-8 xlarge-9 columns">';
}, 5);

add_action('woocommerce_checkout_after_customer_details', function() {
	echo '</div><div class="small-12 large-4 xlarge-3 columns">';
}, 30);

add_action('woocommerce_checkout_after_order_review', function() {
	echo '</div></div>';
}, 30);

add_filter( 'woocommerce_output_related_products_args', 'thb_related_products_args' );
 function thb_related_products_args( $args ) {
	$args['posts_per_page'] = ot_get_option('products_per_row', 4);
	return $args;
}