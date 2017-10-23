<?php
/**
 * The template for displaying Search Results pages
 */
get_header(); ?>
	<main id="main" class="page_content page-search flw">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<h3>Search results</h3>
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post(); ?>
								<ul class="bb-search-results">
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								</ul>
							<?php endwhile;
							consult_paging_nav();
						else :
							get_template_part( 'content', 'none' );
						endif;
					?>
				</div>
			</div>
		</div>
	</main>
<?php
get_footer();
