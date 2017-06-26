<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<meta name="description" content="Wayneholder is an experienced creative wedding photographer in London, providing quality and bespoke photography services throughout the UK."/>
<link rel="publisher" href="https://plus.google.com/+WayneholderphotographyCoUk/about"/>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Open Graph
================================================== -->
<meta property="og:title" content="Wedding Photographer London | Wayne Holder Photography" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://wayneholderphotography.co.uk/" />
<!-- CSS
================================================== -->
<link href="<?php echo bloginfo('template_url'); ?>/css/main.css" rel="stylesheet">
<link href="<?php echo bloginfo('template_url'); ?>/css/style.css" rel="stylesheet">
<script>
jQuery(window).scroll(function(){ 

  if (jQuery(window).scrollTop() >= 5) {
    jQuery('header').addClass('smaller');
   }
   else {
   jQuery('header').removeClass('smaller');
   }
});
jQuery( document ).ready(function() {
//jQuery('.wonderplugin-gridgallery-item-container a' ).appendTo('.wonderplugin-gridgallery-item-text');
});
</script>
<script>
		jQuery(window).load(function() {
		  // When the page has loaded
		  jQuery(".pace").fadeOut(1000);
		});
		
</script>



<script>
	jQuery(document).ready(function(){
		jQuery("#header").attr("style","width:100%");
		});
</script>



<style>
.fixed {position: fixed;top:0; left:0;width: 100%; z-index: 99}
</style>
</head>
<body>

<?php 
session_start();
$parma = $_SESSION['parmalink'];
$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
if($parma==$current_url){
?>
<style>	
.page-padding{
display:block;	
}
</style>	
<?php } ?>
	<div class="pace"></div>
	<?php get_template_part( 'inc/templates/header/header-style1-'.ot_get_option('menu_position', 'thb-menu-left').'' ); ?>
	<?php get_template_part( 'inc/templates/navigation-menu' ); ?>
	<?php if (is_singular('post') || is_singular('album')) { do_action('thb_article_nav'); }?>
	<div id="">
	<?php if(is_front_page() or is_home()) { ?>
	<style>
	.contentwrapper {
	  margin: 0 auto!important;
	  float: none;
	  width: 1200px;
	}
	.pace {
    display: block;
    -webkit-pointer-events: none;
    pointer-events: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    background: #000;
    position: fixed;
    z-index: 1998;
    top: 0;
    width: 100%;
    height:100%;
    justify-content: center;
    align-items: center
}
</style>
	<?php } else{?>
	<style>
		.pace {
    display: none;
    -webkit-pointer-events: none;
    pointer-events: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    background: #000;
    position: fixed;
    z-index: 1998;
    top: 0;
    width: 100%;
    height:100%;
    justify-content: center;
    align-items: center;
}
	</style>
	<?php } ?>
