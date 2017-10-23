<?php
/**
 *	Template Name: Forum Template
 */
$new_title = ap_opt( 'base_page_title' );
get_header(); ?>
	<main id="main-forum" class="page_content flw ht-question">

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="ht-forum-heading row">
				<div class="container">
					<div class="col-md-9 col-lg-9">
						<div class="ht-forum-heading-left">
							<h1><?php echo $new_title; ?></h1>
						</div>
						<div class="ht-forum-heading-right">
							<?php wp_nav_menu( array('theme_location' => 'forum' ) ); ?>
						</div>
					</div>
				</div>
			</div>
				<?php

					echo '<div class="container">
					<div class="row">';
						echo '<div class="col-md-9 col-lg-9">';
							get_template_part('content', 'forum');
						echo '</div>';
						echo '<div class="col-md-3 col-lg-3">';
							get_sidebar('content');
						echo '</div>';
					echo '</div></div>';
					break;
				endwhile; ?>

			<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</main>
<?php get_footer(); ?>
