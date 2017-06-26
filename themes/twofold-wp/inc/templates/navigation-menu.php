<nav id="navigation-menu" data-menu-speed="<?php echo ot_get_option('menu_speed', '0.8'); ?>" data-behaviour="<?php echo ot_get_option('submenu_behaviour', 'thb-default'); ?>">
	<div class="<?php if (has_nav_menu('nav-menu')) { ?>custom_scroll<?php } ?>" id="menu-scroll">
		<?php if (has_nav_menu('nav-menu')) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'navigation-menu', 'walker' => new thb_mobileDropdown ) ); ?>
		<?php } else { ?>
			<ul class="navigation-menu">
				<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu', 'twofold' ); ?></a></li>
			</ul>
		<?php } ?>
	</div>
</nav>
<div class="menu_overlay"></div>