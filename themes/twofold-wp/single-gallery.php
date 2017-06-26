<?php get_header(); ?>
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
	<?php 
		$id = get_the_ID();
		$album_layout = get_post_meta($id, 'gallery_layout', true) ? get_post_meta($id, 'gallery_layout', true) : 'style1';
		get_template_part( 'inc/templates/galleries/'.$album_layout );
	?>
	<?php if ( comments_open() || get_comments_number() ) : ?>
		<!-- Start #comments -->
		<div class="row align-center">
			<div class="small-12 medium-10 large-8 columns">
				<div class="blog-post-container comments">
		<?php comments_template('', true); ?>
				</div>
			</div>
		</div>
		<!-- End #comments -->
	<?php endif; ?>
<?php } ?>
<?php endwhile; else : endif; ?>
<?php get_footer(); ?>