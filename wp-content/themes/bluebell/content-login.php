	<?php //do_action( 'wordpress_social_login' ); ?>
	<?php the_content(); ?>
	<div class="line"></div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="bb-login-form">
				<div class="bb-login-form-header">
					<h3 class="form-header">Log in</h3>
				</div>
				<div class="bb-login-form-inner">
					<?php 
	                    wp_login_form(array(
	                        'redirect'       => site_url( '/'),
	                    )); 
	                ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
		</div>
	</div>
	<!--<div class="line"></div>
	<div class="row">
		<div class="col-md-6">
			<h3>Contact Us</h3>
			<p>
				If you have any questions or need assistance  please <a href="#">contact us here</a> . Thank you!
			</p>
		</div>
	</div>-->

