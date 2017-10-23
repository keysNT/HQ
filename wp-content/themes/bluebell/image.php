<?php
/**
 * The template for displaying image attachments
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header();
?>
<main id="main" class="page_content blog-page flw">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-lg-9">
				<?php while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="theme-img-single-view flw">
						<span class="entry-date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
						<span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo ($metadata['width']); ?> &times; <?php echo ($metadata['height']); ?></a></span>
						<span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
						<?php edit_post_link( esc_html__( 'Edit', 'consult' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
					<div class="theme-img-content-single-view flw">
						<div class="entry-attachment">
							<div class="attachment">
								<?php consult_the_attached_image(); ?>
							</div><!-- .attachment -->

							<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'consult' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php consult_paging_nav(); ?>

				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="col-md-3 col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php
get_footer();
