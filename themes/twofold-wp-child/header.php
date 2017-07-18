<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_site_icon(); ?>
	<?php wp_head(); ?>
	<meta charset="utf-8">
</head>
<body>
  <?php if( !(is_home() || is_front_page()) ) : ?>
    <style> .pace { display: none!important; } </style>
  <?php endif; ?>
  <?php get_template_part( 'inc/templates/header/header-style1-'.ot_get_option('menu_position', 'thb-menu-left').'' ); ?>
  <?php get_template_part( 'inc/templates/navigation-menu' ); ?>
  <?php if (is_singular('post') || is_singular('album')) { do_action('thb_article_nav'); }?>
  <div>
