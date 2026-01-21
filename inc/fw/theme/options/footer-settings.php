<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$vibratex_theme_config = vibratex_theme_config();
$vibratex_sections_list = vibratex_get_sections();

$options = array(
	'footer' => array(
		'title'   => esc_html__( 'Footer', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(

			'footer-box-1' => array(
				'title'   => esc_html__( 'Widgets', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					
					'footer_widgets'    => array(
						'label' => esc_html__( 'Enable Footer Widgets', 'vibratex' ),
						'desc'   => esc_html__( 'Widgets controled in Appearance -> Widgets. Column will be hidden, when no active widgets exist', 'vibratex' ),	
						'type'  => 'checkbox',
						'value'	=> 'true',
					),					
					'footer-parallax'    => array(
						'label' => esc_html__( 'Footer Parallax', 'vibratex' ),
						'type'    => 'select',							
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),						
					'footer_bg'    => array(
						'label' => esc_html__( 'Footer Background', 'vibratex' ),
						'type'  => 'upload',
					),		
					'footer_black_bg'    => array(
						'label' => esc_html__( 'Footer Black Background', 'vibratex' ),
						'type'  => 'upload',
					),						
					'footer-box-1-1' => array(
						'title'   => esc_html__( 'Desktop widgets visibility', 'vibratex' ),
						'type'    => 'box',
						'options' => array(

							'footer_1_hide'    => array(
								'label' => esc_html__( 'Footer 1', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),						
							),
							'footer_2_hide'    => array(
								'label' => esc_html__( 'Footer 2', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),	
							),
							'footer_3_hide'    => array(
								'label' => esc_html__( 'Footer 3', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),	
							),
							'footer_4_hide'    => array(
								'label' => esc_html__( 'Footer 4', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),	
							),
						)
					),
					'footer-box-1-2' => array(
						'title'   => esc_html__( 'Notebook widgets visibility', 'vibratex' ),
						'type'    => 'box',
						'options' => array(

							'footer_1__hide_md'    => array(
								'label' => esc_html__( 'Footer 1', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),						
							),
							'footer_2_hide_md'    => array(
								'label' => esc_html__( 'Footer 2', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),	
							),
							'footer_3_hide_md'    => array(
								'label' => esc_html__( 'Footer 3', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),	
							),
							'footer_4_hide_md'    => array(
								'label' => esc_html__( 'Footer 4', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),	
							),
						)
					),					
					'footer-box-1-3' => array(
						'title'   => esc_html__( 'Mobile widgets visibility', 'vibratex' ),
						'type'    => 'box',
						'options' => array(
							'footer_1_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 1', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),
							),
							'footer_2_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 2', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),
							),
							'footer_3_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 3', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),
							),
							'footer_4_hide_mobile'    => array(
								'label' => esc_html__( 'Footer 4', 'vibratex' ),
								'type'  => 'switch',
								'value'	=> 'show',
								'left-choice' => array(
									'value' => 'hide',
									'label' => esc_html__('Hide', 'vibratex'),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => esc_html__('Show', 'vibratex'),
								),
							),														
						)
					)
				),
			),
			'footer-box-section' => array(
				'title'   => esc_html__( 'Footer Block', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'vibratex' ),
						'type'  => 'html',
					),							
					'footer-section'    => array(
						'label' => esc_html__( 'Footer block', 'vibratex' ),
						'type'    => 'select',
						'choices' => array('' => esc_html__( 'None / Hidden' , 'vibratex' ) ) + $vibratex_sections_list['footer'],						
						'value'	=> '',
					),
			
				),
			),	
			'footer-box-before-footer' => array(
				'title'   => esc_html__( 'Before Footer', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'before-footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'vibratex' ),
						'type'  => 'html',
					),							
					'before-footer-section'    => array(
						'label' => esc_html__( 'Before Footer block', 'vibratex' ),
						'desc' => esc_html__( 'Section displayed before footer blocks. You can hide in on certain page in page settings.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array('' => esc_html__( 'None / Hidden' , 'vibratex' ) ) + $vibratex_sections_list['before_footer'],						
						'value'	=> '',
					),
			
				),
			),			
			'footer-box-subscribe' => array(
				'title'   => esc_html__( 'Subscribe', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'footer-sections'    => array(
						'html' => esc_html__( 'You can edit all items in Sections menu of dashboard.', 'vibratex' ),
						'type'  => 'html',
					),							
					'subscribe-section'    => array(
						'label' => esc_html__( 'Subscribe block', 'vibratex' ),
						'desc' => esc_html__( 'Section displayed before widgets on every page. You can hide in on certain page in page settings.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array('' => esc_html__( 'None / Hidden' , 'vibratex' ) ) + $vibratex_sections_list['subscribe'],
						'value'	=> '',
					),
			
				),
			),		
			'footer-box-2' => array(
				'title'   => esc_html__( 'Go Top', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(															
					'go_top_visibility'    => array(
						'label' => esc_html__( 'Go Top Visibility', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always visible', 'vibratex' ),
							'desktop' => esc_html__( 'Desktop Only', 'vibratex' ),
							'mobile' => esc_html__( 'Mobile Only', 'vibratex' ),
							'hidden' => esc_html__( 'Hidden', 'vibratex' ),
						),						
						'value'	=> 'visible',
					),		
					'go_top_pos'    => array(
						'label' => esc_html__( 'Go Top Position', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'floating'  => esc_html__( 'Floating', 'vibratex' ),
							'static' => esc_html__( 'Static at the footer', 'vibratex' ),
						),						
						'value'	=> 'floating',
					),		
					'go_top_img'    => array(
						'label' => esc_html__( 'Go Top Image', 'vibratex' ),
						'type'  => 'upload',
					),		
					'go_top_icon'    => array(
						'label' => esc_html__( 'Go Top Icon', 'vibratex' ),
						'type'  => 'icon-v2',
					),	
					'go_top_rotate'    => array(
						'label' => esc_html__( 'Rotate Icon', 'vibratex' ),
						'type'  => 'switch',
					),										
					'go_top_text'    => array(
						'label' => esc_html__( 'Go Top Text', 'vibratex' ),
						'type'  => 'text',
					),		
																
				),
			),
			'footer-box-3' => array(
				'title'   => esc_html__( 'Copyrights', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'footer-layout-default'    => array(
						'label' => esc_html__( 'Footer Default Style', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Footer block before copyright. Edited in Widgets menu.', 'vibratex' ),
						'choices' => $vibratex_theme_config['footer'],
						'value' => $vibratex_theme_config['footer-default'],
					),																												
					'copyrights'    => array(
						'label' => esc_html__( 'Copyrights', 'vibratex' ),
						'type'  => 'wp-editor',
					),									
				),
			),					
		),
	),	
);

unset($options['footer']['options']['footer-box-1']);


