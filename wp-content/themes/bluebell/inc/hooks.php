<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Filters and Actions
 */
if ( ! function_exists( 'consult_action_theme_setup' ) ) :
{
	function consult_action_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'consult', get_template_directory() . '/languages' );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		add_theme_support('title-tag');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
	}
}
endif;
add_action( 'after_setup_theme', 'consult_action_theme_setup' );

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 * @internal
 */
function consult_filter_theme_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( function_exists('fw_ext_sidebars_get_current_position') ) {
		$current_position = fw_ext_sidebars_get_current_position();
		if ( in_array( $current_position, array( 'full', 'left' ) )
		     || empty($current_position)
		     || is_page_template( 'page-templates/full-width.php' )
		     || is_page_template( 'page-templates/contributors.php' )
		     || is_attachment()
		) {
			$classes[] = 'full-width';
		}
	} else {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}

add_filter( 'body_class', 'consult_filter_theme_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 *
 * @return array The filtered post class list.
 * @internal
 */
function consult_filter_theme_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}

add_filter( 'post_class', 'consult_filter_theme_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 * @internal
 */
function consult_filter_theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'consult' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'consult_filter_theme_wp_title', 10, 2 );


/**
 * Flush out the transients used in fw_theme_categorized_blog.
 * @internal
 */
function consult_action_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'fw_theme_category_count' );
}

add_action( 'edit_category', 'consult_action_theme_category_transient_flusher' );
add_action( 'save_post', 'consult_action_theme_category_transient_flusher' );

/**
 * Theme Customizer support
 */
{
	/**
	 * Implement Theme Customizer additions and adjustments.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @internal
	 */
	function consult_action_theme_customize_register( $wp_customize ) {
		// Add custom description to Colors and Background sections.
		$wp_customize->get_section( 'colors' )->description           = esc_html__( 'Background may only be visible on wide screens.','consult' );
		$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Background may only be visible on wide screens.','consult' );

		// Add postMessage support for site title and description.
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		// Rename the label to "Site Title Color" because this only affects the site title in this theme.
		$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'consult' );

		// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
		$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'consult' );

	}

	add_action( 'customize_register', 'consult_action_theme_customize_register' );
}

/**
 * Register widget areas.
 * @internal
 */
function consult_action_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'consult' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'consult' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'consult' ),
		'id'            => 'footer-theme-widget',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'consult' ),
		'before_widget' => '<div class="col-md-3 col-lg-3"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register sidebar for shop page,
	// remove it if theme dose not support Woocomerce
	if(class_exists('Woocommerce')) {
		register_sidebar(array(
			'name' => esc_html__('Sidebar Shop Area', 'consult'),
			'id' => 'sidebar-shop',
			'description' => esc_html__('Appears in the sidebar of shop page.', 'consult'),
			'before_widget' => '<aside id="%1$s" class="widget shop %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="shop-widget-title">',
			'after_title' => '</h3>',
		));
	}
}

add_action( 'widgets_init', 'consult_action_theme_widgets_init' );

if ( defined( 'FW' ) ):
	/**
	 * Display current submitted FW_Form errors
	 * @return array
	 */
	if ( ! function_exists( 'consult_action_theme_display_form_errors' ) ):
		function consult_action_theme_display_form_errors() {
			$form = FW_Form::get_submitted();

			if ( ! $form || $form->is_valid() ) {
				return;
			}

			wp_enqueue_script(
				'consult-theme-show-form-errors',
				get_template_directory_uri() . '/js/form-errors.js',
				array( 'jquery' ),
				'1.0',
				true
			);

			wp_localize_script( 'consult-theme-show-form-errors', '_localized_form_errors', array(
				'errors'  => $form->get_errors(),
				'form_id' => $form->get_id()
			) );
		}
	endif;
	add_action('wp_enqueue_scripts', 'consult_action_theme_display_form_errors');
endif;

/**
 * Filter to wp_editor
 * to optimize fw_resize function
 */
add_filter( 'jpeg_quality', 'consult_filter_theme_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'consult_filter_theme_image_full_quality' );

function consult_filter_theme_image_full_quality( $quality ) {
	return 100;
}

/**
 * Disable/Enable default section in customizer
 */
global  $wp_customize;
if ( isset($wp_customize) && $wp_customize->is_preview() ) {
    function consult_customizer_remove_sections( $wp_customize ) {
        $wp_customize->remove_section( 'featured_content' );
    }
    add_action( 'customize_register' , 'consult_customizer_remove_sections' );
}

// Register new option types
function consult_include_custom_option_types() {
    get_template_part('/inc/includes/option-types/ht-switch/class-fw-option-type', 'ht-switch');
}
add_action('fw_option_types_init', 'consult_include_custom_option_types');


/**
 * Custom css for admin
 * @return [type] [description]
 */
/**
 * Fixed problem Unyson & YITH
 * conflict color picker
 * @return [type] [description]
 */
function consult_deregister_woocommerce_setting(){
	$screen = get_current_screen();
	if ( $screen->post_type == 'page' ){
			//wp_deregister_script( 'woocommerce_settings' );
	}
}

/**
 * Install Demo content
 */
function consult_backups_demos($demos) {
	$demos_array = array(
		'consultlite' => array(
			'title' => esc_html__('Consult Demo Lite', 'consult'),
			'screenshot' => get_template_directory_uri().'/screenshot.png',
			'preview_link' => 'haintheme.com/demo/wp/consult/',
		),
		'consultfull' => array(
			'title' => esc_html__('Consult Demo Full', 'consult'),
			'screenshot' => get_template_directory_uri().'/screenshot.png',
			'preview_link' => 'haintheme.com/demo/wp/consult/',
		)
		// ...
	);

	$download_url = 'http://haintheme.com/ht-demos/';

	foreach ($demos_array as $id => $data) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => $download_url,
			'file_id' => $id,
		));
		$demo->set_title($data['title']);
		$demo->set_screenshot($data['screenshot']);
		$demo->set_preview_link($data['preview_link']);

		$demos[ $demo->get_id() ] = $demo;

		unset($demo);
	}

	return $demos;
}

add_filter('fw:ext:backups-demo:demos', 'consult_backups_demos');
