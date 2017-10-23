<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/* Helper functions and classes with static methods for usage in theme */

// Register Lato Google font
if(!function_exists('consult_font_url')){
	function consult_font_url() {
		$fonts_url = '';
		/* Translators: If there are characters in your language that are not
	    * supported by Lato, translate this to 'off'. Do not translate
	    * into your own language.
	    */
		$lato = esc_html_x( 'on', 'Lato font: on or off', 'consult' );

		/* Translators: If there are characters in your language that are not
	    * supported by Open Sans, translate this to 'off'. Do not translate
	    * into your own language.
	    */
		$montserrat = esc_html_x( 'on', 'Montserrat font: on or off', 'consult' );

		if (  'off' !== $lato || 'off' !== $montserrat) {
			$font_families = array();

			if ( 'off' !== $lato ) {
				$font_families[] = 'Lato:700,400,800,600,300';
			}

			if ( 'off' !== $montserrat ) {
				$font_families[] = 'Montserrat:700,400,800,600';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
		}

		return esc_url_raw( $fonts_url );
	}
}


if ( ! function_exists('consult_the_attached_image') ) : /**
 * Print the attached image with a link to the next attached image.
 */ {
	function consult_the_attached_image() {
		$post = get_post();
		/**
		 * Filter the default attachment size.
		 *
		 * @param array $dimensions {
		 *     An array of height and width dimensions.
		 *
		 * @type int $height Height of the image in pixels. Default 810.
		 * @type int $width Width of the image in pixels. Default 810.
		 * }
		 */
		$attachment_size     = apply_filters( 'consult_attachment_size', array( 810, 810 ) );
		$next_attachment_url = wp_get_attachment_url();

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => - 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id ) {
				$next_attachment_url = get_attachment_link( $next_id );
			} // or get the URL of the first image attachment.
			else {
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}
		}

		printf( '<a href="%1$s" rel="attachment">%2$s</a>',
			esc_url( $next_attachment_url ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
}
endif;

/* Custom template tags */
{
	if ( ! function_exists( 'consult_paging_nav' ) ) : /**
	 * Display navigation to next/previous set of posts when applicable.
	 */ {
		function consult_paging_nav( $wp_query = null ) {

			if ( ! $wp_query ) {
				$wp_query = $GLOBALS['wp_query'];
			}

			// Don't print empty markup if there's only one page.

			if ( $wp_query->max_num_pages < 2 ) {
				return;
			}

			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link = html_entity_decode( get_pagenum_link() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
				'index.php' ) ? 'index.php/' : '';
			$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
				'paged' ) : '?paged=%#%';

			// Set up paginated links.
			$links = paginate_links( array(
				'base'      => $pagenum_link,
				'format'    => $format,
				'total'     => $wp_query->max_num_pages,
				'current'   => $paged,
				'mid_size'  => 1,
				'add_args'  => array_map( 'urlencode', $query_args ),
				'prev_text' => '',
				'next_text' => '',
				'type' 		=> 'list'
			) );

			if ( $links ) :

				?>
				<nav class="navigation paging-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'consult' ); ?></h1>

					<ul class="pagination float-right">
						<?php echo wp_kses($links,
						array(
							'ul' => array(
								'class' => array(),
							),
							'li' => array(),
							'span' => array(
								'class' => array(),
							),
							'a' => array(
								'class' => array(),
								'href' => array(),
							),
						)); ?>
					</ul>
					<!-- .pagination -->
				</nav><!-- .navigation -->
			<?php
			endif;
		}
	}
	endif;

	if ( ! function_exists( 'consult_posted_on' ) ) : /**
	 * Print HTML with meta information for the current post-date/time and author.
	 */ {
		function consult_posted_on() {
			$post_date = get_the_date('d');
			$post_m = get_the_date('M');
			$post_y = get_the_date('Y');
			$post_comment = get_comments_number();
			$author = get_the_author_meta('display_name');

			$post_info = '<div class="blog-post-box-date-circle"><div class="blog-post-date-number">'.$post_date.'</div>';
			$post_info .= '<div class="blog-post-date-text">
				<span class="blog-post-month-text">'.$post_m.', </span>
				<span class="blog-post-year-text">'.$post_y.'</span>
			</div></div>';
			$post_info .= '<div class="blog-post-under-date">';
			if(comments_open()){
				if ( $post_comment == 0 ) {
					$comments = esc_html__('0', 'consult');
				} elseif ( $post_comment > 1 ) {
					$comments = $post_comment;
				} else {
					$comments = esc_html__('1', 'consult');
				}
				$post_info .= '<span class="ion-ios-chatboxes-outline">';
				$post_info .= $comments;
				$post_info .= '</span>';
			}
			$post_info .= '<span class="ion-compose">';
			$post_info .= $author;
			$post_info .= '</span>';
			


			$post_info .= '</div>';

			return $post_info;

		}
	}
	endif;

	if(!function_exists('consult_blog_categories')):
		function consult_blog_categories(){
			$categories_string = '';
			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'consult' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				$categories_string .= trim( $output, $separator );
			}
			return $categories_string;
		}
	endif;


	if( !function_exists('consult_post_count')) {
		function consult_post_count(){
			$post_count = wp_count_posts();
			$post_count_number = $post_count->publish;
			$post_per_page = get_option('posts_per_page');

			$post_count_result = '<ul class="blog-total-post float-left">';
			$post_count_result .= '<li>'.esc_html__("Total", "consult").' <a href="#">'.$post_count_number.' '.esc_html__("news", "consult").'</a> '.esc_html__("in our Blog", "consult").'</li>';
			$post_count_result .= '<li>'.esc_html__("Showing", "consult").' <a href="#">'.$post_per_page.'/'.$post_count_number.'</a> '.esc_html__("items", "consult").'</li>';
			$post_count_result .= '</ul>';

			return $post_count_result;
		}
	}

	if ( ! function_exists('consult_theme_post_nav') ) : /**
	 * Display navigation to next/previous post when applicable.
	 */ {
		function consult_theme_post_nav() {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
			if(!empty($previous)){
				$pre_link = get_permalink($previous);
				$pre_post_id = $previous->ID;
			}
			if(!empty($next)){
				$next_link = get_permalink($next);
				$next_post_id = $next->ID;
			}

			?>

			<div class="blog-nav-post flw">
				<a href="<?php echo esc_url($pre_link); ?>" class="control-prev-btn"><?php esc_html_e('Previous', 'consult'); ?></a>
				<a href="<?php echo esc_url($next_link); ?>" class="control-next-btn"><?php esc_html_e('Next', 'consult'); ?></a>
			</div>
			<?php
		}
	}
	endif;

	/**
	 * Find out if blog has more than one category.
	 *
	 * @return boolean true if blog has more than 1 category
	 */
	function consult_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'consult_category_count' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'consult_category_count', $all_the_cool_cats );
		}

		if ( 1 !== (int) $all_the_cool_cats ) {
			// This blog has more than 1 category so consult_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so consult_categorized_blog should return false
			return false;
		}
	}

}

