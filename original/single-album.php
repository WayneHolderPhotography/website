<?php get_header(); ?>
<?php if($_SESSION['parmalink']!=""){?>
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
	<?php 
		$id = get_the_ID();
		$album_layout = get_post_meta($id, 'album_layout', true) ? get_post_meta($id, 'album_layout', true) : 'style1';
		get_template_part( 'inc/templates/albums/'.$album_layout );
	?>
	<?php if ( comments_open() || get_comments_number() ) : ?>
		<!-- Start #comments -->
		<div class="row align-center">
			<div class="page">
				<div style="margin: 0 auto !important; float: none !important;  width: auto;">
					<div class="small-12 medium-10 large-12 columns">
						<div class="blog-post-container comments">
							<?php comments_template('', true); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End #comments -->
	<?php endif; ?>

<?php } ?>
<?php endwhile; else : endif;
}else{ ?>
<script language="javascript" type="text/javascript">
			document.location = "<?php echo site_url('client-area/'); ?>";
</script>
<?php } ?>
<?php get_footer(); ?>