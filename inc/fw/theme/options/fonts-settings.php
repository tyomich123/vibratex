<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$vibratex_theme_config = vibratex_theme_config();

$options = array(
	'fonts' => array(
		'title'   => esc_html__( 'Fonts', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(

			'fonts-box' => array(
				'title'   => esc_html__( 'Fonts Settings', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'font-main'                => array(
						'label' => __( 'Main Font', 'vibratex' ),
						'type'  => 'typography-v2',
						'desc'	=>	esc_html__( 'Use https://fonts.google.com/ to find font you need', 'vibratex' ),
						'value'      => array(
							'family'    => $vibratex_theme_config['font_main'],
							'subset'    => 'latin-ext',
							'variation' => $vibratex_theme_config['font_main_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-main-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'vibratex' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "800,900"', 'vibratex' ),
						'type'  => 'text',
						'value'  => $vibratex_theme_config['font_main_weights'],							
					),					
					'font-main-letterspacing'    => array(
						'label' => esc_html__( 'Letter Spacing', 'vibratex' ),
						'desc'  => esc_html__( 'Empty is default', 'vibratex' ),
						'type'  => 'text',
						'value'  => '',
					),													
					'font-headers'                => array(
						'label' => __( 'Headers Font', 'vibratex' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $vibratex_theme_config['font_headers'],
							'subset'    => 'latin-ext',
							'variation' => $vibratex_theme_config['font_headers_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-headers-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'vibratex' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'vibratex' ),
						'type'  => 'text',
						'value'  => $vibratex_theme_config['font_headers_weights'],						
					),
					'font-headers-letterspacing'    => array(
						'label' => esc_html__( 'Letter Spacing', 'vibratex' ),
						'desc'  => esc_html__( 'Empty is default', 'vibratex' ),
						'type'  => 'text',
						'value'  => '-0.5px',
					),																	
					'font-subheaders'                => array(
						'label' => __( 'SubHeaders Font', 'vibratex' ),
						'type'  => 'typography-v2',
						'value'      => array(
							'family'    => $vibratex_theme_config['font_subheaders'],
							'subset'    => 'latin-ext',
							'variation' => $vibratex_theme_config['font_subheaders_var'],
							'size'      => 0,
							'line-height' => 0,
							'letter-spacing' => 0,
							'color'     => '#000'
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false
						),
					),
					'font-subheaders-weights'    => array(
						'label' => esc_html__( 'Additonal weights', 'vibratex' ),
						'desc'  => esc_html__( 'Coma separates weights, for example: "600,800"', 'vibratex' ),
						'type'  => 'text',
						'value'  => $vibratex_theme_config['font_subheaders_weights'],						
					),		
					'font-subheaders-letterspacing'    => array(
						'label' => esc_html__( 'Letter Spacing', 'vibratex' ),
						'desc'  => esc_html__( 'Empty is default', 'vibratex' ),
						'type'  => 'text',
						'value'  => '-0.5px',
					),												
				),
			),
		),
	),	
);

