<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$vibratex_theme_config = vibratex_theme_config();
$vibratex_sections_list = vibratex_get_sections();

$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => esc_html__( 'General Settings', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(						
					'page-loader'    => array(
						'type'    => 'multi-picker',
						'picker'       => array(
							'loader' => array(
								'label'   => esc_html__( 'Page Loader', 'vibratex' ),
								'type'    => 'select',
								'choices' => array(
									'disabled' => esc_html__( 'Disabled', 'vibratex' ),
									'image' => esc_html__( 'Image', 'vibratex' ),
									'spinner' => esc_html__( 'Spinner', 'vibratex' ),
								),
								'value' => 'spinner'
							)
						),						
						'choices' => array(
							'image' => array(
								'loader_img'    => array(
									'label' => esc_html__( 'Page Loader Image', 'vibratex' ),
									'type'  => 'upload',
								),
							),
						),
						'value' => 'enabled',
					),	
					'google_api'    => array(
						'label' => esc_html__( 'Google Maps API Key', 'vibratex' ),
						'desc'  => esc_html__( 'Required for contacts page, also used in widget. In order to use you must generate your own API on Google Maps Platform', 'vibratex' ),
						'type'  => 'text',
					),
					'widgets_block'    => array(
						'label' => esc_html__( 'Enable Block Widgets', 'vibratex' ),
						'type'  => 'switch',
					),						
				),
			),
			'logo' => array(
				'title'   => esc_html__( 'Logo and Media', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(	
					'logo-box' => array(
						'title'   => esc_html__( 'Logo', 'vibratex' ),
						'type'    => 'box',
						'options' => array(			
							'favicon'    => array(
								'html' => esc_html__( 'To change Favicon go to Appearance -> Customize -> Site Identity', 'vibratex' ),
								'type'  => 'html',
							),		
							'advice'    => array(
								'label'	=>	'',
								'html' => esc_html__( 'Unique Homepages could have different colors and logos, which can be changed in Color Schemes.', 'vibratex' ),
								'type'  => 'html',
							),								
				            'logo_big_height' => array(
				                'type'  => 'slider',
				                'value' => $vibratex_theme_config['logo_height'],
				                'properties' => array(

				                    'min' => 0,
				                    'max' => 200,
				                    'step' => 1,

				                ),
				                'label' => esc_html__('Logo Big Max Height, px', 'vibratex'),
				            ),  				
				            'logo_height' => array(
				                'type'  => 'slider',
				                'value' => $vibratex_theme_config['logo_height'],
				                'properties' => array(

				                    'min' => 0,
				                    'max' => 200,
				                    'step' => 1,

				                ),
				                'label' => esc_html__('Logo Max Height, px', 'vibratex'),
				            ),  					            								
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'vibratex' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'vibratex' ),
								'desc'  => esc_html__( 'Used for retina displays. Requires 2x size logo. Can be left empty.', 'vibratex' ),
								'type'  => 'upload',
							),	
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'vibratex' ),
								'type'  => 'upload',
							),
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'vibratex' ),
								'desc'  => esc_html__( 'Used for retina displays.  Requires 2x logo.  Can be left empty.', 'vibratex' ),
								'type'  => 'upload',
							),
							'logo_hide'    => array(
								'label' => esc_html__( 'Hide Logo', 'vibratex' ),
								'type'  => 'switch',
							),								
							'theme-icon-header'    => array(
								'label' => esc_html__( 'Headers icon', 'vibratex' ),
								'type'  => 'icon-v2',
							),
							'theme-icon-main'    => array(
								'label' => esc_html__( 'Widgets Headers icon', 'vibratex' ),
								'type'  => 'icon-v2',
							),						
							'theme-icon-image'    => array(
								'label' => esc_html__( '(or) Widget Header Image', 'vibratex' ),
								'type'  => 'upload',
							),													
							'widgets_bg'    => array(
								'label' => esc_html__( 'Search Widgets Background', 'vibratex' ),
								'type'  => 'upload',
							),
							'sidebar_bg'    => array(
								'label' => esc_html__( 'Sidebar Background', 'vibratex' ),
								'type'  => 'upload',
							),							
							'nav_pattern'    => array(
								'label' => esc_html__( 'Navbar Pattern', 'vibratex' ),
								'type'  => 'upload',
							),						
							'404-img'    => array(
								'label' => esc_html__( '404 Page Image', 'vibratex' ),
								'type'  => 'upload',
							),															
						),
					),
				),
			),				
		),
	),
);

unset($options['general']['options']['logo']['options']['logo-box']['options']['404_bg']);
unset($options['general']['options']['logo']['options']['logo-box']['options']['theme-icon-image']);

