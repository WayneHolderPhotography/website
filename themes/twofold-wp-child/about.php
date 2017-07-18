<?php
/* Template name: about us */
get_header();
?>
<div class="page">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="column">
      <div class="bannerimage">
        <?php the_post_thumbnail( 'full' );  ?>
        <div class="textoverlay">
          <div>
            <h1><?php the_title(); ?></h1>
            <h2>“<?php echo get_post_meta(get_the_ID(), 'codes', true);?>”</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="columns small-12 large-4">
      <h2>HI, I'M WAYNE</h2>
      <a href="http://wayneholderphotography.co.uk/contact/" class="btn btn-primary bt_an_trans">Contact Me</a>
    </div>
    <div class="columns small-12 large-8">
      <?php the_content(); ?>
    </div>
  </div>
  <?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
</div>

<?php get_footer();?>
