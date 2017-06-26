<div class="small-12 medium-10 large-9 columns">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail style2'); ?> role="article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('twofold-blog-style2', array('itemprop'=>'image')); ?>
			</a>
		</figure>
		<?php } ?>
		<div class="blog-post-container">
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
		
	</article>
</div>