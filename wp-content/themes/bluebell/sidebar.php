<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package consult
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="consult-blog-sidebar" class="widget-area flw" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>