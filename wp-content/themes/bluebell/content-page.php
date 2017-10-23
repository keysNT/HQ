<?php
/**
 * The template used for displaying page content
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