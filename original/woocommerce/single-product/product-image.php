<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;

$shop_product_lightbox = ot_get_option('shop_product_lightbox', 'lightbox');
if( $product->has_child() && $product->is_type( 'variable' )) { 
	$available_variations = $product->get_available_variations();
}
$attachment_ids = $product->get_gallery_image_ids();
$lightbox_en = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;
?>
<div class="woocommerce-product-gallery <?php //echo 'woocommerce-product-gallery--columns-' . sanitize_html_class( $columns ) . ' columns-' . sanitize_html_class( $columns ); ?> images">
	<div id="product-images" class="lightbox-gallery">
			<?php if ( $attachment_ids ) {								
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					$image_src_link = wp_get_attachment_image_src($attachment_id,'full');
					$src = wp_get_attachment_image_src( $attachment_id, false, '' );
					$src_small = wp_get_attachment_image_src( $attachment_id,  apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
					$image_title = esc_attr( get_the_title( $attachment_id ) );
					$attr = '';
					if (isset($available_variations)) {
						foreach($available_variations as $prod_variation) {
						  if ($src_small[0] == $prod_variation['image']['src']) {
						  	$attr .= implode(',', $prod_variation['attributes']) . ',';
						  }
						}
					}
					$attr = trim($attr, ',');
					?>
						<figure itemprop="image" data-variation="<?php echo esc_attr($attr); ?>">
							<?php if ($lightbox_en) { ?>
							<a href="<?php echo esc_attr($src[0]); ?>" rel="lightbox" itemprop="image" data-size="<?php echo esc_attr($src_small[1].'x'.$src_small[2]); ?>">
							<?php } ?>
								<img src="<?php echo esc_attr($src_small[0]); ?>" title="<?php echo esc_attr($image_title); ?>" />
							<?php if ($lightbox_en) { ?>
							</a>
							<?php } ?>
						</figure>
					
					<?php
				}
			}
		?>
	</div>
</div>