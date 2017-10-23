<?php
/**
 * Theme Customizer
 */
 /**
  * Add the theme configuration
  */
Consult_Kirki::add_config( 'consult', array(
 	'option_type' => 'theme_mod',
 	'capability'  => 'edit_theme_options',
 ) );

 /**
  * Add the typography section
  */
// Add the color section******
Consult_Kirki::add_section( 'colors', array(
 	'title'      => esc_attr__( 'Colors', 'consult' ),
 	'priority'   => 17,
 	'capability' => 'edit_theme_options',
 ) );
// Add typo section
Consult_Kirki::add_section( 'typography', array(
 	'title'      => esc_attr__( 'Typography', 'consult' ),
 	'priority'   => 90,
 	'capability' => 'edit_theme_options',
 ) );

// typo main menu
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'menu_typography',
//  	'label'       => esc_attr__( 'Mainmenu Typography', 'consult' ),
//  	'description' => esc_attr__( 'Select the typography options for your Main menu.', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 1,
//  	'default'     => array(
//  		'font-family'    => 'Poppins',
//  		'font-weight'        => '600',
//  		'font-size'      => '14px',
//  		'color'          => '#232323',
//  	),
//  	'transport' => 'postMessage',
//  	'js_vars' => array(
//  		array(
//  			'element' =>
//  			'.menu-style-2 .primary-menu > li > a,
//  				.menu-box.topseo-not-top .primary-menu > li > a',
// 		)
// 	),
//  	'output' => array(
//  		array(
//  			'element' =>
//  				'.menu-style-2 .primary-menu > li > a,
//  				.menu-box.topseo-not-top .primary-menu > li > a',
//  		),
//  	),
//  ) );
// // typo sub menu
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'submenu_typography',
//  	'label'       => esc_attr__( 'Submenu Mainmenu Typography', 'consult' ),
//  	'description' => esc_attr__( 'Select the typography options for your Submenu.', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 1,
//  	'default'     => array(
//  		'font-family'    => 'Poppins',
//  		'font-weight'        => '600',
//  		'font-size'      => '12px',
//  		'color'          => '#999999',
//  	),
//  	'transport' => 'postMessage',
//  	'js_vars' => array(
//  		array(
//  			'element' => 'body #mainview .sub-menu:not(.mega-menu-row) a',
// 		)
// 	),
//  	'output' => array(
//  		array(
//  			'element' => 'body #mainview .sub-menu:not(.mega-menu-row) a',
//  		),
//  	),
//  ) );
//  // typo megamenu heading
// // typo megamenu heading
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'megamenu_heading_typography',
//  	'label'       => esc_attr__( 'Megamenu Heading Typography', 'consult' ),
//  	'description' => esc_attr__( 'Select the typography options for your Megamenu Heading.', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 1,
//  	'default'     => array(
//  		'font-family'    => 'Poppins',
//  		'font-weight'        => '600',
//  		'font-size'      => '16px',
//  		'color'          => '#232323',
//  	),
//  	'transport' => 'postMessage',
//  	'js_vars' => array(
//  		array(
//  			'element' => '.menu-item-has-mega-menu .mega-menu-row > li > a',
// 		)
// 	),
//  	'output' => array(
//  		array(
//  			'element' => '.menu-item-has-mega-menu .mega-menu-row > li > a',
//  		),
//  	),
//  ) );
// // typo megamenu submenu
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'sub_megamenu_typography',
//  	'label'       => esc_attr__( 'Submenu Megamenu Typography', 'consult' ),
//  	'description' => esc_attr__( 'Select the typography options for your Main menu.', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 1,
//  	'default'     => array(
//  		'font-family'    => 'Poppins',
//  		'font-weight'        => '600',
//  		'font-size'      => '12px',
//  		'color'          => '#999999',
//  	),
//  	'transport' => 'postMessage',
//  	'js_vars' => array(
//  		array(
//  			'element' => 'body #mainview .menu-box-right .menu-item-has-mega-menu .mega-menu-row .sub-menu a',
// 		)
// 	),
//  	'output' => array(
//  		array(
//  			'element' => 'body #mainview .menu-box-right .menu-item-has-mega-menu .mega-menu-row .sub-menu a',
//  		),
//  	),
//  ) );
// // typo body
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'body_typography',
//  	'label'       => esc_attr__( 'Body Typography', 'consult' ),
//  	'description' => esc_attr__( 'Select the main typography options for your site.', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 2,
//  	'transport' => 'postMessage',
//  	'default'     => array(
//  		'font-family'    => 'Lato',
//  		'font-weight'        => '400',
//  		'font-size'      => '14px',
//  		'line-height'    => '24px',
//  		'color'          => '#686868',
//  	),
//  	'js_vars' => array(
//  		array(
//  			'element' => 'body p, .fw-desc, .servide-desc',
// 		),
// 	),
//  	'output' => array(
//  		array(
//  			'element' => 'body p, .fw-desc, .servide-desc',
//  		),
//  	),
//  ) );
// // typo heading
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'heading_typography',
//  	'label'       => esc_attr__( 'Heading', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 3,
//  	'default'     => array(
//  		'font-family' => 'Poppins',
//  		'font-weight' => '700',
//  		'color' => '#232323',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
//  		),
//  	),
//  ));
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'h1_typography',
//  	'label'       => esc_attr__( 'H1', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 4,
//  	'default'     => array(
//  		'font-size'      => '48px',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => 'h1',
//  		),
//  	),
//  ));
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'h2_typography',
//  	'label'       => esc_attr__( 'H2', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 5,
//  	'default'     => array(
//  		'font-size'      => '36px',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => 'h2',
//  		),
//  	),
//  ));
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'h3_typography',
//  	'label'       => esc_attr__( 'H3', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 6,
//  	'default'     => array(
//  		'font-size'      => '30px',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => 'h3',
//  		),
//  	),
//  ));
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'h4_typography',
//  	'label'       => esc_attr__( 'H4', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 7,
//  	'default'     => array(
//  		'font-size'      => '24px',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => 'h4',
//  		),
//  	),
//  ));
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'h5_typography',
//  	'label'       => esc_attr__( 'H5', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 8,
//  	'default'     => array(
//  		'font-size'      => '22px',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => 'h5',
//  		),
//  	),
//  ));
// Consult_Kirki::add_field( 'consult', array(
//  	'type'        => 'typography',
//  	'settings'    => 'h6_typography',
//  	'label'       => esc_attr__( 'H6', 'consult' ),
//  	'section'     => 'typography',
//  	'priority'    => 9,
//  	'default'     => array(
//  		'font-size'      => '18px',
//  	),
//  	'output' => array(
//  		array(
//  			'element' => 'h6',
//  		),
//  	),
//  ));


