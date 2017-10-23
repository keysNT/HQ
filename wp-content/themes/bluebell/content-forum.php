<?php
/**
 * The template used for displaying page content
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="flw">
		<?php
			the_content();
			// break page
			wp_link_pages();
		?>
	</div>
</div>