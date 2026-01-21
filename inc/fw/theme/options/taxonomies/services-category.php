<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }



$options = array(
	'subheader' => array(
		'label' => esc_html__( 'Subheader', 'vibratex' ),
		'type'  => 'text',
	),	
	'photo' => array(
		'label' => esc_html__( 'Photo', 'vibratex' ),
		'type'  => 'upload',
	),			
	'icon' => array(
		'label' => esc_html__( 'Icon', 'vibratex' ),
		'type'  => 'icon-v2',
	),				
	'popular' => array(
		'label' => esc_html__( 'Popular', 'vibratex' ),
		'type'  => 'switch',
	),
	'new' => array(
		'label' => esc_html__( 'New', 'vibratex' ),
		'type'  => 'switch',
	),	
);

