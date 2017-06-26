<?php
/*
Template Name:client area
*/
?>
<?php get_header(); ?>
<div class="page">
<div class="contentwrapper">
			<div class="album-title">
			<h2 class="entry-title">CLIENT AREA</h2>
			</div>
            <div class="row smallgrid">
			<?php  
			$args = array( 'post_type' => 'album', 'order' => 'ASC', 'posts_per_page' => -1);
			$news = new WP_Query( $args );
			while ( $news->have_posts() ) : $news->the_post();  ?>
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>

 				
			<div class="col span_4 portfoliotile">
						
				<a href="<?php the_permalink(); ?>" class="imgwrapper">
					<img src="<?php echo $url;?>" alt="Best of&#8230;2016">
					<span class="overlay">
						<span class="liner">
							<span class="title">Best of&#8230;2016</span>
							<span class="subtitle ellip">Top 100 moments of the year!</span>
						</span>
					</span>
					<span class="sectiontype">Blog</span>
				</a>
				
			</div>

				<?php  endwhile; ?>
                <?PHP wp_reset_query(); ?>					
		<!----	<div class="col span_4 portfoliotile">
						
				<a href="http://kristianlevenphotography.co.uk/london-rooftop-wedding-photography" class="imgwrapper">
					<img src="http://kristianlevenphotography.co.uk/uploads/slir/w675xh675-q85-c675x675/Kristian_Leven_TWIA_16-0012.jpg" alt="London">
					<span class="overlay">
						<span class="liner">
							<span class="title">London</span>
							<span class="subtitle ellip">Kia + Dan&#8217;s DIY East London Wedding</span>
						</span>
					</span>
					<span class="sectiontype">Portfolio</span>
				</a>
				
			</div>

								
			<div class="col span_4 portfoliotile">
						
				<a href="http://kristianlevenphotography.co.uk/mendoza-wedding-photographer " class="imgwrapper">
					<img src="http://kristianlevenphotography.co.uk/uploads/slir/w675xh675-q85-c675x675/mendoza-wedding-photography-0591.jpg" alt="Argentina">
					<span class="overlay">
						<span class="liner">
							<span class="title">Argentina</span>
							<span class="subtitle ellip">Ashleigh + Tom&#8217;s wedding in the vineyards of Mendoza</span>
						</span>
					</span>
					<span class="sectiontype">Blog</span>
				</a>
				
			</div>

								
			<div class="col span_4 portfoliotile">
						
				<a href="http://kristianlevenphotography.co.uk/chateau-rigaud-wedding-photographer" class="imgwrapper">
					<img src="http://kristianlevenphotography.co.uk/uploads/slir/w675xh675-q85-c675x675/chateau-rigaud-wedding-photography-068.jpg" alt="France">
					<span class="overlay">
						<span class="liner">
							<span class="title">France</span>
							<span class="subtitle ellip">Nina + Ben&#8217;s wedding at the Chateau Rigaud, Bordeaux</span>
						</span>
					</span>
					<span class="sectiontype">Portfolio &amp; Blog</span>
				</a>
				
			</div>

								
			<div class="col span_4 portfoliotile">
						
				<a href="http://kristianlevenphotography.co.uk/amalfi-coast-wedding-photography" class="imgwrapper">
					<img src="http://kristianlevenphotography.co.uk/uploads/slir/w675xh675-q85-c675x675/amalfi-coast-wedding-photography-026.jpg" alt="Amalfi Coast Wedding">
					<span class="overlay">
						<span class="liner">
							<span class="title">Amalfi Coast Wedding</span>
							<span class="subtitle ellip">Abigail + Deividas&#8217; wedding along the Amalfi Coast, Italy</span>
						</span>
					</span>
					<span class="sectiontype">Blog</span>
				</a>
				
			</div>

								
			<div class="col span_4 portfoliotile">
						
				<a href="http://kristianlevenphotography.co.uk/humanist-wedding-photography-childerley-hall" class="imgwrapper">
					<img src="http://kristianlevenphotography.co.uk/uploads/slir/w675xh675-q85-c675x675/childerley-hall-wedding-photography-035.jpg" alt="Humanist Wedding">
					<span class="overlay">
						<span class="liner">
							<span class="title">Humanist Wedding</span>
							<span class="subtitle ellip">Charlotte + Alex&#8217;s Humanist Wedding at Childerley Hall</span>
						</span>
					</span>
					<span class="sectiontype">Blog</span>
				</a>
				
			</div>------->

		</div>
		</div>
		</div>
<?php get_footer(); ?>