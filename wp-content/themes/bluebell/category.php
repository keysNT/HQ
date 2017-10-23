<?php
/**
 * The template for displaying Category pages
 */
global $post;

get_header(); ?>

	<main id="main" class="page_content flw">
		<div class="container">
		<?php
			$cat = get_the_category($post->ID);
			if($cat){
			    echo '<h3>'.$cat[0]->name.'</h3>';
			}
			$data = function_exists('fw_get_db_term_option') ? fw_get_db_term_option($cat[0]->term_id, 'category', 'data') : '';
			echo $data;
		?>
		</div>
	</main>

<?php
get_footer();
