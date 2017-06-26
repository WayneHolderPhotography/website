</div> <!-- End #wrapper -->

<!-- Start Footer -->
<footer id="footer" role="contentinfo">
	<div class="row">
		<div class="small-12 medium-6 columns left-side">
			<?php if (has_nav_menu('footer-menu')) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'footer-menu' ) ); ?>
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