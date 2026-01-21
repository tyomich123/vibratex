<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }


$options = array(
	'woocommerce-box' => array(
		'title'   => esc_html__( 'WooCommerce', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(

			'wc-layout' => array(
				'title'   => esc_html__( 'Layout', 'vibratex' ),
				'type'    => 'box',
				'options' => array(	

					'wc_product_style'    => array(
						'label' => esc_html__( 'Product Style ', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'default'	=>	esc_html__( 'Default', 'vibratex'),
						),
						'value' => 'default',
					),				
					'shop_list_sidebar'    => array(
						'label' => esc_html__( 'Archive List Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'vibratex' ),
							'left' => esc_html__( 'Left', 'vibratex' ),
							'right' => esc_html__( 'Right', 'vibratex' ),
						),
						'value' => 'left',
					),				
					'shop_post_sidebar'    => array(
						'label' => esc_html__( 'Single Product Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'vibratex' ),
							'left' => esc_html__( 'Left', 'vibratex' ),
							'right' => esc_html__( 'Right', 'vibratex' ),
						),
						'value' => 'hidden',
					),
					'shop_page_width'    => array(
						'label' => esc_html__( 'Pages Width', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Assigned only to WooCommerce pages without sidebar on large resoltion', 'vibratex' ),
						'choices' => array(
							'narrow' => esc_html__( 'Narrow', 'vibratex' ),
							'full'  => esc_html__( 'Full', 'vibratex' ),
						),
						'value' => 'narrow',
					),						
				),	
			),			
			'wc-products' => array(
				'title'   => esc_html__( 'Products', 'vibratex' ),
				'type'    => 'box',
				'options' => array(	

					'excerpt_wc_auto'    => array(
						'label' => esc_html__( 'Excerpt WooCommerce Size, words', 'vibratex' ),
						'desc'  => esc_html__( 'Automaticly cuts description for products', 'vibratex' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),		
					'wc_zoom'    => array(
						'label' => esc_html__( 'WooCommerce Product Hover Zoom', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Enables mouse hover zoom in single product page', 'vibratex' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),
					'wc_hover_gallery'    => array(
						'label' => esc_html__( 'Hover Gallery Photo ', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Display first gallery image on product list hover', 'vibratex' ),
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),					
					'wc_per_page'    => array(
						'label' => esc_html__( 'Products per Page', 'vibratex' ),
						'type'  => 'text',
						'value' => '6',
					),
					'wc_show_list_excerpt'    => array(
						'label' => esc_html__( 'Display Excerpt in Shop List', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),					
					'wc_show_list_attr'    => array(
						'label' => esc_html__( 'Display Attributes in Shop List', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),
					'wc_show_more'    => array(
						'label' => esc_html__( 'Display Read More', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),					
					'wc_new_days'    => array(
						'label' => esc_html__( 'Number of days to display New label. Set 0 to hide.', 'vibratex' ),
						'type'  => 'text',
						'value' => '30',
					),							
				),
			),
			'wc-cols' => array(
				'title'   => esc_html__( 'Products per Column', 'vibratex' ),
				'type'    => 'box',
				'options' => array(	
					'wc_info'    => array(
						'label'	=> '',
						'html' => esc_html__( 'These settings override default WooCommerce settings for Products Archive page. Empty values are using previous value.', 'vibratex' ),
						'type'  => 'html',
					),		
					'wc_columns_xl'    => array(
						'label' => esc_html__( 'Extra Large Desktop, 1600px', 'vibratex' ),
						'type'  => 'select',
						'choices' => [1 => 1,2,3,4,5,6],
						'value' => 3,
					),
					'wc_columns_lg'    => array(
						'label' => esc_html__( 'Large Desktop, 1200px', 'vibratex' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => '',
					),
					'wc_columns_md'    => array(
						'label' => esc_html__( 'Notebook, 1000px', 'vibratex' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => '',
					),
					'wc_columns_sm'    => array(
						'label' => esc_html__( 'Tablet, 768px', 'vibratex' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => 2,
					),
					'wc_columns_ms'    => array(
						'label' => esc_html__( 'Horizontal Mobile, 480px', 'vibratex' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => '',
					),
					'wc_columns_xs'    => array(
						'label' => esc_html__( 'Mobile', 'vibratex' ),
						'type'  => 'select',
						'choices' => [0 => '', 1,2,3,4,5,6],
						'value' => 1,
					),					
				),
			),
			'wc-additional' => array(
				'title'   => esc_html__( 'Additional', 'vibratex' ),
				'type'    => 'box',
				'options' => array(	
					'wc_related'    => array(
						'label' => esc_html__( 'Related Products Block', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Displayed on Single Product Page', 'vibratex' ),						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'enabled',
					),
					'wc_related_total'    => array(
						'label' => esc_html__( 'Related Products Total', 'vibratex' ),
						'type'    => 'text',
						'value' => '3',
					),
					'wc_related_columns'    => array(
						'label' => esc_html__( 'Related Products Columns', 'vibratex' ),
						'type'    => 'text',
						'value' => '3',
					),										
					'wc_cross_sell'    => array(
						'label' => esc_html__( 'Cross Sell Block', 'vibratex' ),
						'type'    => 'select',
						'desc'   => esc_html__( 'Displayed on Cart Page', 'vibratex' ),						
						'choices' => array(
							'disabled'  => esc_html__( 'Disabled', 'vibratex' ),
							'enabled' => esc_html__( 'Enabled', 'vibratex' ),
						),
						'value' => 'disabled',
					),
					'wc_cross_sells_total'    => array(
						'label' => esc_html__( 'Cross Sell Products Total', 'vibratex' ),
						'type'    => 'text',
						'value' => '2',
					),					
					
				),
			),			
		)
	),
);


