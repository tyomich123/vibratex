<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$options = array(
	'social' => array(
		'title'   => esc_html__( 'Social', 'vibratex' ),
		'type'    => 'tab',
		'options' => array(
			'social-box' => array(
				'title'   => esc_html__( 'Social', 'vibratex' ),
				'type'    => 'tab',
				'options' => array(
					'target-social'    => array(
						'label' => esc_html__( 'Open social links in', 'vibratex' ),
						'type'    => 'select',
						'choices' => array(
							'self'  => esc_html__( 'Same window', 'vibratex' ),
							'blank' => esc_html__( 'New window', 'vibratex' ),
						),
						'value' => 'self',
					),		
					'social-header' => array(
                        'label' => esc_html__( 'Social Header', 'vibratex' ),
                        'type' => 'text',
                        'value' => 'Follow us',
                    ),		  
		            'social-icons' => array(
		                'label' => esc_html__( 'Social Icons', 'vibratex' ),
		                'type' => 'addable-box',
		                'value' => array(),
		                'desc' => esc_html__( 'Visible in inner page header', 'vibratex' ),
		                'box-options' => array(
		                    'icon_v2' => array(
		                        'label' => esc_html__( 'Icon', 'vibratex' ),
		                        'type'  => 'icon-v2',
		                    ),
		                    'text' => array(
		                        'label' => esc_html__( 'Text', 'vibratex' ),
		                        'desc' => esc_html__( 'If needed', 'vibratex' ),
		                        'type' => 'text',
		                    ),
		                    'href' => array(
		                        'label' => esc_html__( 'Link', 'vibratex' ),
		                        'type' => 'text',
		                        'value' => '#',
		                    ),		                    
		                ),
                		'template' => '{{- text }}',		                
                    ),								
				),
			),
		),
	),	

);

if ( function_exists('lte_share_buttons_conf') ) {

	$share_links = lte_share_buttons_conf();

	$share_links_options = array();
	if ( !empty($share_links) ) {

		$share_links_options = array(

			'share_icons_hide' => array(
                'label' => esc_html__( 'Hide all share icons block', 'vibratex' ),
                'type'  => 'checkbox',
                'value'	=>	false,
            ),
		);
		foreach ( $share_links as $key => $item ) {

			$state = fw_get_db_settings_option( 'share_icon_' . $key );

			$value = false;
			if ( is_null($state) AND $item['active'] == 1 ) {

				$value = true;
			}

			$share_links_options[] =
			array(
				'share_icon_'.$key => array(
	                'label' => $item['header'],
	                'type'  => 'checkbox',
	                'value'	=>	$value,
	            ),
			);
		}
	}

	$share_links_options['share-add'] = array(

        'label' => esc_html__( 'Custom Share Buttons', 'vibratex' ),
        'type' => 'addable-box',
        'value' => array(),
        'desc' => esc_html__( 'You can use {link} and {title} variables to set url. E.g. "http://www.facebook.com/sharer.php?u={link}"', 'vibratex' ),
        'box-options' => array(
            'icon' => array(
                'label' => esc_html__( 'Icon', 'vibratex' ),
                'type'  => 'icon-v2',
            ),
            'header' => array(
                'label' => esc_html__( 'Header', 'vibratex' ),
                'type' => 'text',
            ),
            'link' => array(
                'label' => esc_html__( 'Link', 'vibratex' ),
                'type' => 'text',
                'value' => '',
            ),		  
            'color' => array(
                'label' => esc_html__( 'Color', 'vibratex' ),
                'type' => 'color-picker',
                'value' => '',
            ),		              
        ),
		'template' => '{{- header }}',		                
    );

	$options['social']['options']['share-box'] = array(
		'title'   => esc_html__( 'Share Buttons', 'vibratex' ),
		'type'    => 'tab',
		'options' => $share_links_options,
	);
}

