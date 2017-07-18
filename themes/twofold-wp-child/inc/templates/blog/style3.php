<?php $blog_pagination_style = is_home() ? ot_get_option('blog_pagination_style', 'style1') : 'style1'; ?>
<div class="row blogtile">
	<div class="<?php echo esc_attr('pagination-'.$blog_pagination_style); ?>" data-count="<?php echo esc_attr(get_option('posts_per_page')); ?>">
		<?php
        $args = array(
          'posts_per_page'=> -1,
          'offset'=> 0,
          'category_name'=>'main',
          'meta_key' => 'order_by',
          'orderby' => 'meta_value_num',
          'meta_type' => 'NUMERIC',
          'order' => 'DESC'
        );

        $posts = get_posts($args);
        foreach($posts as $post):
      ?>
			<?php get_template_part( 'inc/templates/postbit/style3'); ?>
		<?php endforeach; ?>
	</div>
</div>
<?php do_action('thb_pagination'); ?>
