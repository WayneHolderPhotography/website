<?php
/*
Template Name:portfolio
*/
 get_header(); ?>


<div class="page">
	<div class="contentwrapper port">
		<div id="newswrapper" class="port_folio">
			<div class="row rel">
						<?php
						$args = array('posts_per_page'=> -1, 'offset'=> 0, 'category'=>19,
						 'meta_key' => 'order_by',
						  'orderby' => 'meta_value_num',
						  'meta_type' => 'NUMERIC',
						  'order' => 'DESC'
						   );
								
						$posts = get_posts($args);
						foreach($posts as $post):
						?>			
					<div class="col span_6 portfoliotile">
						
						<a href="<?php echo get_post_meta($post->ID, 'single_post',true);?>" class="imgwrapper">
							<?php echo get_the_post_thumbnail($post->ID, 'full');?>
							<span class="overlay">
								<span class="liner">
									<span class="title"><?php echo $post-> post_title;?></span>
									<span class="subtitle ellip"><?php echo wp_trim_words( $post->post_content, 8, '...' );?></span>
								</span>
							</span>
						</a>
						
					</div>
<?php endforeach ;?>
									
					

				
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