// Header********

// Header layout
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'select',
	'settings'  => 'c_header_layout',
	'label'     => esc_attr__( 'Layout', 'consult' ),
	'section'   => 'topbar',
	'default'   => 'style-1',
	'priority'  => 1,
	'choices'   => array(
		'style-1' => esc_attr__( 'Style 1', 'consult' ),
		'style-2' => esc_attr__( 'Style 2', 'consult' ),
	)
) );

// hide or show topbar
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'radio',
	'settings'  => 'hide_show_topbar',
	'label'     => esc_attr__( 'Topbar', 'consult' ),
	'section'   => 'topbar',
	'default'   => 'on',
	'priority'  => 2,
	'choices'   => array(
		'on' => esc_attr__( 'Enable', 'consult' ),
		'off' => esc_attr__( 'Disable', 'consult' ),
	),	
	'active_callback'  => array(
		array(
			'setting'  => 'c_header_layout',
			'operator' => '==',
			'value'    => 'style-1',
		),
	)
) );

// topbar background
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'color',
	'settings'  => 'c_topbar_bg',
	'label'     => esc_attr__( 'Topbar background', 'consult' ),
	'section'   => 'topbar',
	'default'   => '#003a5a',
	'priority'  => 3,
	'alpha' => true,
	'transport' => 'postMessage',
	'js_vars'     => array(
		array(
			'element' => '.topbar',
			'function' => 'css',
			'property' => 'background'
		)
	),
	'output'     => array(
		array(
			'element' => '.topbar',
			'function' => 'css',
			'property' => 'background'
		)
	),
	'active_callback'  => array(
		array(
			'setting'  => 'c_header_layout',
			'operator' => '==',
			'value'    => 'style-1',
		),
		array(
			'setting'  => 'hide_show_topbar',
			'operator' => '==',
			'value'    => 'on',
		),
	),
) );

