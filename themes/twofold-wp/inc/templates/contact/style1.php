<?php 
	$locations = ot_get_option('map_locations'); 
	$contact_shortcode = get_post_meta(get_the_ID(), 'contact_shortcode', true);
?>
<div id="contact_area" class="contact-container style1">
	<div class="contact-content">
		<div class="page-padding">
			<div class="row align-center">
				<div class="small-12 medium-5 large-4 columns">
					<?php the_content(); ?>
				</div>
				<div class="small-12 medium-5 large-4 columns">
					<?php echo do_shortcode($contact_shortcode); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if (ot_get_option('contact_map', 'on') == 'on') { ?>
	<div  class="contact_map google_map" data-map-zoom="<?php echo ot_get_option('contact_zoom', 17); ?>" data-map-center-lat="<?php echo ot_get_option('map_center_lat', '59.93815'); ?>" data-map-center-long="<?php echo ot_get_option('map_center_long', '10.76537'); ?>" data-latlong='<?php echo esc_attr(json_encode($locations)); ?>' data-pin-image="<?php echo ot_get_option('map_pin_image', THB_THEME_ROOT. '/assets/img/pin.png'); ?>"></div>
	<?php } ?>
</div>