// Custom template tags and functions by HAINTHEME
{
	/**
	 * Custom comment output.
	 */
	function consult_comment_list($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment; ?>
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-body">
				<div class="comment-avatar vcard">
					<?php echo get_avatar($comment,$size='90'); ?>
				</div>
				<div class="comment-content">
					<div class="comment-author">
						<a href="<?php echo esc_url(get_comment_author_link()); ?>" class="comment-author-name"><?php echo get_comment_author(); ?></a>
						<div class="comment-time"><?php echo get_comment_date(); ?></div>
					</div>
					<div class="comment-text">
						<?php if ($comment->comment_approved == '0') : ?>
							<em><?php esc_html_e('Your comment is awaiting moderation.', 'consult') ?></em>
							<br/>
						<?php endif; ?>
						<?php comment_text() ?>
					</div>
					<?php edit_comment_link(esc_html__('Edit', 'consult'), '  ', '') ?>
					<?php echo get_comment_reply_link(array_merge($args,array(
						'depth' => $depth,
						'reply_text' => 'Reply',
						'max_depth' => $args['max_depth'])));
					?>
					<!-- /.comment-content-inner -->
				</div>
			</div>
		</div>
	<?php
	}
}



//remove query strings
function consult_remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', 'consult_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'consult_remove_script_version', 15, 1 );

//defer js file
if (!(is_admin() )) {
	function consult_defer_parsing_of_js ( $url ) {
		if ( FALSE === strpos( $url, '.js' ) ) return $url;
        if ( strpos( $url, 'jquery.js' ) ) return $url;
		return "$url' defer='defer";
	}
	add_filter( 'clean_url', 'consult_defer_parsing_of_js', 11, 1 );
}


// heard of WordPress
if ( ! isset( $content_width ) ) $content_width = 1170;

// custom css for editor wordpress
function my_theme_add_editor_styles() {
    add_editor_style('/css/admin.css');
}
add_action( 'init', 'my_theme_add_editor_styles' );

function bb_next_pre_post(){
	echo '<div class="blog-nav-post">';
		// 
		$post_id = $post->ID; // current post ID
		$cat = get_the_category(); 
		$current_cat_id = $cat[0]->cat_ID; // current category ID 

			$args = array( 
				'category' => $current_cat_id,
				'orderby'  => 'post_date',
				'order'    => 'DESC'
			);
			$posts = get_posts( $args );
			// get IDs of posts retrieved from get_posts
			$ids = array();
			foreach ( $posts as $thepost ) {
				$ids[] = $thepost->ID;
			}
			// get and echo previous and next post in the same category
			$thisindex = array_search( $post_id, $ids );
			$previd = $ids[ $thisindex - 1 ];
			$nextid = $ids[ $thisindex + 1 ];

			if ( ! empty( $previd ) ) {
				?><a rel="prev" href="<?php echo get_permalink($previd) ?>">&laquo;&laquo <?php echo get_the_title( ($previd) ); ?></a><?php
			}
			if ( ! empty( $nextid ) ) {
				?><a rel="next" href="<?php echo get_permalink($nextid) ?>"><?php echo get_the_title( $nextid ); ?> &raquo;&raquo;</a><?php
			}
	echo '</div>';
}