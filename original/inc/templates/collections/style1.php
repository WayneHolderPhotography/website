<?php
	$id = get_the_ID();
	$page_padding = get_post_meta($id, 'page_padding', true);
	$collection_albums = get_post_meta($id, 'collection_albums', true);
	$true_aspect_ratio = get_post_meta($id, 'true_aspect_ratio', true);
?>
<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
<?php if ($page_padding == 'on') { ?><div class="page-padding"><?php } ?>
<div class="masonry isotope-grid no-padding row expanded">
	<?php
		if ($collection_albums) {
			$i = 0;
			foreach ($collection_albums as $album) {
				$album_galleries = get_post_meta($album, 'album_gallery', true);
				$column_size = thb_get_column_size('style1', $i);
				$image_id = get_post_thumbnail_id($album);
				$image_url = wp_get_attachment_image_src($image_id, 'twofold-1');
				$full_url = wp_get_attachment_image_src($image_id, 'full');
				$terms = get_the_terms( $album , 'album-category' );
				$cats = '';
				if (!empty($terms)) {
					foreach ($terms as $term) { $cats .= ' filter-'.strtolower($term->slug); }
				}
				$meta = get_the_term_list( $album, 'album-category', '', ', ', '' ); 
				$meta = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $meta);
				
				$aspect_ratio = '';
				if ($true_aspect_ratio === 'on') {
					$aspect_ratio = $image_id ? (($full_url[2] / $full_url[1]) * 100).'%' : '100%';
					$column_size .= ' thb-true-aspect';
				}
				?>
				<?php if ($true_aspect_ratio === 'on') { ?>
				<div class="item small-12 medium-6 <?php echo esc_attr($column_size.$cats.$cats); ?> columns">
					<figure <?php if ($true_aspect_ratio === 'on') { echo ' style="padding-bottom:'.$aspect_ratio.' !important"'; } ?>>
				<?php } else { ?>
					<figure class="item small-12 medium-6 <?php echo esc_attr($column_size.$cats); ?> columns">
				<?php } ?>
						<a href="<?php echo get_permalink($album); ?>" class="photo album" style="background-image:url('<?php echo esc_url($image_url[0]); ?>');">
							<div class="album_overlay">
								<h3><?php echo get_the_title($album); ?></h3>
								<?php if ($meta) { ?>
								<hr />
								<aside class="meta"><?php echo esc_html($meta); ?></aside>
								<?php } ?>
							</div>
						</a>
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
<?php if ($page_padding == 'on') { ?></div><?php } ?>
<?php } ?>