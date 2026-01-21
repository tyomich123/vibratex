<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$options = array(
	'main' => array(
		'title'   => 'LTE Post Format',
		'type'    => 'box',
		'options' => array(
			'gallery'    => array(
				'label' => esc_html__( 'Gallery', 'vibratex' ),
				'desc' => esc_html__( 'Upload featured images for slider gallery post type', 'vibratex' ),
				'type'  => 'multi-upload',
			),				
		),
	),
);

