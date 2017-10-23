<?php
/**
 * The Template for displaying all single posts
 */
get_header();

global $post;
$btn1 = function_exists('fw_get_db_post_option') ? fw_get_db_post_option($post->ID, 'btn-1') : '';
$btn1_data = (isset($btn1) && !empty($btn1)) ? $btn1['url'] : '#';
$btn2 = function_exists('fw_get_db_post_option') ? fw_get_db_post_option($post->ID, 'btn-2') : '#';
$ans_shortcode = function_exists('fw_get_db_post_option') ? fw_get_db_post_option($post->ID, 'ans_shortcode') : '';

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$category = get_the_category($post->ID);
?>
<div class="ht-forum-heading ht-program-heading row">
	<div class="container">
		<div class="col-md-12">
			<div class="ht-forum-heading-left">
				<?php
				if($category){
					echo '<div class="back-to-cat">';
					echo 'Back to <a href="'.get_category_link($category[0]->term_id).'">'.$category[0]->cat_name.'</a>';
					echo '</div>';
				}
				?>
			</div>
			<div class="ht-forum-heading-right">
				<?php wp_nav_menu( array('theme_location' => 'forum' ) ); ?>
			</div>
		</div>
	</div>
</div>
<main id="main" class="page_content flw">
	<div class="container">
		
					<?php get_template_part( 'content', get_post_format() ); ?>

					<div class="button-box">
						<a href="<?php echo esc_url($btn1_data); ?>">Download training program</a>
						<?php if($btn2 != ''): ?>
							<a href="<?php echo esc_url($btn2); ?>">View online training program</a>
						<?php endif; ?>
					</div>

					<?php 
					if($ans_shortcode != ''){
						echo do_shortcode( $ans_shortcode );
					}
					/*nav*/
					/*comment*/
					if ( comments_open() || get_comments_number() ) {
						//comments_template();
					}
				endwhile;
				
			else :
				get_template_part('content', 'none') ;
			endif;
		?>
	</div>
</main>
<?php get_footer(); ?>
