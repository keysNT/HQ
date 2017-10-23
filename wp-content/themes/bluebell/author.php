<?php
/**
 * The template for displaying Archive pages
 */

get_header(); ?>

	<main id="main" class="page_content flw">
		<div class="container">
			<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;
					consult_paging_nav();
				else :
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div>
	</main>

<?php
get_footer();