// topbar left
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'code',
	'settings'  => 'c_topbar_left',
	'label'     => esc_attr__( 'Topbar Left', 'consult' ),
	'section'   => 'topbar',
	'default'   =>
'<div class="topbar-lang">
	<button>English</button>
	<ul class="lang-list">
		<li>English</li>
		<li>Cuba</li>
	</ul>
</div>',
	'priority'  => 4,
	'active_callback'  => array(
		array(
			'setting'  => 'c_header_layout',
			'operator' => '==',
			'value'    => 'style-1',
		),
		array(
			'setting'  => 'hide_show_topbar',
			'operator' => '==',
			'value'    => 'on',
		),
	)
) );

// topbar right
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'code',
	'settings'  => 'c_topbar_right',
	'label'     => esc_attr__( 'Topbar Right', 'consult' ),
	'section'   => 'topbar',
	'default'   =>
'<div class="topbar-button">
	<a href="#" class="fa fa-tty">Free Consult</a>
</div>
<div class="topbar-info">
	<span class="ion-android-phone-portrait">+212 386 5575</span>
	<span class="fa fa-envelope">Support@ConsultWP.com</span>
	<span class="ion-ios-location">1010 Avenue of the Moon, New York, NY 10018 US.</span>
</div>',
	'priority'  => 5,
	'active_callback'  => array(
		array(
			'setting'  => 'c_header_layout',
			'operator' => '==',
			'value'    => 'style-1',
		),
		array(
			'setting'  => 'hide_show_topbar',
			'operator' => '==',
			'value'    => 'on',
		),
	)
) );

// menu background
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'color',
	'settings'  => 'c_menu_bg',
	'label'     => esc_attr__( 'Menu background', 'consult' ),
	'section'   => 'topbar',
	'default'   => '#ffffff',
	'priority'  => 6,
	'alpha' => true,
	'transport' => 'postMessage',
	'js_vars'     => array(
		array(
			'element' => '.consult-box-header',
			'function' => 'css',
			'property' => 'background'
		)
	),
	'output'     => array(
		array(
			'element' => '.consult-box-header',
			'function' => 'css',
			'property' => 'background'
		)
	),
	'active_callback'  => array(
		array(
			'setting'  => 'c_header_layout',
			'operator' => '==',
			'value'    => 'style-1',
		),
	)
) );


// position breadcrumbs
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'select',
	'settings'  => 'c_header_position',
	'label'     => esc_attr__( 'Page Header Position', 'consult' ),
	'section'   => 'c_crumbs',
	'default'   => 'page-header-center',
	'priority'  => 40,
	'choices'   => array(
		'page-header-center' => esc_attr__('Default', 'consult'),
		'page-header-left' => esc_attr__( 'Left', 'consult' ),
		'page-header-right' => esc_attr__( 'Right', 'consult' ),
	)
) );

