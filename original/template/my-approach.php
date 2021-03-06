<?php
/*
Template Name: my approach
*/
get_header(); ?>

<!--custome-->
<div class="page">
	<div class="bannerwrapper" id="my-app-banner">
		<div class="row fw">
			<?php
				$args = array('posts_per_page' => 1, 'offset' => 0, 'category' => 20);
				$posts = get_posts($args);
				foreach($posts as $post):
			?>
			<div class="col span_12 bannerimage">
				<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
				<div class="textoverlay">
					<div>
						<h1><?php echo $post->post_title;?></h1>
						<h2><?php echo get_post_meta($post->ID, 'codes',true);?></h2>
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</div>
<div class="page">
	<div class="contentwrapper" id="my-app-con">
	<div class="row">
			<div class="col span_5">
				<h1><?php echo get_post_meta($post->ID,'heading1',true);?></h1>
					<h3><?php echo get_post_meta($post->ID,'heading2',true);?></h3>
						<p><?php echo $post->post_content;?></p>
					<h3><?php echo get_post_meta($post->ID,'heading3',true);?></h3>
						<p><?php echo $post->post_excerpt;?></p>
					<h3><?php echo get_post_meta($post->ID,'heading4',true);?></h3>
						<p><?php echo get_post_meta($post->ID,'area',true);?></p>			
			</div>
			<div class="col span_1">&nbsp;</div>
			<div class="col span_6">
				
				<h1>FAQ</h1>

				<div class="faqs">
					<?php echo do_shortcode('[WPSM_AC id=450]')?>
				</div>

				<h1>Enquiries</h1>
				<form action="" class="validate" method="post" accept-charset="utf-8" novalidate="novalidate">	
					<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
				</form>
				<p class="showonsuccess">Thank you for your enquiry</p>
			</div>
		</div>
	</div>
</div>
<!-- customend-->

<!--
 	<div class="album-title-portfolio">
		<div class="page">
			<div class="contentwrapper">
				<h2 class="entry-title">SERVICES</h2>
			</div>
		</div>
	</div>


<div class="page">
	<div class="contentwrapper my-services-sections" id="servicewrap">
<div class="content-box row srv">
		<?php
			/*
			$args = array( 'post_type' => 'services_type', 'posts_per_page' => -1);
			$news = new WP_Query( $args );
			while ( $news->have_posts() ) : $news->the_post(); 
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			*/
		?>
		<div class="small-12 large-4 columns services-section-dv">
		<div class="services-detail">
			<a href="#">
			<div class="service-img"><img src="<?php //echo $url;?>"></div>
			<div class="large-12">
			<h1><?php //the_title(); ?></h1>
			<?php //the_content(); ?>
			</div>
			</a>
		</div>
		</div>
		<?php 
//endwhile;
		//wp_reset_query();
		?>
				
				
</div>
		-->
		<!--
		<div class="row">
		              <?php /* $my_postid = 923;//This is page id or post id
					  $content_post = get_post($my_postid);
					  $title = $content_post->post_title;
					  $url = wp_get_attachment_url( get_post_thumbnail_id($my_postid) );
					  $content = $content_post->post_content;
					  $content = apply_filters('the_content', $content);
					  $content = str_replace(']]>', ']]>', $content); */
                       ?>
			<div class="col span_4 homefull">
				<h3><?php //echo $title;?></h3>			</div>
			<div class="col span_4 homefull">
				<p><?php //echo $content;?></p>			</div>

			<div class="col span_4 homefull">
				<p><img src="<?php //echo get_option('mytheme_images1'); ?>" alt="About"></p>			
			</div>
			<div class="col span_4 homefull">
				<p><img src="<?php //echo get_option('mytheme_images2'); ?>" alt="About"></p>				
			</div>
			<div class="col span_4 homefull">
				<p><img src="<?php //echo get_option('mytheme_images3'); ?>" alt="About"></p>				
			</div>
		</div>
		-->
		
	<!--</div>
</div>
-->

<?php get_footer(); ?>
