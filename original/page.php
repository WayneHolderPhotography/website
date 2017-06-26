<?php get_header(); ?>
<?php if ( have_posts()) :  while (have_posts()) : the_post(); ?>
<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
<?php
	$id = get_the_ID();
	$page_date = get_post_meta($id, 'page_date', true) ? get_post_meta($id, 'page_date', true) : 'on';
	$page_title = get_post_meta($id, 'page_title', true) ? get_post_meta($id, 'page_title', true) : 'on';
?>
	<?php if (thb_is_woocommerce()){ ?>
	<div class="page-padding extra">
		<div class="row full-width-row with-padding">
			<div class="small-12 columns">
				<div class="post-content no-vc">
					<?php the_content();?>
				</div>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class="page-padding">
		<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail'); ?> role="article">
			<div class="row align-center">
				<div class="small-12 medium-10 large-8 columns">
					<div class="blog-post-container">
						<?php if ($page_date !== 'off') { ?>
						<aside class="post-meta">
							<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
						</aside>
						<?php } ?>
						<?php if ($page_title !== 'off') { ?>
						<header class="post-title entry-header">
							<?php the_title('<h3 class="entry-title" itemprop="name headline">', '</h3>'); ?>
						</header>
						<?php } ?>
						<div class="post-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
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
		</div>
	
	<?php } ?>
<?php } ?>
<?php endwhile; else : endif; ?>

<?php get_footer(); ?>