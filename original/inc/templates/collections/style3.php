<?php
	$id = get_the_ID();
	$collection_albums = get_post_meta($id, 'collection_albums', true);
	$columns = get_post_meta($id, 'style3-columns', true) ? get_post_meta($id, 'style3-columns', true) : 5;
?>
<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
<div class="page-padding max">
	<div class="row expanded no-padding">
		<div class="slick vertical" data-columns="<?php echo esc_attr($columns); ?>" data-pagination="true">
			<?php
				if ($collection_albums) {
					$i = 0;
					foreach ($collection_albums as $album) {
						$album_galleries = get_post_meta($album, 'album_gallery', true);
						$image_id = get_post_thumbnail_id($album);
						$image_url = wp_get_attachment_image_src($image_id, 'twofold-1');
						$terms = get_the_terms( $album , 'album-category' );
						$cats = '';
						if (!empty($terms)) {
							foreach ($terms as $term) { $cats .= ' filter-'.strtolower($term->slug); }
						}
						$meta = get_the_term_list( $album, 'album-category', '', ', ', '' ); 
						$meta = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $meta);
						?>
						<div class="<?php echo esc_attr($cats); ?>">
							<figure class="item">
								<a href="<?php echo get_permalink($album); ?>" class="photo album" style="background-image:url('<?php echo esc_url($image_url[0]); ?>');">
									<div class="album_overlay top">
										<span class="album_no"><?php echo esc_attr(str_pad($i+1, 2, '0', STR_PAD_LEFT)); ?></span>
										<h3><?php echo get_the_title($album); ?></h3>
										<?php if ($meta) { ?>
										<hr />
										<aside class="meta"><?php echo esc_html($meta); ?></aside>
										<?php } ?>
									</div>
								</a>
							</figure>
						</div>
						<?php
						$i++;
					}
				}
			?>
		</div>
	</div>
</div>
<?php } ?>