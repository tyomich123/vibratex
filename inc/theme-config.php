<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Configuration and Custom CSS initializtion
 */

/**
 * Global theme config for header/footer/sections/colors/fonts
 */
if ( !function_exists('vibratex_theme_config') ) {

	add_filter( 'lte_get_theme_config', 'vibratex_theme_config', 10, 1 );
	function vibratex_theme_config() {

	    return array(
	    	/**
	    	 * Format of navbar
	    	 * layout-navbar-class-color
	    	 * color represents the text/links/icons color (black/white)
	    	 */
	    	'navbar'	=>	array(
				'default-black'  						=> esc_html__( 'Classic Light', 'vibratex' ),
				'default-white'  						=> esc_html__( 'Classic Dark', 'vibratex' ),
				'transparent-black'  					=> esc_html__( 'Classic Semi-Transparent on Light', 'vibratex' ),
				'transparent-white'  					=> esc_html__( 'Classic Semi-Transparent on Dark', 'vibratex' ),
				'transparent-full-black'  				=> esc_html__( 'Classic Transparent on Light', 'vibratex' ),
				'transparent-full-white'  				=> esc_html__( 'Classic Transparent on Dark', 'vibratex' ),
				'desktop-center-black'  				=> esc_html__( 'Logo Centered on Light', 'vibratex' ),				
				'desktop-center-white'  				=> esc_html__( 'Logo Centered on Dark', 'vibratex' ),				
				'desktop-center-transparent-black'  	=> esc_html__( 'Logo Centered Transparent on Light', 'vibratex' ),				
				'desktop-center-transparent-white'  	=> esc_html__( 'Logo Centered Transparent on Dark', 'vibratex' ),

			),
			'navbar-default' => 'default-black',

			'footer' => array(
				'default'  => esc_html__( 'Default', 'vibratex' ),		
				'copyright'  => esc_html__( 'Copyright Only', 'vibratex' ),
				'copyright-transparent'  => esc_html__( 'Copyright Transparent', 'vibratex' ),						
			),
			'footer-default' => 'default',

			'color_main'	=>	'#E3092F',
			'color_second'	=>	'#E3092F',
			'color_gray'	=>	'#F5EEE4',
			'color_black'	=>	'#101010',
			'color_white'	=>	'#FFFFFF',
			'color_red'		=>	'#E3092F',
			'color_green'	=>	'#5B9B37',
			'color_yellow'	=>	'#F8BC26',
			
			'color_main_header'	=>	esc_html__( 'Red', 'vibratex' ),

			'logo_height'		=>	54,
			'navbar_dark'		=>	'rgba(0,0,0,0.75)',

			'font_main'					=>	'Open Sans',
			'font_main_var'				=>	'regular',
			'font_main_weights'			=>	'400,400i,700,700i',
			'font_headers'				=>	'Lilita One',
			'font_headers_var'			=>	'900',
			'font_headers_weights'		=>	'',
			'font_subheaders_system'	=>	'',
			'font_subheaders'			=>	'',
			'font_subheaders_var'		=>	'',
			'font_subheaders_weights'	=>	'',
		);
	}
}

/**
 *  Editor Settings
 */
