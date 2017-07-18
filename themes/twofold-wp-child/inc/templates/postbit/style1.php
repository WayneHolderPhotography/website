<div class="large-4 small-6 columns item">
	<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style1'); ?> role="article">
		<?php if ( has_post_thumbnail() ) { ?>
		<figure class="post-gallery">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('twofold-blog-style1', array('itemprop'=>'image')); ?>
			</a>
      <div class="overlay">
        <div class="liner">
          <span class="title"><?php the_title(); ?></span>
          <span class="subtitle"><?php  echo get_post_meta($post->ID, 'sub_title_blog', true);?></span>
          <span class="date"><?php echo get_the_date('M Y');?></span>
        </div>
      </div>
		</figure>
		<?php } ?>
	</article>
</div>
