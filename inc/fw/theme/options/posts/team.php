<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'cut'    => array(
				'label' => esc_html__( 'Short Description', 'vibratex' ),
				'type'  => 'textarea',
			),			
			'items' => array(
				'label' => esc_html__( 'Social Icons For List', 'vibratex' ),
				'type' => 'addable-box',
				'value' => array(),
				'box-options' => array(
					'icon' => array(
						'label' => esc_html__( 'Icon', 'vibratex' ),
						'type'  => 'icon-v2',
					),
					'header' => array(
						'label' => esc_html__( 'Header', 'vibratex' ),
						'type' => 'text',
					),					
					'href' => array(
						'label' => esc_html__( 'Link', 'vibratex' ),
						'desc' => esc_html__( 'If needed', 'vibratex' ),
						'type' => 'text',
						'value' => '#',
					),
				),
				'template' => '{{- icon }}',
			),			
		),
	),		
);

