<?php

get_header();

if (have_posts()) :  while (have_posts()) : the_post(); ?>

<div class="page">

  <?php if (has_post_thumbnail() ) : ?>
  <div class="row">
    <div class="column">
      <div class="bannerimage">
        <?php
          if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'secondary-image')) :
            MultiPostThumbnails::the_post_thumbnail('post', 'secondary-image', NULL, 'post-secondary-image-thumbnail');
          endif;
        ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="row post">
    <div class="columns large-4 small-12">
      <h1><?php echo the_title();?></h1>
      &mdash;
      <span class="date">
        <?php the_time( get_option( 'date_format' ) ); ?>
      </span>
    </div>

    <div class="columns large-4 small-12">
      <article>
        <p><?php the_content(); ?></p>
      </article>
    </div>

    <div class="columns large-4 small-12 testimonial">
      <?php echo get_post_meta( get_the_ID(), 'codes', true ); ?>
    </div>
  </div>

  <div class="text-center images">
    <?php
      if( have_rows('images') ) :
        while ( have_rows('images') ) : the_row();
    ?>
      <img
        src="<?php echo get_sub_field('image')['url']; ?>"
        alt="<?php echo get_sub_field('image')['alt']; ?>"
      />
    <?php
        endwhile;
      endif;
    ?>
  </div>

  <?php if ( comments_open() || get_comments_number() ) : ?>
    <div class="row align-center">
      <div class="small-12 medium-10 large-8 columns">
        <div class="blog-post-container comments">
          <?php comments_template('', true); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php endwhile; else : endif; ?>

<?php get_footer();?>
