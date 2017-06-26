<?php get_header(); ?>

<!-- custome-->
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

<div class="page">
<div class="bannerwrapper">
	<div class="row fw blog">
		<?php if ( has_post_thumbnail() ) { ?>
				<div class="col span_12 bannerholder ml0 sm-top">
			<?php if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'secondary-image')) :
				MultiPostThumbnails::the_post_thumbnail('post', 'secondary-image', NULL, 'post-secondary-image-thumbnail');
			endif; ?>
		</div>
		<div class="clear"></div>
		<?php } ?>
			</div>
</div>
</div>
<div class="page">
	<div class="contentwrapper pt0">

		<div class="row fw">

			<div class="blogcontainer">
			
				<div class="col span_3 articleleft">
					<h1><?php echo the_title();?></h1>
					&mdash;
					<span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
				</div>
					
				<div class="sliderwrapper">
					<div class="col span_5 blogright">
						<article>
							<p><?php the_content(); ?></p>						
						</article>
						
					</div>

					<div class="col span_1 hideonmobile">&nbsp;</div>

					<div class="col span_3 testimonial">
						<?php echo get_post_meta( get_the_ID(), 'codes', true ); ?>
						<div class="author"></div>
											</div>
				</div>

				<div class="readmore">Read Story</div>

				<div class="col span_9 blogimages">
						<div class="imgholder">
							<?php do_shortcode('[multiple_images]'); ?>
						</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
			<!-- Start #comments -->
			<div class="row align-center">
				<div class="small-12 medium-10 large-8 columns">
					<div class="blog-post-container comments">
			<?php comments_template('', true); ?>
					</div>
				</div>
			</div>
			<!-- End #comments -->
			<?php endif; ?>
			<?php endwhile; else : endif; ?>					
				</div>

			<div class="clear"></div>
			</div>

		</div>	

		
</div>


<!-- custom end-->
<?php get_footer();?>
