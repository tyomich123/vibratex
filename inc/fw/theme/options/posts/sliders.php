<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$schemes =  array();
$schemes['default'] = esc_html__( 'Default', 'vibratex' );

$schemes_ = fw_get_db_settings_option( 'items' );
if ( !empty($schemes_) ) {

	foreach ($schemes_ as $v) {

		$schemes[$v['slug']] = esc_html( $v['name'] );
	}
}


$options = array(
	'main' => array(
		'title'   => 'Additonal',
		'type'    => 'box',
		'options' => array(
			'header-alt' => array(
				'label' => esc_html__( 'Header Short', 'vibratex' ),
				'desc' => esc_html__( 'Used by some types of slider view', 'vibratex' ),
				'type' => 'text',
				'value' => '',
			),			
			'color-scheme'    => array(
				'label' => esc_html__( 'Color Scheme (only for preview)', 'vibratex' ),
				'type'    => 'select',
				'choices' => $schemes,
				'value' => 'default',
			),				
			'mobile_bg' => array(
				'label' => esc_html__( 'Slider Mobile Background', 'vibratex' ),
				'type'  => 'upload',
			),
		),
	),
);

