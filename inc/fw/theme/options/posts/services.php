<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(			
			'header'    => array(
				'label' => esc_html__( 'Alternative Header', 'vibratex' ),
				'desc'  => esc_html__( 'Use {{ brackets }} to headlight', 'vibratex' ),
				'type'  => 'text',
			),		
			'cut'    	=> array(
				'label' => esc_html__( 'Short Description', 'vibratex' ),
				'type'  => 'textarea',
			),	
			'image_alt'    => array(
				'label' => esc_html__( 'Alternative Image', 'vibratex' ),
				'desc' => esc_html__( 'Can be used for some shortcodes', 'vibratex' ),
				'type'  => 'upload',
			),			
			'link'    	=> array(
				'label' => esc_html__( 'External Link', 'vibratex' ),
				'desc' 	=> esc_html__( 'Replaces default service link', 'vibratex' ),				
				'type'  => 'text',
			),		
		),
	),
);


