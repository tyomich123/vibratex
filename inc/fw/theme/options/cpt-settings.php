<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$options = array(

	'layout' => array(
		'title'   => esc_html__( 'Post Types', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(

			'layout-box-1' => array(
				'title'   => esc_html__( 'Blog Posts', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(

					'blog_layout'    => array(
						'label' => esc_html__( 'Blog Layout', 'vibratex' ),
						'desc'   => esc_html__( 'Default blog page layout.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'classic'  => esc_html__( 'One Column', 'vibratex' ),
							'two-cols' => esc_html__( 'Two Columns', 'vibratex' ),
							'three-cols' => esc_html__( 'Three Columns', 'vibratex' ),
						),
						'value' => 'classic',
					),				
					'blog_list_sidebar'    => array(
						'label' => esc_html__( 'Blog List Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'vibratex' ),
							'left' => esc_html__( 'Left', 'vibratex' ),
							'right' => esc_html__( 'Right', 'vibratex' ),
						),
						'value' => 'right',
					),				
					'blog_post_sidebar'    => array(
						'label' => esc_html__( 'Blog Post Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'vibratex' ),
							'left' => esc_html__( 'Left', 'vibratex' ),
							'right' => esc_html__( 'Right', 'vibratex' ),
						),
						'value' => 'right',
					),																				
					'excerpt_auto'    => array(
						'label' => esc_html__( 'Excerpt Classic Blog Size', 'vibratex' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'vibratex' ),
						'value'	=> 50,
						'type'  => 'short-text',
					),
					'excerpt_masonry_auto'    => array(
						'label' => esc_html__( 'Excerpt Masonry Blog Size', 'vibratex' ),
						'desc'  => esc_html__( 'Automaticly cuts content for blogs', 'vibratex' ),
						'value'	=> 30,
						'type'  => 'short-text',
					),		
					'blog_gallery_autoplay'    => array(
						'label' => esc_html__( 'Gallery post type autoplay, ms', 'vibratex' ),
						'desc'  => esc_html__( 'Set 0 to disable autoplay', 'vibratex' ),
						'type'  => 'text',
						'value' => '4000',
					),						
				)
			),
			'layout-box-2' => array(
				'title'   => esc_html__( 'Services', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(	
					'services_header'    => array(
						'label' => esc_html__( 'Services Header', 'vibratex' ),
						'desc'  => esc_html__( 'Can be used in breadcrumbs and etc.', 'vibratex' ),
						'type'  => 'text',
						'value' => esc_html__( 'Services', 'vibratex' ),
					),						
					'services_slug'    => array(
						'label' => esc_html__( 'Services slug', 'vibratex' ),
						'desc'  => esc_html__( 'After slug change you need to go to the Settings -> Permalinks and click Save Changes.', 'vibratex' ),
						'type'  => 'text',
						'value' => 'services',
					),									
					'services_list_sidebar'    => array(
						'label' => esc_html__( 'Services List Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'vibratex' ),
							'left' => esc_html__( 'Left', 'vibratex' ),
							'right' => esc_html__( 'Right', 'vibratex' ),
						),
						'value' => 'hidden',
					),				
					'services_post_sidebar'    => array(
						'label' => esc_html__( 'Services Post Sidebar', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'hidden'  => esc_html__( 'Hidden', 'vibratex' ),
							'left' => esc_html__( 'Left', 'vibratex' ),
							'right' => esc_html__( 'Right', 'vibratex' ),
						),
						'value' => 'hidden',
					),					
				)
			),
			'layout-box-3' => array(
				'title'   => esc_html__( 'Testomonials', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(	
					'services'    => array(
						'label' => esc_html__( 'Testimonials Header', 'vibratex' ),
						'desc'  => esc_html__( 'Can be used in breadcrumbs and etc.', 'vibratex' ),
						'type'  => 'text',
						'value' => esc_html__( 'Testimonials', 'vibratex' ),
					),						
					'testimonials_slug'    => array(
						'label' => esc_html__( 'Testimonials slug', 'vibratex' ),
						'desc'  => esc_html__( 'After slug change you need to go to the Settings -> Permalinks and click Save Changes.', 'vibratex' ),
						'type'  => 'text',
						'value' => 'testimonials',
					),									
				)
			),			
			'layout-box-4' => array(
				'title'   => esc_html__( 'Gallery', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(													
					'gallery_layout'    => array(
						'label' => esc_html__( 'Default Gallery Layout', 'vibratex' ),
						'desc'   => esc_html__( 'Default galley page layout.', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'col-2' => esc_html__( 'Two Columns', 'vibratex' ),
							'col-3' => esc_html__( 'Three Columns', 'vibratex' ),
							'col-4' => esc_html__( 'Four Columns', 'vibratex' ),
						),
						'value' => 'col-2',
					),						
				)
			)	
		)
	),

);
