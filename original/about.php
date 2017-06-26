<?php get_header();?>
<?php /* Template name:about us */?>
<!---------start---------->
<div class="page">
<div class="bannerwrapper">
<?php $post = get_post(271); ?>
	<div class="row fw">
		<div class="col span_12 bannerimage">
			<?php echo get_the_post_thumbnail($post->ID, 'full');?>
			<div class="textoverlay">
				<div>
					<h1 class="title_ab"><?php echo $post->post_title; ?></h1>
					<h2 class="title_ab">“<?php echo get_post_meta($post->ID, 'codes', true);?>”</h2>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="page">
	<div class="contentwrapper">

		<div class="row">
			<div class="col span_4 homefull nam">
				<h3><?php echo get_post_meta($post->ID, 'name', true);?></h3>
				<a href="http://wayneholderphotography.co.uk/contact/" class="btn btn-primary bt_an_trans">Contact Me</a>
			</div>
			<div class="col span_4 homefull">
				<p><?php echo $post->post_content; ?></p>			</div>
			<div class="col span_4 homefull">
				<p><?php echo $post->post_excerpt; ?></p>
				
				</div>
		</div>
	</div>
</div>

<!-----------end------------->

<?php get_footer();?>
