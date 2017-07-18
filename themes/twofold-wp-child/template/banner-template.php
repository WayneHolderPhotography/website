<?php
/*
Template Name: Banner Top Template
*/
get_header(); ?>

<div class="page">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


  <div class="row">
    <div class="column">
      <div class="bannerimage">
        <?php the_post_thumbnail('full'); ?>

        <div class="textoverlay">
          <div>
            <h1><?php the_title();?></h1>

            <?php if(get_field('subtitle')) : ?>
              <h2><?php the_field('subtitle');?></h2>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <?php if(get_field('additional_content')) : $class = ' large-6'; endif; ?>

    <div class="columns<?php echo $class; ?> small-12">
      <?php the_content();?>
    </div>

    <?php if(get_field('additional_content')) : ?>
      <div class="columns small-12 large-6">
        <?php the_field('additional_content');?>
      </div>
    <?php endif; ?>
  </div>
  <?php endwhile; else : ?>
  	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
