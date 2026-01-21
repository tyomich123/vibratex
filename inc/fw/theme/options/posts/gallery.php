<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(	
			'photos' => array(
				'label' => esc_html__( 'Multi Upload', 'vibratex' ),
				'type'  => 'multi-upload',
				),
			),
		),
	);

