<?php
/*
Template Name:contact us
*/
get_header(); ?>

<div class="page">
	 <div class="bannerwrapper">
		<div class="row fw co">
			<div class="col span_12 bannerimage">
				<?php dynamic_sidebar( 'footer-map-section' ); ?>
			</div>
		</div>
	</div>
</div>
<div class="page">
	<div class="contentwrapper">

		<div class="row">
			<div class="col span_6 add">
				<?php
					$post = get_post(282);
				?>
			    <h1><?php echo $post->post_title; ?></h1>
				<p><?php echo $post->post_content; ?></p>
			</div>
			<div class="col span_6">
				<h2>Contact</h2>
				<form action="" class="ajaxform" method="post" accept-charset="utf-8">		
					<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
				</form>
				<p class="showonsuccess">Thank you for your enquiry</p>
			</div>
		</div>
	</div>
</div>
 
 <?php get_footer(); ?>
