<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

$vibratex_choices =  array();
$vibratex_choices['default'] = esc_html__( 'Default', 'vibratex' );

$vibratex_color_schemes = fw_get_db_settings_option( 'items' );
if ( !empty($vibratex_color_schemes) ) {

	foreach ($vibratex_color_schemes as $v) {

		$vibratex_choices[$v['slug']] = esc_html( $v['name'] );
	}
}

$vibratex_theme_config = vibratex_theme_config();
$vibratex_sections_list = vibratex_get_sections();


$options = array(
	'general' => array(
		'title'   => esc_html__( 'Page settings', 'vibratex' ),
		'type'    => 'box',
		'options' => array(		
			'general-box' => array(
				'title'   => __( 'General Settings', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(

					'margin-layout'    => array(
						'label' => esc_html__( 'Content Margin', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Margins control for content', 'vibratex' ),
						'choices' => array(
							'default'  => esc_html__( 'Top And Bottom', 'vibratex' ),
							'top'  => esc_html__( 'Top Only', 'vibratex' ),
							'bottom'  => esc_html__( 'Bottom Only', 'vibratex' ),
							'top-small'  => esc_html__( 'Top Small', 'vibratex' ),
							'disabled' => esc_html__( 'Margin Removed', 'vibratex' ),
						),
						'value' => 'default',
					),			
					'topbar-layout'    => array(
						'label' => esc_html__( 'Topbar section', 'vibratex' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array('default' => 'Default') + array('hidden' => 'Hidden') + $vibratex_sections_list['top_bar'],						
						'value'	=> 'default',
					),						
					'navbar-layout'    => array(
						'label' => esc_html__( 'Navbar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array( 'default'  	=> esc_html__( 'Default', 'vibratex' ) ) + $vibratex_theme_config['navbar'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'vibratex' ) ),
						'value' => $vibratex_theme_config['navbar-default'],
					),								
					'header-layout'    => array(
						'label' => esc_html__( 'Page Header', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'vibratex' ),
							'disabled' => esc_html__( 'Hidden', 'vibratex' ),
						),
						'value' => 'default',
					),						
					'subscribe-layout'    => array(
						'label' => esc_html__( 'Subscribe Block', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Subscribe block before footer. Can be edited from Sections Menu.', 'vibratex' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'vibratex' ),
							'disabled' => esc_html__( 'Hidden', 'vibratex' ),
						),
						'value' => 'default',
					),		
					'before-footer-layout'    => array(
						'label' => esc_html__( 'Before Footer', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Before footer sections. Edited in Sections menu.', 'vibratex' ),
						'choices' => array(
							'default'  => esc_html__( 'Visible', 'vibratex' ),
							'disabled' => esc_html__( 'Hidden', 'vibratex' ),
						),
						'value' => 'disabled',
					),	
					'footer-layout'    => array(
						'label' => esc_html__( 'Footer', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before footer. Edited in Widgets menu.', 'vibratex' ),
						'choices' => $vibratex_theme_config['footer'] + array( 'disabled'  	=> esc_html__( 'Hidden', 'vibratex' ) ),
						'value' => $vibratex_theme_config['footer-default'],
					),	
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block parallax effect.', 'vibratex' ),
						'choices' => array(
							'default'  => esc_html__( 'Default', 'vibratex' ),
							'disabled' => esc_html__( 'Disabled', 'vibratex' ),
						),
						'value' => 'default',
					),																			
					'color-scheme'    => array(
						'label' => esc_html__( 'Color Scheme', 'vibratex' ),
						'type'    => 'select',
						'choices' => $vibratex_choices,
						'value' => 'default',
					),		
					'body-bg'    => array(
						'label' => esc_html__( 'Background Scheme', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default'  	=> esc_html__( 'Default', 'vibratex' ),
							'black'  	=> esc_html__( 'Black', 'vibratex' ),
						),
						'value' => 'default',
					),														
					'background-image'    => array(
						'label' => esc_html__( 'Full Page Background Image', 'vibratex' ),
						'type'  => 'upload',
						'desc'   => esc_html__( 'Will be used to fill whole page', 'vibratex' ),
					),	
					'subscribe-image'    => array(
						'label' => esc_html__( 'Subscribe Background Image', 'vibratex' ),
						'type'  => 'upload',
					),						
					'direction'    => array(
						'label' => esc_html__( 'Direction', 'vibratex' ),
						'desc'   => esc_html__( 'Used to create certain page with unique text direction', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default'  	=> esc_html__( 'Default', 'vibratex' ),
							'ltr'  		=> esc_html__( 'LTR', 'vibratex' ),
							'rtl'  		=> esc_html__( 'RTL', 'vibratex' ),
						),
						'value' => 'default',
					),																	
				),											
			),	
			'cpt' => array(
				'title'   => esc_html__( 'Blog / Gallery', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(				
					'sidebar-layout'    => array(
						'label' => esc_html__( 'Blog Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden' => esc_html__( 'Hidden', 'vibratex' ),
							'left'  => esc_html__( 'Sidebar Left', 'vibratex' ),
							'right'  => esc_html__( 'Sidebar Right', 'vibratex' ),
						),
						'value' => 'hidden',
					),						
					'blog-layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'vibratex' ),
						'description'   => esc_html__( 'Used only for blog pages.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default'  => esc_html__( 'Default', 'vibratex' ),
							'classic'  => esc_html__( 'One Column', 'vibratex' ),
							'two-cols' => esc_html__( 'Two Columns', 'vibratex' ),
							'three-cols' => esc_html__( 'Three Columns', 'vibratex' ),
						),
						'value' => 'default',
					),
					'gallery-layout'    => array(
						'label' => esc_html__( 'Gallery Layout', 'vibratex' ),
						'description'   => esc_html__( 'Used only for gallery pages.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'vibratex' ),
							'col-2' => esc_html__( 'Two Columns', 'vibratex' ),
							'col-3' => esc_html__( 'Three Columns', 'vibratex' ),
							'col-4' => esc_html__( 'Four Columns', 'vibratex' ),
						),
						'value' => 'default',
					),					
				)
			)	
		)
	),
);

unset($options['general']['options']['general-box']['options']['footer-parallax']);

