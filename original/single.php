<?php get_header(); ?>
<div class="page-padding">
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail'); ?> role="article">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery parallax">
		<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id, 'full'); ?>
		<div class="parallax_bg" 
					data-top-bottom="transform: translate3d(0px, 40%, 0px);"
					data-top="transform: translate3d(0px, 0%, 0px);"
					style="background-image: url(<?php echo esc_html($image_url[0]); ?>);"></div>
	</figure>
	<?php } ?>
	<div class="row align-center">
		<div class="small-12 medium-10 large-8 columns">
			<div class="blog-post-container">
				<aside class="post-meta">
					<?php the_category(', '); ?>
					<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
				</aside>
				<header class="post-title entry-header">
					<?php the_title('<h3 class="entry-title" itemprop="name headline">', '</h3>'); ?>
				</header>
				<div class="post-content">
					<?php do_action('thb_share'); ?>
					<?php the_content(); ?>
				</div>
				<?php 
					$posttags = get_the_tags();
				?>
				<?php if (!empty($posttags)) { ?>
				<footer class="article-tags entry-footer">
					<?php
					if ($posttags) {
						$return = '';
						foreach($posttags as $tag) {
							$return .= '<a href="'. get_tag_link($tag->term_id).'" title="'. get_tag_link($tag->name).'" class="tag-link">' . $tag->name . '</a> ';
						}
						echo substr($return, 0, -1);
					} ?>
				</footer>
				<?php } ?>
			</div>
		</div>
	</div>
</article>
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
<?php get_footer(); ?>