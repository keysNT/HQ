<?php if(!is_user_logged_in() && !ap_opt('allow_anonymous')): ?>
	<?php //do_action( 'wordpress_social_login' ); ?>
	<h3>WELCOME TO BLUEBELL RETAIL ACADEMY!</h3>
	<p>
		The Bluebell Retail Academy is a training interactive platform proposing leading edge education solutions and training programs through innovative pedagogical tools for effective business application.
	</p>
	<div class="line"></div>
	<div class="bb-login-form">
		<div class="bb-login-form-header">
			<h3 class="form-header">Log in</h3>
		</div>
		<div class="bb-login-form-inner">
			<?php wp_login_form(); ?>
		</div>
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
<?php endif; ?>
