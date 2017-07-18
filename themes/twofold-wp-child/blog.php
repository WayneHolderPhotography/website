<?php
/* Template Name: blog */
get_header(); ?>

<div class="page">
  <div class="row blogs">
    <?php
      $arg = array('posts_per_page' => -1, 'offset' => 0, 'category' => 17);
      $posts = get_posts($arg);
      foreach($posts as $post):
    ?>
    <div class="columns small-12 medium-6 large-4 blogtile">
      <a href="<?php echo the_permalink();?>">
        <div class="imgwrapper">
            <span class="overlay"></span>
            <?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
        </div>
        <div class="overlay">
          <div class="liner">
            <span class="title"><?php the_title(); ?></span>
            <span class="subtitle"><?php  echo get_post_meta($post->ID, 'sub_title_blog', true);?></span>
            <span class="date"><?php echo get_the_date('M Y');?></span>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach ;?>
  </div>
  <div class="tac">
    <a href="#" id="load-more-btn" class="btn btn-primary bt_an_trans">Load more</a>
  </div>
</div>

<?php get_footer(); ?>
