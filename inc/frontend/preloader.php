<?php

function preloader_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'polishe',
	);

	$panels = array(

	);

	$sections = array(
		'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'polishe' ),
			'description' => '',
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		),
	);

	$fields = array(	
        /* preloader */
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'polishe' ),
            'section'     => 'preload_section',
            'default'     => 0,
            'priority'    => 10,
        ),
        'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'polishe' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.svg',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Width', 'polishe' ),
            'section'  => 'preload_section',
            'default'  => 180,
            'priority' => 12,
            'choices'   => array(
                'min'  => 0,
                'max'  => 400,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Height', 'polishe' ),
            'section'  => 'preload_section',
            'default'  => 50,
            'priority' => 13,
            'choices'   => array(
                'min'  => 0,
                'max'  => 200,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Percent Text Color', 'polishe' ),
            'section'  => 'preload_section',
            'default'  => '#ffffff',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'polishe' ),
            'section'  => 'preload_section',
            'default'  => '#0a0f2b',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Percent Preload Font', 'polishe' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Roboto',
                'variant'        => 'regular',
                'font-size'      => '13px',
                'line-height'    => '40px',
                'letter-spacing' => '2px',
                'subsets'        => array( 'latin-ext' ),                
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_logo .royal_preloader_percentage',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
	);

	$settings['panels']   = apply_filters( 'polishe_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'polishe_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'polishe_customize_fields', $fields );

	return $settings;
}

$polishe_customize = new Polishe_Customize( preloader_customize_settings() );

if( polishe_get_option('preload') != false ){

    function polishe_body_classes( $classes ) {

    	$classes[] = 'royal_preloader';

    	return $classes;
    }
    add_filter( 'body_class', 'polishe_body_classes' );

    function polishe_preload_body_open_script() {
        echo '<div id="royal_preloader" data-width="'.polishe_get_option('preload_logo_width').'" data-height="'.polishe_get_option('preload_logo_height').'" data-url="'.polishe_get_option('preload_logo').'" data-color="'.polishe_get_option('preload_text_color').'" data-bgcolor="'.polishe_get_option('preload_bgcolor').'"></div>';
        
    }
    add_action( 'wp_body_open', 'polishe_preload_body_open_script' );

    function polishe_preload_scripts() {
    	wp_enqueue_style('polishe-preload', get_template_directory_uri().'/css/royal-preload.css');
    }
    add_action( 'wp_enqueue_scripts', 'polishe_preload_scripts' );

}