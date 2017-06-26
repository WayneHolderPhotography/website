<?php

/*

Template Name: New Client Area

*/

?>

<?php get_header(); 
 
?>
<?php 
    if(isset($_POST['submit']))
	{
		
		$get_pass = $_POST['post_password'];
		$args = array( 'post_type' => 'album', 'posts_per_page' => -1);
		$news = new WP_Query( $args );
		while ( $news->have_posts() ) : $news->the_post(); 
		$passwrd_pro = get_field('password_protected');
		$pink = get_permalink();
		if($get_pass==$passwrd_pro)
		{ 	
			session_start();
			$_SESSION['parmalink'] = $pink;
			$_SESSION['password'] = $get_pass;
		?>
		<script language="javascript" type="text/javascript">
			document.location = "<?php echo $pink; ?>";
		</script>
			
		<?php } else{?>
		<script language="javascript" type="text/javascript">
			document.location = "<?php echo site_url('client-area/?notifi'); ?>";
		</script>
		<?php }
		endwhile;
		wp_reset_query(); 
	}
	else
	{
?>
<div id="page">
	<div class="password-protected">
		<div class="password-form">
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="79.5" height="109.8" viewBox="0 0 79.5 109.8" enable-background="new 0 0 79.5 109.75" xml:space="preserve"><path d="M78.6 51.7c-0.6-1.8-1.2-3-2.2-3.9 -0.5-0.4-1-0.8-1.6-1 -0.3-0.1-0.6-0.2-0.9-0.3 0 0 0 0-0.1 0 -0.4-0.1-0.8-0.2-1.2-0.2 0 0-0.1 0-0.1 0 -0.3 0-0.6 0-0.8 0h-2.5v-4.6h-0.1c0-4.7 0.3-9.4-0.1-14C68.1 15.3 58.6 4.5 46.6 1.8c-1.6-0.4-3.3-0.6-4.9-0.9 -1.3 0-2.5 0-3.8 0 -0.9 0.1-1.7 0.3-2.6 0.4C21.1 3.4 10.3 15.9 10.3 30.3c0 3.2 0 6.3 0 9.5h0v6.4h-2.5C7.5 46.2 7.2 46.2 6.9 46.2c0 0-0.1 0-0.1 0 -0.4 0-0.9 0.1-1.2 0.2 0 0 0 0 0 0 -0.3 0.1-0.6 0.2-0.9 0.3 -0.6 0.3-1.1 0.6-1.6 1 -0.9 0.9-1.6 2.1-2.2 3.9 0 0 0 0 0 0 -0.1 0.4-0.1 0.7-0.1 1.1v49.4c0 0.4 0 0.9 0.1 1.3 0.1 0.3 0.2 0.7 0.3 1 0.8 2.1 2.3 3.4 4.5 4.1 0.1 0 0.3 0.1 0.4 0.1 0.4 0.1 0.8 0.1 1.3 0.1h64.8c0.4 0 0.9 0 1.3-0.1 0.4-0.1 0.8-0.3 1.2-0.4 2-0.8 3.3-2.3 3.9-4.4 0-0.1 0.1-0.3 0.2-0.4 0.1-0.4 0.1-0.8 0.1-1.2C78.7 85.4 78.6 68.5 78.6 51.7zM44.1 80c-0.6 0.4-0.8 0.9-0.8 1.6 0 3.2 0 6.3 0 9.5 0 0 0 0 0 0 0 2-1.6 3.6-3.6 3.6s-3.6-1.6-3.6-3.6c0 0 0 0 0 0 0-3.2 0-6.3 0-9.5 0-0.6-0.1-1.1-0.7-1.5 -2.8-2.1-3.8-5.7-2.4-8.9 1.4-3.1 4.8-4.9 7.9-4.2 3.5 0.7 6 3.6 6 7.2C47.1 76.5 46.1 78.6 44.1 80zM56.7 41.6L56.7 41.6v0.1c0 0 0 0 0 0.1 0 0.4 0 0.8 0 1.2v3.1H22.8v-3.4c0.1-0.1 0.1-0.3 0.1-0.6 0-2.6 0-5.2 0-7.7 0-2.2-0.1-4.5 0.3-6.7 1.3-8.7 9.1-14.8 18-14.2 8.5 0.6 15.4 7.9 15.6 16.5C56.7 33.9 56.7 37.7 56.7 41.6z"></path></svg>
			<h3>PROTECTED AREA</h3>
				<form action="" method="post" enctype="multipart/form-data">
				<p class="password-text">This is a protected area. Please enter your password:</p>
				<?php if(isset($_GET['notifi'])){ ?>
				<p style="color:#ff0000;">Invalid Password.</p>
				<?php } ?>
				<p>    <input name="post_password" type="password" required placeholder="Password"><br>
				<input type="submit" name="submit" class="btn" value="Submit"></p></form>
		</div>
	</div>
</div>
	<?php } ?>
<?php get_footer(); ?>