function vibratex_editor_settings() {

	$cfg = vibratex_theme_config();

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Main', 'vibratex' ),
            'slug' => 'main-theme',
            'color' => $cfg['color_main'],
        ),
        array(
            'name' => esc_html__( 'Gray', 'vibratex' ),
            'slug' => 'gray',
            'color' => $cfg['color_gray'],
        ),
        array(
            'name' => esc_html__( 'Black', 'vibratex' ),
            'slug' => 'black',
            'color' => $cfg['color_black'],
        ),    
        array(
            'name' => esc_html__( 'Pale Pink', 'vibratex' ),
            'slug' => 'pale-pink',
            'color' => '#f78da7',
        ),                
    ) );

	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => esc_html__( 'small', 'vibratex' ),
			'shortName' => esc_html__( 'S', 'vibratex' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => esc_html__( 'regular', 'vibratex' ),
			'shortName' => esc_html__( 'M', 'vibratex' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => esc_html__( 'large', 'vibratex' ),
			'shortName' => esc_html__( 'L', 'vibratex' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );    
}
add_action( 'after_setup_theme', 'vibratex_editor_settings', 10 );

/**
 * Get Google default font url
 */
if ( !function_exists('vibratex_font_url') ) {

	function vibratex_font_url() {

		$cfg = vibratex_theme_config();
		$q = array();
		foreach ( array('font_main', 'font_headers', 'font_subheaders') as $item ) {

			if ( !empty($cfg[$item]) ) {

				$w = '';
				if ( !empty($cfg[$item.'_weights']) ) {

					$w .= ':'.$cfg[$item.'_weights'];
				}
				$q[] = $cfg[$item].$w;
			}
		}

		$query_args = array( 'family' => implode('%7C', $q), 'subset' => 'latin' );

		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		return esc_url( $font_url );
	}
}

/**
 * Config used for lt-ext plugin to set Visual Composer configuration
 */
if ( !function_exists('vibratex_vc_config') ) {

	add_filter( 'lte_elementor_config', 'vibratex_elementor_config', 10, 1 );
	function vibratex_elementor_config( $value ) {

	    return array(
	    	'sections'	=>	array(
			),
			'background' => array(
				"main" 		=>	esc_html__( "Main", 'vibratex' ),	
				"second"	=>	esc_html__( "Second", 'vibratex' ),	
				"black"		=>	esc_html__( "Black", 'vibratex' ),
				"gray"		=>	esc_html__( "Gray", 'vibratex' ),
				"white"		=>	esc_html__( "White", 'vibratex' ),
			),
			'overlay'	=> array(
				"semi-black"	=>	esc_html__( "Semi-Black Overlay (30%)", 'vibratex' ),
				"black"			=>	esc_html__( "Black Overlay (40%)", 'vibratex' ),
				"dark"			=>	esc_html__( "Dark Overlay (60%)", 'vibratex' ),
				"semi-dark"		=>	esc_html__( "Semi Dark Overlay (90%)", 'vibratex' ),
				"gradient-hor"	=>	esc_html__( "Horizontal Gradient", 'vibratex' ),			
				"white"			=>	esc_html__( "White Overlay (40%)", 'vibratex' ),
			),
		);
	}
}


/*
* Adding additional TinyMCE options
*/
if ( !function_exists('vibratex_mce_before_init_insert_formats') ) {

	add_filter('mce_buttons_2', 'vibratex_wpb_mce_buttons_2');
	function vibratex_wpb_mce_buttons_2( $buttons ) {

	    array_unshift($buttons, 'styleselect');
	    return $buttons;
	}

	add_filter( 'tiny_mce_before_init', 'vibratex_mce_before_init_insert_formats' );
	function vibratex_mce_before_init_insert_formats( $init_array ) {  

	    $style_formats = array(

	        array(  
	            'title' => esc_html__('Main Color', 'vibratex'),
	            'block' => 'span',  
	            'classes' => 'color-main',
	            'wrapper' => true,
	        ),  
	        array(  
	            'title' => esc_html__('White Color', 'vibratex'),
	            'block' => 'span',  
	            'classes' => 'color-white',
	            'wrapper' => true,   
	        ),        
	        array(  
	            'title' => esc_html__('Medium Text', 'vibratex'),
	            'block' => 'span',  
	            'classes' => 'text-md',
	            'wrapper' => true,   
	        ),
	        array(  
	            'title' => esc_html__('Large Text', 'vibratex'),
	            'block' => 'span',  
	            'classes' => 'text-lg',
	            'wrapper' => true,   
	        ),	  	        
	        array(  
	            'title' => esc_html__('Checkbox List', 'vibratex'),
	            'selector' => 'ul',  
	            'classes' => 'check',
	        ),		        
	    );  
	    $init_array['style_formats'] = json_encode( $style_formats );  
	     
	    return $init_array;  
	} 
}


/**
 * Register widget areas.
 *
 */
if ( !function_exists('vibratex_action_theme_widgets_init') ) {

	add_action( 'widgets_init', 'vibratex_action_theme_widgets_init' );
	function vibratex_action_theme_widgets_init() {

		$span_class = 'widget-icon';

		$header_class = $theme_icon = '';
		if ( function_exists('FW') ) {

			$theme_icon = fw_get_db_settings_option( 'theme-icon-main' );
			if ( !empty($theme_icon['icon-class']) ) {

				$header_class = 'hasIcon';
				$span_class .=  ' ' . $theme_icon['icon-class'];
			}
		}
			else {

			$span_class = '';
		}

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Default', 'vibratex' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'vibratex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="lte-sidebar-header"><h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar WooCommerce', 'vibratex' ),
			'id'            => 'sidebar-wc',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'vibratex' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="lte-sidebar-header"><h3 class="lte-header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '</h3></div>',
		) );
	}
}



/**
 * Additional styles init
 */
if ( !function_exists('vibratex_css_style') ) {

	add_action( 'wp_enqueue_scripts', 'vibratex_css_style', 10 );
	function vibratex_css_style() {

		global $wp_query;

		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), '1.0' );

		wp_enqueue_style( 'vibratex-theme-style', get_stylesheet_uri(), array( 'bootstrap' ), wp_get_theme()->get('Version') );
	}
}



/**
 * Wp-admin styles and scripts
 */
if ( !function_exists('vibratex_admin_init') ) {

	add_action( 'after_setup_theme', 'vibratex_admin_init' );
	function vibratex_admin_init() {

		add_action("admin_enqueue_scripts", 'vibratex_admin_scripts');
	}

	function vibratex_admin_scripts() {

		if ( function_exists('fw_get_db_settings_option') ) {

			vibratex_get_fontello_generate(true);
		}
	}
}



