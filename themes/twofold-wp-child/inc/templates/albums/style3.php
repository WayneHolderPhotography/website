<?php
	$id = get_the_ID();
	$photo_proof = get_post_meta($id, 'photo_proof', true);
	$album_galleries = get_post_meta($id, 'album_gallery', true);
	$true_aspect_ratio = get_post_meta($id, 'true_aspect_ratio', true);
	$album_share = get_post_meta($id, 'album_share', true) ? get_post_meta($id, 'album_share', true) : 'on';
	$album_photos_array = array();
	foreach ($album_galleries as $gallery) {
		$gallery_photos_array = explode(',', get_post_meta($gallery, 'gallery_photos', true));
		$album_photos_array = array_merge($album_photos_array,$gallery_photos_array);
	}
	$meta = get_the_term_list( $id, 'album-category', '', ', ', '' ); 
	$meta = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $meta);
?>
<div class="page-padding">
	<div class="page">
	<div class="" style="margin: 0 auto !important; float: none !important;  width: auto;">
	<div class="side_padding">
		<div class="row align-center expanded">
			<div class="small-12 medium-10 large-6 columns text-center album-header post">
				<?php if ($meta) { ?>
				<aside class="post-meta"><?php echo esc_html($meta); ?></aside>
				<?php } ?>
				<?php the_title('<h2 class="entry-title">', '</h2>' ); ?>
				<?php the_content(); ?>
				<?php if ($album_share === 'on') { do_action('thb_share'); } ?>
			</div>
		</div>
		<div class="masonry isotope-grid row expanded <?php if ($photo_proof == 'on') { echo 'photo-proof-enabled'; } ?>">
		<?php
			if ($album_photos_array) {
				$i = 0;
				foreach ($album_photos_array as $photo) {
					$rand = rand(0, 1000);
					$full_url = wp_get_attachment_image_src($photo, 'full');
					$image_url = wp_get_attachment_image_src($photo, 'twofold-1');
					$photo_post = get_post($photo);
					$exif = thb_get_exif_data($full_url[0]);
					
					$column_size = thb_get_column_size('style3', $i);
					$proof_class = $photo_proof == 'on' ? thb_proof_class($photo) : '';
					
					$aspect_ratio = '';
					if ($true_aspect_ratio === 'on') {
						$aspect_ratio = $photo ? (($full_url[2] / $full_url[1]) * 100).'%' : '100%';
						$column_size .= ' thb-true-aspect';
					}
					?>
					<?php if ($true_aspect_ratio === 'on') { ?>
					<div class="item small-12 medium-6 <?php echo esc_attr($column_size); ?> columns">
						<figure <?php if ($true_aspect_ratio === 'on') { echo ' style="padding-bottom:'.$aspect_ratio.' !important"'; } ?>>
					<?php } else { ?>
						<figure class="item small-12 medium-6 <?php echo esc_attr($column_size); ?> columns">
					<?php } ?>
							<?php do_action('thb_render_photo', $photo_proof, $proof_class, $photo, $image_url, $full_url, $rand); ?>
							<div id="photo-caption-<?php echo esc_attr($rand); ?>" style="display: none;">
							  <div class="row image-information no-padding expanded">
							  	<div class="small-12 medium-6 columns image-caption">
							  		<?php echo apply_filters('the_excerpt', $photo_post->post_excerpt); ?>
							  	</div>
							  	<?php do_action('thb_render_buynow', $photo); ?>
							  	<div class="small-12 medium-6 columns image-exif">
							  		<ul>
							  		<?php foreach ($exif as $value) { ?>
							  			<li> <span><?php echo esc_attr($value["title"]); ?></span>
							  					<?php echo esc_attr($value["data"]); ?>
							  			</li>
							  		<?php } ?>
							  		</ul>
							  	</div>
							  </div>
							</div>
						</figure>
					<?php if ($true_aspect_ratio === 'on') { ?>
					</div>
					<?php } ?>
					<?php
					$i++;
				}
			}
		?>
		</div>
	</div>
</div>
</div>
</div>