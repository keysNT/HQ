<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Include static files: javascript and css
 */

if ( is_admin() ) {
	return;
}

/**
 * Enqueue scripts and styles for the front end.
 */


// Load our main stylesheet.
wp_enqueue_style(
	'consult-theme-style',
	get_stylesheet_uri(),
	array(),
	'1.0'
);

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

/**
 * Enqueue scripts
 */
wp_enqueue_script(
	'consult-theme-plugins',
	get_template_directory_uri() . '/js/consult.jquery.plugins.js',
	array( 'jquery' ),
	'1.0',
	true
);
wp_enqueue_script(
	'consult-theme-script',
	get_template_directory_uri() . '/js/consult.custom.js',
	array( 'jquery' ),
	'1.0',
	true
);