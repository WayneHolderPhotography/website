<?php 
	$id = get_the_ID();
	$home_slides = get_post_meta($id, 'home_slides', true);
	$home_autoplay = get_post_meta($id, 'home_autoplay', true);
	$home_autoplay_speed = get_post_meta($id, 'home_autoplay_speed', true);
	$total = sizeof($home_slides);
	
	$home_random = get_post_meta($id, 'home_random', true);
	if ($home_random == 'on') {
		shuffle($home_slides);
	}
?>
<div class="swiper-container swiper-gallery bottom-slide" data-autoplay="<?php echo esc_attr($home_autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($home_autoplay_speed); ?>">
    <div class="swiper-wrapper">
    	<?php $i = 1; foreach ($home_slides as $slide) { ?>
    		<?php
    			$full_image = wp_get_attachment_image_src($slide['image'], 'full');
    		?>
    		<div class="swiper-slide page-padding" style="background-image:url(<?php echo esc_attr($full_image[0]); ?>)" data-color="<?php echo esc_attr($slide['logo_color']); ?>">
    			<div class="photo-caption">
    				<em><?php echo esc_attr($i.'/'.$total); ?></em>
    				<?php echo esc_attr($slide['title']); ?>
    			</div>
    		</div>
    	<?php $i++; } ?>
    </div>
    <!-- Add Arrows -->
    <?php do_action('thb_swiper_nav'); ?>
</div>
<div class="thb-thumbnails">
	<div class="thb-thumbnail-container">
		<div class="thumbnail-toggle">
			<svg version="1.1" id="thumbnail-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="26.025px" height="26.009px" viewBox="0 0 26.025 26.009" enable-background="new 0 0 26.025 26.009" xml:space="preserve">
			<polyline class="thb-gallery-icon" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" points="1,0.997 1,24.997 25,24.997 25,0.997 
				1,0.997 25,24.997 "/>
			<polyline class="thb-thumbnail-icon" fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" points="16.318,24.997 16.318,0.997 25,0.997 
				1,24.913 "/>
			</svg>
		</div>
		<div class="swiper-container swiper-thumbnails">
	    <div class="swiper-wrapper">
	    	<?php foreach ($home_slides as $slide) { ?>
	    		<?php
	    			$full_image = wp_get_attachment_image_src($slide['image'], 'twofold-blog-style3');
	    		?>
	    		<div class="swiper-slide" style="background-image:url(<?php echo esc_attr($full_image[0]); ?>)"></div>
	    	<?php } ?>
	    </div>
		</div>
	</div>
</div>