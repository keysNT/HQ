<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package consult
 */

get_header(); ?>
<main id="main" class="page_content flw">
	<div class="container">
		<?php
			if (have_posts()) :
				// loop
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				// pagination
				consult_paging_nav();
			else :
				get_template_part( 'content', 'none' );
			endif;
		?>
	</div>
</main>
<?php get_footer(); ?>
