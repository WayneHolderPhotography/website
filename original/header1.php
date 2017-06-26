<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_site_icon(); ?>
	<?php 
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head(); 
	?>
	
	
	<meta charset="utf-8">

<meta name="description" content="Kristian Leven is an experienced creative wedding photographer in London, providing quality and bespoke photography services throughout the UK."/>
<link rel="publisher" href="https://plus.google.com/+KristianlevenphotographyCoUk/about"/>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Open Graph
================================================== -->
<meta property="og:title" content="Wedding Photographer London | Kristian Leven Photography" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://kristianlevenphotography.co.uk/" />
<!-- CSS
================================================== -->
<link href="<?php echo bloginfo('template_url'); ?>/css/main.css" rel="stylesheet">
<link href="<?php echo bloginfo('template_url'); ?>/css/style1.css" rel="stylesheet">

</head>
<body>
	<div class="pace"></div>
	
	<?php get_template_part( 'inc/templates/header/header-style1-'.ot_get_option('menu_position', 'thb-menu-left').'' ); ?>
	<?php get_template_part( 'inc/templates/navigation-menu' ); ?>
	<?php if (is_singular('post') || is_singular('album')) { do_action('thb_article_nav'); }?>
	<div id="wrapper">

</head>