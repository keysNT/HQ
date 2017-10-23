<?php

$options = array(
    // general ---------------
    'general' => array(
        'type' => 'box',
        'title' => esc_html__('General', 'consult'),
        'wp-customizer-args' => array(
            'priority' => 5,
        ),
        'options' => array(
            // page loader
            'page_loader' => array(
                'type' => 'ht-switch',
                'label' => esc_html__('Enable Page Loader Animation', 'consult'),
                'desc' => esc_html__('This option shows animated page loader', 'consult'),
                'value' => 'no',
            ),
        ),
    ),
    // topbar
    'topbar' => array(
        'type' => 'box',
        'title' => esc_html__('Header', 'consult'),
        'wp-customizer-args' => array(
            'priority' => 10,
        ),
        'options' => array(
        ),
    ),
    // header ---------------
    'c_header' => array(
        'type' => 'box',
        'title' => esc_html__('Page Breadcrumbs', 'consult'),
        'wp-customizer-args' => array(
            'priority' => 15,
        ),
        'options' => array(
            'c_page_header' => array(
                'label' => esc_html__('Page Breadcrumbs', 'consult'),
                'desc' => esc_html__('Enable/Disable page header in all page.', 'consult'),
                'type' => 'ht-switch',
                'value' => 'yes',
            ),
            'c_breadcrumb' => array(
                'label' => esc_html__('Breadcrumb', 'consult'),
                'desc' => esc_html__('Enable/Disable breadcrumb in all page.', 'consult'),
                'type' => 'ht-switch',
                'value' => 'yes',
            ),
        ),
    ),
    // footer ---------------
    'c_footer' => array(
        'type' => 'box',
        'title' => esc_html__('Footer', 'consult'),
        'wp-customizer-args' => array(
            'priority' => 100,
        ),
        'options' => array(
            'c_copyright' => array(
                'type' => 'textarea',
                'label' => esc_html__('Copyright', 'consult'),
                'desc' => esc_html__('Write some text', 'consult'),
                'value' => 'Copyright &#169; 2016 <a href="#">ConsultWP</a>, Developed by <a href="http://themeforest.net/user/haintheme">Haintheme</a>.'
            ),
        ),
    ),
);
