<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>


<main id="main" class="flw">
	<div class="error-page flw">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
					<div class="error-content flw text-center">
						<h2 class="error-title"><?php esc_html_e('404', 'consult'); ?></h2>
						<h4><?php esc_html_e('The requested page cannot be found!', 'consult'); ?></h4>
						<p><?php
								esc_html_e( 'The page you are looking for was moved, removed, renamed or might never existed.', 'consult' );
							?></p>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="bb-btn-normal"><?php esc_html_e('HOME PAGE', 'consult'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
