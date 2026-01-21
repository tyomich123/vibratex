<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$vibratex_theme_config = vibratex_theme_config();
$vibratex_sections_list = vibratex_get_sections();

$navbar_custom_assign = array();

if ( !empty( $vibratex_theme_config['navbar'] ) AND is_array($vibratex_theme_config['navbar']) AND sizeof( $vibratex_theme_config['navbar']) > 1 ) {

	$menus = get_terms('nav_menu');
	if ( !empty($menus) ) {

		$list = array();
		foreach ( $menus as $item ) {

			$list[$item->term_id] = $item->name;
		}

		foreach ( $vibratex_theme_config['navbar'] as $key => $val) {

			$navbar_custom_assign['navbar-'.$key.'-assign'] = array(
				'label' => sprintf( esc_html__( 'Navbar %s Assign', 'vibratex' ), ucwords($key) ),
				'type'    => 'select',
				'desc' => esc_html__( 'You can assign additional menus for inner navbar.', 'vibratex' ),
				'value' => 'default',
				'choices' => array('default' => esc_html__( 'Default', 'vibratex' )) + $list,
			);
		}

		$navbar_custom_assign = array();
	}
}

$options = array(
	'header' => array(
		'title'   => esc_html__( 'Header', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(
			'header-box-2' => array(
				'title'   => esc_html__( 'Navbar', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'navbar-default'    => array(
						'label' => esc_html__( 'Navbar Default', 'vibratex' ),
						'type'    => 'select',
						'value' => $vibratex_theme_config['navbar-default'],
						'choices' => $vibratex_theme_config['navbar'],
					),	
					'navbar-default-force'    => array(
						'label' => esc_html__( 'Navbar Default Override', 'vibratex' ),
						'desc'   => esc_html__( 'By default every page can have unqiue navbar setting. You can override them here.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled. Every page uses its own settings', 'vibratex' ),
							'force'  => esc_html__( 'Enabled. Override all site pages and use Navbar Default', 'vibratex' ),
						),
						'value' => 'disabled',
					),						
					'navbar-affix'    => array(
						'label' => esc_html__( 'Navbar Sticked', 'vibratex' ),
						'desc'   => esc_html__( 'May not work with all navbar types', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'' => esc_html__( 'Allways Static', 'vibratex' ),
							'affix'  => esc_html__( 'Sticked', 'vibratex' ),
						),
						'value' => '',
					),
					'navbar-breakpoint'    => array(
						'label' => esc_html__( 'Navbar Mobile Breakpoint, px', 'vibratex' ),
						'desc'   => esc_html__( 'Mobile menu will be displayed in viewports below this value', 'vibratex' ),
						'type'    => 'text',
						'value' => '1198',
					),												
					$navbar_custom_assign,
				)
			),
			'header-box-topbar' => array(
				'title'   => esc_html__( 'Topbar', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'topbar-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'You can edit topbar in Sections menu of dashboard (on the left)', 'vibratex' ),
					),					
					'topbar'    => array(
						'label' => esc_html__( 'Topbar visibility', 'vibratex' ),
						'desc'   => esc_html__( 'You can edit topbar layout in Sections menu', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'visible'  => esc_html__( 'Always Visible', 'vibratex' ),
							'desktop'  => esc_html__( 'Desktop Visible', 'vibratex' ),
							'desktop-tablet'  => esc_html__( 'Desktop and Tablet Visible', 'vibratex' ),
							'mobile'  => esc_html__( 'Mobile only Visible', 'vibratex' ),
							'hidden' => esc_html__( 'Hidden', 'vibratex' ),
						),
						'value' => 'hidden',
					),					
					'topbar-section'    => array(
						'label' => esc_html__( 'Topbar section', 'vibratex' ),
						'desc' => esc_html__( 'You can edit it in Sections menu of dashboard.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array('' => 'None / Hidden') + $vibratex_sections_list['top_bar'],						
						'value'	=> '',
					),										
				)
			),			
			'header-box-icons' => array(
				'title'   => esc_html__( 'Icons and Elements', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(		
					'icons-info'    => array(
						'label' => ' ',
						'type'    => 'html',
						'html' => esc_html__( 'Icons can be displayed in topbar using shortcode: [lte-navbar-icons]', 'vibratex' ),
					),																
					'navbar-icons' => array(
		                'label' => esc_html__( 'Navbar Icons', 'vibratex' ),
		                'desc' => esc_html__( 'Displayed on right side of navbars', 'vibratex' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'picker'       => array(
									'type_radio' => array(
										'label'   => esc_html__( 'Type', 'vibratex' ),
										'type'    => 'radio',
										'choices' => array(
											'search' => esc_html__( 'Search', 'vibratex' ),
											'basket'  => esc_html__( 'WooCommerce Cart', 'vibratex' ),
											'profile'  => esc_html__( 'User Profile', 'vibratex' ),
											'social'  => esc_html__( 'Social Icon', 'vibratex' ),
											'button'  => esc_html__( 'Button', 'vibratex' ),
										),
									)
								),
								'choices'      => array(
									'basket'  => array(
										'count'    => array(
											'label' => esc_html__( 'Count Label', 'vibratex' ),
											'type'    => 'select',
											'choices' => array(
												'show' => esc_html__( 'Always show', 'vibratex' ),
												'show-full' => esc_html__( 'Show for non-empty cart', 'vibratex' ),
												'hide'  => esc_html__( 'Hide', 'vibratex' ),
											),
											'value' => 'show',
										),		
										'mini-cart'        => array(
											'label'   => esc_html__( 'Show MiniCart on Hover', 'vibratex' ),
											'type'    => 'switch',
										),																				
									),
									'search'  => array(
										'source'    => array(
											'label' => esc_html__( 'Source', 'vibratex' ),
											'type'    => 'select',
											'choices' => array(
												'default' => esc_html__( 'All Pages', 'vibratex' ),
												'woocommerce'  => esc_html__( 'WooCommerce Products', 'vibratex' ),
											),
											'value' => 'default',
										),												
									),
									'social'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Header', 'vibratex' ),
					                        'type' => 'text',
					                    ),				                    
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'vibratex' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),		
									'button'  => array(
					                    'text' => array(
					                        'label' => esc_html__( 'Header', 'vibratex' ),
					                        'type' => 'text',
					                    ),				                    
					                    'href' => array(
					                        'label' => esc_html__( 'External Link', 'vibratex' ),
					                        'type' => 'text',
					                        'value' => '#',
					                    ),											
									),										
								),
								'show_borders' => false,
							),	  														                	
							'icon-type'        => array(
								'type'         => 'multi-picker',
								'label'        => false,
								'desc'         => false,
								'value'        => array(
									'icon_radio' => 'default',
								),
								'picker'       => array(
									'icon_radio' => array(
										'label'   => esc_html__( 'Icon', 'vibratex' ),
										'type'    => 'radio',
										'choices' => array(
											'default'  => esc_html__( 'Default', 'vibratex' ),
											'fa' => esc_html__( 'Custom', 'vibratex' )
										),
										'desc'    => esc_html__( 'For social icons you need to use FontAwesome in any case.',
											'vibratex' ),
									)
								),
								'choices'      => array(
									'default'  => array(
									),
									'fa' => array(
										'icon_v2'  => array(
											'type'  => 'icon-v2',
											'label' => esc_html__( 'Select Icon', 'vibratex' ),
										),										
									),
								),
								'show_borders' => false,
							),
							'icon-header'        => array(
								'label'   => esc_html__( 'Show Header', 'vibratex' ),
								'type'    => 'switch',
							),		
							'icon-header-text'        => array(
								'label'   => esc_html__( 'Header', 'vibratex' ),
								'type'    => 'text',
							),														
		                ),
                		'template' => '{{- type.type_radio  }}',		                
                    ),
					'hide-navbar-icons'    => array(
						'label' => esc_html__( 'Hide Navbar Icons', 'vibratex' ),
						'desc'    => esc_html__( 'Can be used to display it in topbar only.', 'vibratex' ),						
						'type'  => 'switch',
					),						
					'navbar-add-icons' => array(
		                'label' => esc_html__( 'Navbar Additional Icons', 'vibratex' ),
		                'desc' => esc_html__( 'Displayed additionaly to icons in inner navbars', 'vibratex' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'box-options' => array(
							'type' => array(
								'label'   => esc_html__( 'Type', 'vibratex' ),
								'type'    => 'radio',
								'value'	=>	'social',
								'choices' => array(
									'social'  => esc_html__( 'Social Icon', 'vibratex' ),
									'button'  => esc_html__( 'Button', 'vibratex' ),
								),
							),
				            'text' => array(
		                        'label' => esc_html__( 'Header', 'vibratex' ),
		                        'type' => 'text',
		                    ),				                    
		                    'href' => array(
		                        'label' => esc_html__( 'External Link', 'vibratex' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),
							'icon'  => array(
								'type'  => 'icon-v2',
								'label' => esc_html__( 'Select Icon', 'vibratex' ),
							),
							'inner-only'  => array(
								'type'  => 'switch',
								'label' => esc_html__( 'Display only in inner pages', 'vibratex' ),
							),												
		                ),
                		'template' => '{{- type }} / {{- text }}',		                
                    ),
					'tagline'    => array(
						'label' => esc_html__( 'Header Tagline', 'vibratex' ),
						'desc'  => esc_html__( 'Visible on left side of homepage slider', 'vibratex' ),
						'type'  => 'text',
					),
					'tagline-short'    => array(
						'label' => esc_html__( 'Header Short Tagline', 'vibratex' ),
						'desc'  => esc_html__( 'Visible on left side of inner page header', 'vibratex' ),
						'type'  => 'text',
					),							
				),
			),
			'header-box-1' => array(
				'title'   => esc_html__( 'Page Header H1', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'breadcrubms'    => array(
						'label' => esc_html__( 'Breadcrumbs', 'vibratex' ),
						'html' => esc_html__( 'To hide breadcrubms you can disable Breadcrumbs plugin from plugins menu.', 'vibratex' ),
						'type'  => 'html',
					),						
					'pageheader-display'    => array(
						'label' => esc_html__( 'Page Header Visibility', 'vibratex' ),
						'desc'   => esc_html__( 'Status of Page Header with H1 and Breadcrumbs', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default' => esc_html__( 'Default', 'vibratex' ),
							'disabled'  => esc_html__( 'Force Hidden on all Pages', 'vibratex' ),
						),
						'value' => 'fixed',
					),		
					'pageheader-overlay'    => array(
						'label' => esc_html__( 'Page Header Overlay', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
						),
						'value' => 'enabled',
					),	
					'header_fixed'    => array(
						'label' => esc_html__( 'Background parallax', 'vibratex' ),
						'desc'   => esc_html__( 'Parallax effect requires large images', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'disabled' => esc_html__( 'Disabled', 'vibratex' ),
							'fixed'  => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'fixed',
					),														
					'header-social'    => array(
						'label' => esc_html__( 'Social icons in page header', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'enabled',
					),	
					'header-bg' => array(
						'title'   => esc_html__( 'Header Background', 'vibratex' ),
						'type'    => 'box',
						'options' => array(			
							'header_waves_bg'    => array(
								'label' => esc_html__( 'Page Header Bottom Background', 'vibratex' ),
								'desc'  => esc_html__( 'Waves / Pattern displayed at the bottom of page header', 'vibratex' ),
								'type'  => 'upload',
							),  								
							'header_bg'    => array(
								'label' => esc_html__( 'Page Header Default Background', 'vibratex' ),
								'desc'  => esc_html__( 'Default Page Header for all pages, can be overriden by the settings above', 'vibratex' ),
								'type'  => 'upload',
							),  							
							'featured'    => array(
								'label' => esc_html__( 'Featured Images as Background', 'vibratex' ),
								'type'    => 'checkboxes',						
								'choices' => array(
									'pages'  => esc_html__( 'Pages', 'vibratex' ),
									'posts'  => esc_html__( 'Blog Posts', 'vibratex' ),
									'services'  => esc_html__( 'Services', 'vibratex' ),
//									'learnpress'  => esc_html__( 'LearnPress', 'vibratex' ),
									'woocommerce'  => esc_html__( 'WooCommerce Products', 'vibratex' ),
									'woocommerce-cat'  => esc_html__( 'WooCommerce Categories / Tags', 'vibratex' ),
								),
							    'value' => array(
							        'pages' => true,
							    ),								
							),										
							'wc-bg'    => array(
								'label' => '',
								'html' => esc_html__( 'To set separate default background for WooCommerce pages assign it to the Pages -> Shop as Featured Image', 'vibratex' ),
								'type'  => 'html',
							),												
							'wc-bg-2'    => array(
								'label' => '',
								'html' => esc_html__( 'Note: WooCommerce Products and Categories have additional "Page Header Background" field, which may override header background', 'vibratex' ),
								'type'  => 'html',
							),								
						)
					),
				),
			),
		),
	),	
);

unset($options['header']['options']['header-box-icons']['options']['tagline']);
unset($options['header']['options']['header-box-1']['options']['header-bg']['options']['header_waves_bg']);