// background breadcrumb
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'radio',
	'settings'  => 'c_header_bg',
	'label'     => esc_attr__( 'Background Header', 'consult' ),
	'description' => esc_attr__('If select background image option, the theme recommends a header size of at least 1170 width pixels', 'consult'),
	'section'   => 'c_crumbs',
	'default'   => 'bg_color',
	'priority'  => 20,
	'choices'   => array(
		'bg_image' => esc_attr__( 'Background Image', 'consult' ),
		'bg_color' => esc_attr__( 'Background Color', 'consult' ),
	)
) );
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'image',
	'settings'  => 'c_header_bg_image',
	'label'     => esc_attr__( 'Upload Image', 'consult' ),
	'section'   => 'c_crumbs',
	'description'   => esc_attr__( 'Upload background image of page header here!', 'consult' ),
	'priority'  => 30,
	'active_callback'  => array(
		array(
			'setting'  => 'c_header_bg',
			'operator' => '==',
			'value'    => 'bg_image',
		),
	)
) );
Consult_Kirki::add_field( 'consult', array(
  'type'        => 'color',
	'settings'    => 'c_header_bg_color',
	'label'       => esc_attr__( 'Select Color', 'consult' ),
	'section'     => 'c_crumbs',
	'default'     => '#252c44',
  'transport'   => 'postMessage',
	'priority'    => 40,
  'js_vars'     => array(
      array(
        'element' => 'body .breadcrumb',
        'function'     => 'css',
        'property'    => 'background-color',
        'suffix'    => ' !important'
      )
  ),
  'active_callback'  => array(
		array(
			'setting'  => 'c_header_bg',
			'operator' => '!=',
			'value'    => 'bg_image',
		),
	)
));

// customizer css
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'code',
	'settings'  => 'customizer_css',
	'label'     => esc_attr__( 'Custom CSS', 'consult' ),
	'description' => esc_attr__( 'Add your custom CSS here to change style of theme.', 'consult' ),
	'section'   => 'general',
	'priority'  => 30,
) );

// FOOTER********
// footer background
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'color',
	'settings'  => 'c_footer_bg',
	'label'     => esc_attr__( 'Footer background color', 'consult' ),
	'section'   => 'c_footer',
	'default'   => '#003a5b',
	'priority'  => 2,
	'transport' => 'postMessage',
	// preview
	'js_vars'     => array(
		array(
			'element' => '.consult-footer-widget',
			'function' => 'css',
			'property' => 'background'
		)
	),
	// output
	'output' => array(
		array(
			'element' => '.consult-footer-widget',
			'function' => 'css',
			'property' => 'background'
		)
	),
) );

// copyright background
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'color',
	'settings'  => 'c_copyright_bg',
	'label'     => esc_attr__( 'Copyright background color', 'consult' ),
	'section'   => 'c_footer',
	'default'   => '#002b43',
	'priority'  => 3,
	'transport' => 'postMessage',
	// preview
	'js_vars'     => array(
		array(
			'element' => '.consult-copy-right',
			'function' => 'css',
			'property' => 'background'
		)
	),
	// output
	'output' => array(
		array(
			'element' => '.consult-copy-right',
			'function' => 'css',
			'property' => 'background'
		)
	),
) );

// primary color
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'color',
	'settings'  => 'primary_color',
	'label'     => esc_attr__( 'Primary color', 'consult' ),
	'description' => esc_attr__( 'Choose color', 'consult' ),
	'section'   => 'colors',
	'default'   => '#27ae61',
	'priority'  => 1,
	'transport' => 'postMessage',
	// preview
	'js_vars'     => array(
	),
	// output
	'output' => array(
	),
) );

// secondary color
Consult_Kirki::add_field( 'consult', array(
	'type'      => 'color',
	'settings'  => 'secondary_color',
	'label'     => esc_attr__( 'Secondary color', 'consult' ),
	'description' => esc_attr__( 'Choose color', 'consult' ),
	'section'   => 'colors',
	'default'   => '#ffa506',
	'transport' => 'postMessage',
	'priority'  => 2,
	// preview
	'js_vars' => array(
	),
	// output
	'output' => array(
	),
) );
