<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<?php 
	$id = get_the_ID();
	$home_layout = get_post_meta($id, 'home_layout', true) ? get_post_meta($id, 'home_layout', true) : 'style1';
	get_template_part( 'inc/templates/homepage/'.$home_layout );
?>
<?php endwhile; else : endif; ?>
<?php get_footer(); ?>
