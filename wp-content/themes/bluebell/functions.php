<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Theme Includes
 */
require_once get_template_directory() .'/inc/init.php';

/**
 * TGM Plugin Activation
 */
{
	require_once get_template_directory() . '/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

	require_once get_template_directory() . '/TGM-Plugin-Activation/recommend_plugins.php';
}


