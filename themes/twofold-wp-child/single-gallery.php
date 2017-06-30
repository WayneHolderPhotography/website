<?php get_header(); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="page">
	<div class="contentwrapper" id="nav_galley">
		<div id="newswrapper" class="nav_galley">
			<div class="row">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<?php if (post_password_required()) {
				  get_template_part( 'inc/templates/password-protected' );
				} else {
						$id = get_the_ID();
						$album_layout = get_post_meta($id, 'gallery_layout', true) ? get_post_meta($id, 'gallery_layout', true) : 'style1';
						get_template_part( 'inc/templates/galleries/'.$album_layout );
          ?>
					
					<div class="row">
            <div class="col span_12 tac">
              <a href="#" id="load-more-btn" class="btn btn-primary bt_an_trans sumbit-bu" data-toggle="modal"  data-target="#myModal">Submit</a>
                <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
								<?php
                  if(isset($_REQUEST['email'])) {
                    $to = "admin@wayneholderphotography.co.uk";
                    $subject = "Party Images";
                    $name = $_REQUEST['name'];
                    $email = $_REQUEST['email'];
                    $message = $_REQUEST['msg'];
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: '.$email."\r\n".
                        'Reply-To: '.$email."\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    $mail = mail($to, $subject, $message, $headers);
                    if ($mail) {
                      echo"Thank You";
                    } else {
                      echo "Sorry";
                    }
                  }
                ?>

                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Images</h4>
                  </div>
                  <div class="modal-body">
                    <form class="bor_dtre">
                      <div class="form-group">
                        <label for="pwd">Name:</label>
                        <input type="text" name="name" class="form-control" id="pwd" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                      </div>
                        <textarea id="text-area-img" class="form-control" name="msg" placeholder="Message" style="min-width: 100%"></textarea>
                        <input type="submit" class="btn btn-default sew_nd" name="submit"></input>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
							  </div>
							</div>
            </div>
          </div>
        </div>
        <div class="row"></div>
        <div class="row align-center">
          <div class="small-12 medium-10 large-8 columns">
            <div class="blog-post-container comments"></div>
          </div>
        </div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
