<?php
/*
Template Name:portfolio
*/
get_header(); ?>

<div class="page">
  <div class="row portfolio">
    <?php
      $args = array(
        'posts_per_page'=> -1,
        'offset'=> 0,
        'category_name'=>'Portfolio',
        'meta_key' => 'order_by',
        'orderby' => 'meta_value_num',
        'meta_type' => 'NUMERIC',
        'order' => 'DESC'
      );

      $posts = get_posts($args);
      foreach($posts as $post):
    ?>
    <div class="columns small-12 medium-6 portfoliotile">
      <a href="<?php echo the_permalink();?>">
        <div class="imgwrapper">
          <?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
        </div>
        <div class="overlay">
          <div class="liner">
            <span class="title"><?php the_title();?></span>
            <span class="subtitle ellip"><?php echo wp_trim_words( $post->post_content, 8, '...' );?></span>
          </div>
        </div>
      </a>
    </div>
    <?php endforeach ;?>
  </div>
</div>
<?php get_footer(); ?>
