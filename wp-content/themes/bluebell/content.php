<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 * @package consult
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="flw">
		<h3><?php the_title(); ?></h3>
		<?php
			the_content();
			// break page
			wp_link_pages();
		?>
	</div>
</div>
