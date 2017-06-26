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