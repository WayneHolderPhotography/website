<?php 
	$id = get_the_ID();
	$home_video_url = get_post_meta($id, 'home_video_url', true);
?>
<div class="video-container">
	<?php do_action('thb_video_embed', $home_video_url); ?>
</div>