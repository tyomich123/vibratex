<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'subheader'    => array(
				'label' => esc_html__( 'Subheader', 'vibratex' ),
				'type'  => 'text',
			),
			'link'    	=> array(
				'label' => esc_html__( 'External Link', 'vibratex' ),
				'desc' 	=> esc_html__( 'Replaces default link', 'vibratex' ),
				'type'  => 'text',
			),					
			'rate'    => array(
				'type'    => 'select',
				'label' => esc_html__( 'Rate', 'vibratex' ),				
				'description'   => esc_html__( 'Null for hidden', 'vibratex' ),
				'choices' => array(
					0,1,2,3,4,5
				),
			),						
			'short'    => array(
				'type'    => 'checkbox',
				'label' => esc_html__( 'Short Testimonial', 'vibratex' ),				
				'description'   => esc_html__( 'Image will be hiddem and layout inverted', 'vibratex' ),
			),				
		),
	),		
);

