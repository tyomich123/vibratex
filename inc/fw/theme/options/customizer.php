<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$vibratex_cfg = vibratex_theme_config();

$options = array(
    
    'vibratex_customizer' => array(
        'title' => esc_html__('Vibratex Colors', 'vibratex'),
        'position' => 1,
        'options' => array(

            'main_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_main'],
                'label' => esc_html__('Main Color', 'vibratex'),
            ),            
            'second_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_second'],
                'label' => esc_html__('Second Color', 'vibratex'),
            ),                
            'gray_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_gray'],
                'label' => esc_html__('Gray Color', 'vibratex'),
            ),
            'black_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_black'],
                'label' => esc_html__('Black Color', 'vibratex'),
            ),    
                          'white_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_white'],
                'label' => esc_html__('White Color', 'vibratex'),
            ),  
            'red_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_red'],
                'label' => esc_html__('Red Color', 'vibratex'),
            ),
            'green_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_green'],
                'label' => esc_html__('Green Color', 'vibratex'),
            ),            
            'yellow_color' => array(
                'type' => 'color-picker',
                'value' => $vibratex_cfg['color_yellow'],
                'label' => esc_html__('Yellow Color', 'vibratex'),
            ),               
                        
            'navbar_dark_color' => array(
                'type' => 'rgba-color-picker',
                'value' => $vibratex_cfg['navbar_dark'],
                'label' => esc_html__('Navbar Dark Color', 'vibratex'),
            ),      
        ),
    ),
);

