<?php get_header(); ?>
<div class="page">
	<div class="contentwrapper">
		<div id="newswrapper">
			<div class="row old_cal">
				<?php 
					$blog_style = ot_get_option('blog_style', 'style3');
					get_template_part( 'inc/templates/blog/blog-header');
					get_template_part( 'inc/templates/blog/'.$blog_style);
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
