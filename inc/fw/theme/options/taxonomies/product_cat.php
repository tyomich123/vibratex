<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'header'    => array(
		'label' => esc_html__( 'Alternative Header', 'vibratex' ),
		'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'vibratex' ),
		'type'  => 'text',
	),		
	'bg-color' => array(
		'label'   => esc_html__( 'Background Style', 'vibratex' ),
		'type'    => 'select',
		'choices' => array(
			'default'	=> esc_html__( 'Light', 'vibratex' ),
			'dark'  	=> esc_html__( 'Dark', 'vibratex' ),
		),
		'value' => 'default',
	),
	'icon' => array(
		'label' => esc_html__( 'Icon', 'vibratex' ),
		'type'  => 'icon-v2',
	),	
	'background-image'    => array(
		'label' => esc_html__( 'Page Header Background', 'vibratex' ),
		'desc' => esc_html__( 'Will replace default header image', 'vibratex' ),
		'type'  => 'upload',
	),				
);

