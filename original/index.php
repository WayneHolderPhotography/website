<?php get_header(); ?>
<div class="page-padding">
	<div class="side_padding">
	<?php 
		$blog_style = ot_get_option('blog_style', 'style3');
		get_template_part( 'inc/templates/blog/blog-header');
		get_template_part( 'inc/templates/blog/'.$blog_style);
	?>
	</div>
</div>
<?php get_footer(); ?>