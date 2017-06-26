</div> <!-- End #wrapper -->

<!-- Start Footer -->
<footer id="footer" role="contentinfo">
	<div class="row">
		<div class="small-12 medium-6 columns left-side">
			<?php if ('menu' === ot_get_option('footer_left_content','menu')) { ?>
				<?php if (has_nav_menu('footer-menu')) { ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'footer-menu' ) ); ?>
				<?php } ?>
			<?php } else { ?>
				<?php echo wp_kses_post(ot_get_option('footer_left_text')); ?>
			<?php } ?>
		</div>
		<div class="small-12 medium-6 columns right-side">
			<?php do_action('thb_social_footer'); ?>
		</div>
	</div>

</footer>
<!-- End Footer -->

<?php 
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 wp_footer(); 
?>
</body>
</html>