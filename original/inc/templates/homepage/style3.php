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
<div class="swiper-container center-slide swiper-gallery" data-effect="cube" data-speed="1000" data-autoplay="<?php echo esc_attr($home_autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($home_autoplay_speed); ?>">
    <div class="swiper-wrapper">
    	<?php $i = 1; foreach ($home_slides as $slide) { ?>
    		<?php
    			$full_image = wp_get_attachment_image_src($slide['image'], 'full');
    		?>
    		<div class="swiper-slide" style="background-image:url(<?php echo esc_attr($full_image[0]); ?>)" data-color="<?php echo esc_attr($slide['logo_color']); ?>">
    			<div class="text-container">
    		  	<h1><?php echo esc_attr($slide['title']); ?></h1>
    		  	<p><?php echo esc_attr($slide['description']); ?></p>
    		  	<?php if ($slide['home_btn'] == 'on') { ?>
    		  	<a href="<?php echo esc_attr($slide['btn_link']); ?>" class="btn"><?php echo esc_attr($slide['btn_text']); ?></a>
    		  	<?php } ?>
    			</div>
    		</div>
    	<?php $i++; } ?>
    </div>
    <?php if (get_post_meta($id, 'home_pagination', true) !== 'off') { ?>
    <!-- Add Pagination -->
    <div class="swiper-pagination">
    	<?php $i = 1; foreach ($home_slides as $slide) { ?><span class="swiper-pagination-bullet <?php if ($i == 1) { ?>swiper-pagination-bullet-active <?php } ?>"><em><?php echo esc_attr($slide['title']); ?></em></span><?php $i++; } ?>
    </div>
    <?php } ?>
</div>