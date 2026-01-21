<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => 'Additional',
		'type'    => 'box',
		'options' => array(
			'image_alt'    => array(
				'label' => esc_html__( 'Alternative Image', 'vibratex' ),
				'desc' => esc_html__( 'Can be used for some shortcodes', 'vibratex' ),
				'type'  => 'upload',
			),
			'header-background-image'    => array(
				'label' => esc_html__( 'Page Header Background', 'vibratex' ),
				'desc' => esc_html__( 'Will replace default header image', 'vibratex' ),
				'type'  => 'upload',
			),				
		),
	),
);

