<?php get_header(); ?>
<?php 
	if ($image = ot_get_option('404-image')) { $image = ot_get_option('404-image'); } else { 
		if (ot_get_option('color_theme') == 'dark-theme') {
			$image = THB_THEME_ROOT. '/assets/img/404_dark.png'; 
		} else {
			$image = THB_THEME_ROOT. '/assets/img/404.png'; 
		}
	} 
?>

<section class="content404">
	<div class="page-padding">
		<div class="row align-center">
			<div class="small-12 medium-10 large-6 columns text-center">
				<img src="<?php echo esc_url($image); ?>" alt="<?php _e( "Error 404", 'twofold' ); ?>" class="animation fade-in"/>
				<p><?php _e( "We are sorry, but the page you are looking for cannot be found. <br>You might try searching our site.", 'twofold' ); ?></p>
				
				<a href="<?php echo esc_url(home_url()); ?>" class="btn"><?php esc_html_e('BACK TO HOME', 'twofold'); ?></a>
			</div>
	  </div>
	 </div>
</section>
<?php get_footer(); ?>