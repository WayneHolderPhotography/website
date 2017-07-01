<?php
	$id = get_the_ID();
	$collection_albums = get_post_meta($id, 'collection_albums', true);
	$true_aspect_ratio = get_post_meta($id, 'true_aspect_ratio', true);
?>
<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
<div class="page-padding">
	<div class="side_padding">
		<div class="row expanded">
			<div class="small-12 columns isotope-grid">
				<?php
					if ($collection_albums) {
						foreach ($collection_albums as $album) {
							$terms = get_the_terms( $album , 'album-category' );
							$cats = '';
							if (!empty($terms)) {
								foreach ($terms as $term) { $cats .= ' filter-'.strtolower($term->slug); }
							}
							?>
							<div class="item collection_album <?php echo esc_attr($cats); ?>">
								<h6><a href="<?php echo get_permalink($album); ?>" title="<?php the_title_attribute(false,false, true, $album); ?>"><?php echo get_the_title($album); ?></a></h6>
								<div class="custom_scroll" id="album-scroll-<?php echo esc_attr(rand(0,999)); ?>" data-horizontal="true">
									<ul>
										<?php
											$album_galleries = get_post_meta($album, 'album_gallery', true);
											$album_photos_array = array();
											if ($album_galleries) {
												foreach ($album_galleries as $gallery) {
													$gallery_photos_array = explode(',', get_post_meta($gallery, 'gallery_photos', true));
													$album_photos_array = array_merge($album_photos_array,$gallery_photos_array);
												}
												foreach ($album_photos_array as $photo) {
													
													$rand = rand(0, 1000);
													$full_url = wp_get_attachment_image_src($photo, 'full');
													$image_url = wp_get_attachment_image_src($photo, 'twofold-collection-style1');
													$photo_post = get_post($photo);
													$exif = thb_get_exif_data($full_url[0]);
													$image_width = (180 * $full_url[1]) / $full_url[2];
													$aspect_ratio = '';
													if ($true_aspect_ratio === 'on') {
														$aspect_ratio = $photo ? (($full_url[2] / $full_url[1]) * 100).'%' : '100%';
														$image_url = wp_get_attachment_image_src($photo, 'twofold-2');
													}
												?>
												<li>
													<?php if ($true_aspect_ratio === 'on') { ?>
													<figure class="album_list style1 thb-true-aspect-collection"<?php if ($true_aspect_ratio === 'on') { echo ' style="width:'.$image_width.'px; padding-bottom:'.$aspect_ratio.' !important"'; } ?>>
													<?php } else { ?>
													<figure class="album_list style1">
													<?php } ?>
														<?php do_action('thb_render_photo', 'off', false, $photo, $image_url, $full_url, $rand); ?>
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
												</li>
												<?php
												}
											}
										?>
									</ul>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php } ?>