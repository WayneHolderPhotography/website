<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if ( comments_open() || get_comments_number() ) : ?>
<!-- Start #comments -->
<section id="comments" class="cf comments-area">


	  <h4 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( '<span>One thought</span> on &ldquo;%s&rdquo;', 'comments title', 'twofold' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'<span>%1$s thought</span> on &ldquo;%2$s&rdquo;',
							'<span>%1$s thoughts</span> on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'twofold'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h4>

		<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments(
				array(
					'type'		  => 'comment',
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 88
				)
			); ?>
		</ol>
		<?php the_comments_pagination(); ?>
		<?php endif; // end have_comments() ?>
		
		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'twofold' ); ?></p>
		<?php endif; ?>

	<?php
		// Comment Form
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true" data-required="true"' : '' );
		
		$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
		
			'author' => '<div class="row"><div class="small-12 medium-6 columns"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name', 'twofold' ) . '" size="30"' . $aria_req . ' /></div>',
			
			'email'  => '<div class="small-12 medium-6 columns"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email', 'twofold' ) . '" size="30"' . $aria_req . ' /></div>',
			
			'url'    => '<div class="small-12 columns"><input name="url" size="30" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" type="text" placeholder="' . esc_html__( 'Website', 'twofold' ) . '"/></div></div>' ) ),
			
			'comment_field' => '<div class="row"><div class="small-12 columns"><textarea name="comment" id="comment"' . $aria_req . ' placeholder="' . esc_html__( 'Your Comment', 'twofold' ) . '" rows="10" cols="58"></textarea></div></div>',
			
			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'twofold' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'twofold' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			
			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'twofold' ) . '</p>',
			'comment_notes_after' => '',
			'id_form' => 'form-comment',
			'id_submit' => 'submit',
			'class_submit' => 'btn',
			'title_reply' => esc_html__( 'Leave a Reply', 'twofold' ),
			'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'twofold' ),
			'cancel_reply_link' => esc_html__( 'Cancel reply', 'twofold' ),
			'label_submit' => esc_html__( 'Submit Comment', 'twofold' ),
		); 
		comment_form($defaults); 
	?>
</section>
<!-- End #comments -->
<?php endif; ?>