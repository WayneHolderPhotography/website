<?php
add_action( 'wp_ajax_thb_proof', 'thb_proof' );
add_action( 'wp_ajax_nopriv_thb_proof', 'thb_proof' );
function thb_proof() {
	ob_start();

	if ( ! isset( $_POST[ 'id' ] ) || ! isset( $_POST[ 'checked' ] ) ) {
		return false;
	}
	$id = $_POST[ 'id' ];
	$checked = $_POST[ 'checked' ];

	$data               = wp_get_attachment_metadata( $id );
	$data[ 'checked' ]  = $checked;

	wp_update_attachment_metadata( $id, $data );

	echo json_encode( ob_get_clean() );
	wp_die();
}

function thb_more_posts() {
	$page = $_POST['page']; 
	$ppp = get_option('posts_per_page');
	$blog_style = ot_get_option('blog_style', 'style3');
	
	$args = array(
		'posts_per_page'	 => $ppp,
		'paged' => $page
	);

	$more_query = new WP_Query( $args );
		
	if ($more_query->have_posts()) :  while ($more_query->have_posts()) : $more_query->the_post(); 
		get_template_part( 'inc/templates/postbit/'.$blog_style); 
	endwhile; else : endif;
	wp_die();
}
add_action("wp_ajax_nopriv_thb_ajax", "thb_more_posts");
add_action("wp_ajax_thb_ajax", "thb_more_posts");