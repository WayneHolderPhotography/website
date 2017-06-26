<?php
/*
Template Name:testimonial
*/
get_header();
?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.0.min.js"></script>
 	 <div class="album-title-portfolio">
		<div class="page large-12 contentwrapper">
		<h2 class="entry-title">TESTIMONIAL</h2>
		</div>
	</div>

<!--
<div class="bannerwrapper">



	<div class="row fw">
		<div class="col span_12 bannerimage1">
			<img src="<?php echo get_option('mytheme_aboutimage'); ?>" alt="About">
		</div>
	</div>
</div>
-->
<div class="page ">
	<div class="contentwrapper testimonial-page" id="testimowrap">

		<div class="row content-box tst">
		     <?php echo do_shortcode('[print_best_testimonial_slider]'); ?>
		</div>
	</div>
</div>

                         
                        
<?php get_footer(); ?>
