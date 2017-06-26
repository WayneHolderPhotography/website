<?php 
	$logo_light = ot_get_option('logo_light') ? ot_get_option('logo_light') : THB_THEME_ROOT. '/assets/img/logo_light.png';
	$logo_dark = ot_get_option('logo_dark') ? ot_get_option('logo_dark') : THB_THEME_ROOT. '/assets/img/logo_dark.png';
	$logo_position = ot_get_option('logo_position', 'thb-logo-left');
	$menu_type = ot_get_option('menu_type', 'thb-mobile-icon');
?>
<header id="header">
	<div class="logo-holder">
		<div class="mobile-toggle">
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="menu-icon" x="0" y="0" width="19.2" height="12" viewBox="0 0 19.2 12" enable-background="new 0 0 19.188 12.031" xml:space="preserve"><path class="thb-top-line" fill="none" stroke="#161616" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M1.1 1h12c2.8 0 5.1 2.2 5.1 5 0 2.8-2.3 5-5.1 5l-12-10"/><path class="thb-mid-line" fill="none" stroke="#161616" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M1.1 6h12"/><path class="thb-bottom-line" fill="none" stroke="#161616" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M1.1 11h12c2.8 0 5.1-2.2 5.1-5 0-2.8-2.3-5-5.1-5l-12 10"/></svg>
		</div>
		<a href="<?php echo esc_url(home_url()); ?>" class="logo">
			<img src="<?php echo esc_attr($logo_light); ?>" class="logoimg logo_light" alt="<?php esc_attr(bloginfo('name')); ?>"/>
			<img src="<?php echo esc_attr($logo_dark); ?>" class="logoimg logo_dark" alt="<?php esc_attr(bloginfo('name')); ?>"/>
		</a>
	</div>
	<div class="right-holder">
		<?php if ($menu_type !== 'thb-mobile-icon' && $logo_position !== 'thb-logo-center') { ?>
			<?php if (has_nav_menu('nav-menu')) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'thb-full-menu', 'walker' => new thb_mobileDropdown ) ); ?>
			<?php } else { ?>
				<ul class="full-menu">
					<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu', 'twofold' ); ?></a></li>
				</ul>
			<?php } ?>
		<?php } ?>
		<?php if (is_singular('collection')) { do_action('thb_collection_nav'); }?>
	</div>
</header>