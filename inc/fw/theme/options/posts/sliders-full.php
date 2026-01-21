<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => 'Additional',
		'type'    => 'box',
		'options' => array(
			'header'    => array(
				'label' => esc_html__( 'Alternative Header', 'vibratex' ),
				'desc' => esc_html__( 'Use {{ brackets }} to headlight', 'vibratex' ),
				'type'  => 'text',
			),					
			'button-header'    => array(
				'label' => esc_html__( 'Button Header', 'vibratex' ),
				'type'  => 'text',
			),
			'button-link'    => array(
				'label' => esc_html__( 'Button Link', 'vibratex' ),
				'type'  => 'text',
			),
			'price'    => array(
				'label' => esc_html__( 'Price', 'vibratex' ),
				'desc' => esc_html__( 'Use {{ brackets }} for floating.', 'vibratex' ),
				'type'  => 'text',
			),			
		),
	),
);

