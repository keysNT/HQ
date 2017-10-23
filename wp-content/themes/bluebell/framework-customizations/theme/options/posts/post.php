<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'btn-1' => array(
		'type' => 'upload',
		'label' => 'Download training program',
		'desc' => 'Choose file',
	),
	'btn-2' => array(
		'type' => 'text',
		'label' => 'View online training program',
		'desc' => 'Enter link',
		'value' => '#'
	),
	'ans_shortcode' => array(
		'type' => 'textarea', 
		'label' => esc_html('Anspress shortcode', 'bluebell'),
		'value' => ''
	)
);
