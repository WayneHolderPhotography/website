<?php
/*
Template Name: Home Template
*/
get_header();
?>
<div class="slider">
	<div class="page">
		<div class="home-page-section">
			<?php echo do_shortcode('[rev_slider alias="home slider1"]'); ?>
		</div>
	</div>
</div>
<div class="page">
	<div class="contentwrapper home-page-section">	
	    <div class="content-box" style="min-height: auto !important;" id="content-box-id">
            <div class="section-full-width section-light2" style="background-color: rgb(247, 247, 247); height:auto !important;" id="moreaboutus">
		        <div class="section-boxed" style="color:#777777; height:auto !important;">
			        <?php  $my_postid = 17;//This is page id or post id
					    $content_post = get_post($my_postid);
					    $title = $content_post->post_title;
					    $url = wp_get_attachment_url( get_post_thumbnail_id($my_postid) );
					    $content = $content_post->post_content;
					    $content = apply_filters('the_content', $content);
					    $content = str_replace(']]>', ']]>', $content);
                    ?>
			        <h2 class="section-title" style="color:#252525 !important; padding: 13px 0 !important; line-height: 30px !important;"><?php echo $title;?></h2>
			        <div class="home-photographer-content-section"><?php echo $content;?></div>
			    </div>
			</div>
		</div>
        <br>
        <br>
        <div class="home-testimonial">
            <?php echo do_shortcode('[print_best_testimonial_slider]'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
					   
