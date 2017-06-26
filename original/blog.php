<?php /* Template Name: blog */ ?>

<?php get_header(); ?>
<style>
	a.blogtile:nth-child(n+7) {
		display: none;   
	}
	#load-more-btn{
		margin-bottom:12px;
	}
</style>
<!------start------>
<div class="page">
	<div class="contentwrapper" id="blogwrap">
		<div id="newswrapper">
			<div class="row">
				<?php
					$arg = array('posts_per_page' => -1, 'offset' => 0, 'category' => 17);
					$posts = get_posts($arg);
					foreach($posts as $post):
				?>		 
					<a href="<?php echo the_permalink();?>" class="col span_4 blogtile">
						
						<div class="imgwrapper">
							<span class="overlay"></span>
							<?php echo get_the_post_thumbnail($post->ID,'full', array('class' => 'img-responsive'));?>
						</div>
						<span class="title"><?php echo $post->post_title; ?></span>
						<span class="subtitle"><?php  echo get_post_meta($post->ID, 'sub_title_blog', true);?></span>
						<span class="date"><?php echo get_the_date('M Y');?></span>

					</a>

					<?php endforeach ;?>
					</div>
						<div class="row">
							<div class="col span_12 tac">
								<a href="#" id="load-more-btn" class="btn btn-primary bt_an_trans">Load more</a>
							</div>
						</div>
						<div class="row"></div>
				
			</div>
		</div>

				

	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(document).on("click","#load-more-btn",function(e){
			jQuery("a.blogtile").show();
			jQuery(this).hide();
			return false;
		})
	})
</script>



<!------end------>


<?php get_footer(); ?>
