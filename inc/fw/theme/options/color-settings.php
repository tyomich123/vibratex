<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$options = array(
	'colors' => array(
		'title'   => esc_html__( 'Colors Schemes', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(			
			'schemes-box' => array(
				'title'   => esc_html__( 'Additional Color Schemes Settings', 'vibratex' ),
				'type'    => 'box',
				'options' => array(
					'advice'    => array(
						'label'	=>	'',
						'html' => esc_html__( 'You also need to change the global settings in Appearance -> Customize -> Vibratex settings', 'vibratex' ),
						'type'  => 'html',
					),	
					'items' => array(
						'label' => esc_html__( 'Theme Color Schemes', 'vibratex' ),
						'type' => 'addable-box',
						'value' => array(),
						'desc' => esc_html__( 'Can be selected in page settings', 'vibratex' ),
						'box-options' => array(
							'slug' => array(
								'label' => esc_html__( 'Scheme ID', 'vibratex' ),
								'type' => 'text',
								'desc' => esc_html__( 'Required Field', 'vibratex' ),
								'value' => '',
							),							
							'name' => array(
								'label' => esc_html__( 'Scheme Name', 'vibratex' ),
								'desc' => esc_html__( 'Required Field', 'vibratex' ),
								'type' => 'text',
								'value' => '',
							),
							'logo'    => array(
								'label' => esc_html__( 'Logo Black', 'vibratex' ),
								'type'  => 'upload',
							),
							'logo_2x'    => array(
								'label' => esc_html__( 'Logo Black 2x', 'vibratex' ),
								'type'  => 'upload',
							),
							'logo_white'    => array(
								'label' => esc_html__( 'Logo White', 'vibratex' ),
								'type'  => 'upload',
							),		
							'logo_white_2x'    => array(
								'label' => esc_html__( 'Logo White 2x', 'vibratex' ),
								'type'  => 'upload',
							),		
							'main-color'  => array(
								'label' => esc_html__( 'Main Color', 'vibratex' ),
								'type'  => 'color-picker',
							),
							'second-color' => array(
								'label' => esc_html__( 'Second Color', 'vibratex' ),
								'type'  => 'color-picker',
							),
							'gray-color' => array(
								'label' => esc_html__( 'Gray Color', 'vibratex' ),
								'type'  => 'color-picker',
							),								
							'black-color' => array(
								'label' => esc_html__( 'Black Color', 'vibratex' ),
								'type'  => 'color-picker',
							),	
							'white-color' => array(
								'label' => esc_html__( 'White Color', 'vibratex' ),
								'type'  => 'color-picker',
							),
						),
						'template' => '{{- name }}',
					),
				),
			),
		),
	),	

);


