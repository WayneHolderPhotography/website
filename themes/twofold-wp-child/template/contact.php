<?php
/*
Template Name:contact us
*/
get_header(); ?>

<div class="page">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="column">
      <div class="bannerimage">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1241.279466888445!2d-0.015016708053968202!3d51.521307418618555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761d4e6870ce93%3A0xcc388d507665004d!2sEmpson+St%2C+London+E3+3LT!5e0!3m2!1sen!2suk!4v1492833073075"
          width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""
        >
        </iframe>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="large-6 small-12 columns">
      <h2><?php the_title(); ?></h2>
      <p><?php the_content(); ?></p>
    </div>
    <div class="large-6 small-12 columns">
      <h2>Enquiries</h2>
      <form action="" class="ajaxform" method="post" accept-charset="utf-8">
        <?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
      </form>
      <p class="showonsuccess">Thank you for your enquiry</p>
    </div>
  </div>
</div>
<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
</div>

 <?php get_footer(); ?>
