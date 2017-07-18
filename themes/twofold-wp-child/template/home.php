<?php
/*
Template Name: Home Template
*/
get_header();
?>
<div class="page">
  <div class="row">
    <div class="column">
      <div class="slider">
        <?php echo do_shortcode('[rev_slider alias="home slider"]'); ?>
      </div>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="home-content-box">
            <?php the_content(); ?>
        </div>
      <?php endwhile; else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>

      <?php echo do_shortcode('[print_best_testimonial_slider]'); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
					   
