<?php
/**
 * The template for displaying a "No posts found" message
 */
?>

<div class="page-search flw">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php esc_html__( 'Ready to publish your first post?', 'consult' ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'consult' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'consult' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</div>
