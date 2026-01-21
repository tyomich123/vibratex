<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


$options = array(
	'theme_block' => array(
		'title'   => esc_html__( 'Theme Block', 'vibratex' ),
		'label'   => esc_html__( 'Theme Block', 'vibratex' ),
		'type'    => 'select',
		'choices' => array(
			'none'  => esc_html__( 'Not Assigned', 'vibratex' ),
			'footer'  => esc_html__( 'Footer', 'vibratex' ),
			'before_footer'  => esc_html__( 'Before Footer', 'vibratex' ),
			'subscribe'  => esc_html__( 'Subscribe', 'vibratex' ),
			'top_bar'  => esc_html__( 'Top Bar', 'vibratex' ),
		),
		'value' => 'none',
	)
);


