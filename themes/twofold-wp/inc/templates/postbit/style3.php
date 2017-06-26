<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style3'); ?> role="article">
	<div class="row">
		<div class="small-12 large-5 columns">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php the_post_thumbnail('twofold-blog-style3', array('itemprop'=>'image')); ?>
				</a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 large-7 columns">
			<aside class="post-meta">
				<?php the_category(', '); ?>
				<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></time>
			</aside>
			<header class="post-title entry-header">
				<?php the_title('<h3 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h3>'); ?>
			</header>
			<div class="post-content">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article>