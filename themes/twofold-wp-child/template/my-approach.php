<?php
/*
Template Name: my approach
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
            <?php if(get_post_meta(get_the_ID(), 'codes', true)) : ?>
              <h2><?php echo get_post_meta(get_the_ID(), 'codes', true);?></h2>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="columns large-6 small-12">
      <?php the_content(); ?>
    </div>

    <div class="columns small-12 large-6">
      <h2>FAQ</h2>
      <?php echo do_shortcode('[WPSM_AC id=450]')?>

      <h2>Enquiries</h2>
      <form action="" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">
        <?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
      </form>

      <p class="showonsuccess">Thank you for your enquiry</p>

    </div>
  </div>
</div>
<?php endwhile; else : ?>
  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
