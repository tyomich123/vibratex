<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Generating inline css styles for customization
 */

if ( !function_exists('vibratex_generate_css') ) {

	function vibratex_generate_css() {

		global $wp_query;

		include get_template_directory() . '/inc/theme-style/google-fonts.php';		

		// List of attributes
		$css = array(
			'main_color' 			=> true,
			'second_color' 			=> true,			
			'gray_color' 			=> true,
			'white_color' 			=> true,
			'black_color' 			=> true,			
			'red_color' 			=> true,			
			'green_color' 			=> true,			
			'yellow_color' 			=> true,			

			'nav_bg' 				=> true,
			'nav_opacity_top' 		=> true,
			'nav_opacity_scroll'	=> true,

			'border_radius' 		=> true,
		);

		// Escaping all the attributes
		$css_rgb = array();
		foreach ($css as $key => $item) {

			$css[$key] = esc_attr(fw_get_db_customizer_option($key));
			$css_rgb[$key] = sscanf(esc_attr(fw_get_db_customizer_option($key)), "#%02x%02x%02x");
		}

		// Setting different color scheme for page
		if ( function_exists( 'FW' ) ) {

			$vibratex_color_schemes = array();
			$vibratex_color_schemes_ = fw_get_db_settings_option( 'items' );

			if ( !empty($vibratex_color_schemes_) ) {
				
				foreach ($vibratex_color_schemes_ as $v) {

					$vibratex_color_schemes[$v['slug']] = $v;
				}			
			}
		}

		$vibratex_current_scheme =  apply_filters('vibratex_current_scheme', array());	
		if ($vibratex_current_scheme == 'default' OR empty($vibratex_current_scheme)) $vibratex_current_scheme = 1;

		if ( function_exists( 'FW' ) AND !empty($vibratex_current_scheme) ) {

			foreach (array(
					'main_color' => 'main-color',
					'second_color' => 'second-color',
					'gray_color' => 'gray-color',
					'black_color' => 'black-color') as $k => $v) {

				if ( !empty($vibratex_color_schemes[$vibratex_current_scheme][$v]) ) {

					$css[$k] = esc_attr($vibratex_color_schemes[$vibratex_current_scheme][$v]);
					$css_rgb[$k] = sscanf(esc_attr($vibratex_color_schemes[$vibratex_current_scheme][$v]), "#%02x%02x%02x");
				}
			}
		}


		$css['black_darker_color'] = vibratex_adjust_brightness($css['black_color'], -50);
		$css['main_darker_color'] = vibratex_adjust_brightness($css['main_color'], -30);
		$css['main_lighter_color'] = vibratex_adjust_brightness($css['main_color'], 30);

		$css = vibratex_get_google_fonts($css);		

		$theme_style = "";

		$theme_style .= "
			:root {
			  --main:   {$css['main_color']} !important;
			  --second:   {$css['second_color']} !important;
			  --gray:   {$css['gray_color']} !important;
			  --black:  {$css['black_color']} !important;
			  --white:  {$css['white_color']} !important;
			  --red:   {$css['red_color']} !important;
			  --yellow:   {$css['yellow_color']} !important;
			  --green:   {$css['green_color']} !important;";

			  foreach ( array('font-main', 'font-headers', 'font-subheaders') as $font ) {

			  	if ( !empty($css[$font]) ) {  		

					if ( $font == 'font-subheaders' ) {

				  		$theme_style .= "--font-subheaders: '{$css[$font]}' !important;";
					}
						else {

				  		$theme_style .= "--".$font.": '{$css[$font]}' !important;";
					}
					
			  		$letter_spacing = fw_get_db_settings_option( $font . '-letterspacing' );
			  		if ( !empty($letter_spacing) ) {

			  			$theme_style .= "--".$font."-letterspacing: ".esc_attr($letter_spacing).";";
			  		}
			  	}
			  }

		$theme_style .= "			  
			}		
		";


		/**
		 * Theme Specific inline styles
		 */
		if ( function_exists( 'FW' ) ) {

			$header_waves_bg = fw_get_db_settings_option( 'header_waves_bg' );
			if ( !empty($header_waves_bg) ) {

				$theme_style .= '.lte-page-header:after { background-image: url(' . esc_url( $header_waves_bg['url'] ) . ') !important; } ';
			}

			// Default Header
			$header_bg = fw_get_db_settings_option( 'header_bg' );

			if ( !empty($header_bg) ) {

				$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $header_bg['url'] ) . ') !important; } ';
			}

			$current_background = get_the_post_thumbnail_url( $wp_query->get_queried_object_id(), 'full');
			$featured = fw_get_db_settings_option( 'featured' );

			if ( vibratex_is_wc('woocommerce') ) {

				$wc_background = get_the_post_thumbnail_url( wc_get_page_id( 'shop' ), 'full' );

				if ( !empty($wc_background) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $wc_background ) . ') !important; } ';;
				}
			}	

			if ( !empty($featured) ) {

				foreach ( $featured as $item => $val ) {

					if ( ( $item == 'posts' AND get_post_type() == 'post' AND !empty( $current_background ) ) OR
						 ( $item == 'pages' AND get_post_type() == 'page' AND !empty( $current_background ) ) OR
						 ( $item == 'services' AND get_post_type() == 'services' AND !empty( $current_background ) )
					   ) {

						$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $current_background ) . ') !important; } ';
					}
		
					if ( $item == 'woocommerce' AND vibratex_is_wc('product') AND !empty( $current_background ) ) {

						$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $current_background ) . ') !important; } ';
					}							
		
					if ( $item == 'woocommerce-cat' AND (vibratex_is_wc('product_category') OR vibratex_is_wc('product_tag')) ) {

						$cat = $wp_query->get_queried_object();
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id , 'full' );
						$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $image ) . ') !important; } ';
					}								
				}
			}

			if ( vibratex_is_wc('product_category') ) {

				$wc_alt_bg = fw_get_db_term_option( $wp_query->get_queried_object_id(), 'product_cat', 'background-image' );
				if ( !empty($wc_alt_bg) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $wc_alt_bg['url'] ) . ') !important; } ';
				}
			}

			if ( vibratex_is_wc('product') ) {

				$wc_alt_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'header-background-image' );
				if ( !empty($wc_alt_bg) ) {

					$theme_style .= '.lte-page-header { background-image: url(' . esc_url( $wc_alt_bg['url'] ) . ') !important; } ';
				}
			}


			if ( is_singular( 'sliders' ) ) {

				$theme_style .= '.lte-slider-preview .elementor-section-wrap:first-child { background-image: url(' . esc_url( get_the_post_thumbnail_url( $wp_query->get_queried_object_id(), 'full') ) . ') !important; } ';
			}

			$body_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'background-image' );
			if (! empty( $body_bg ) ) {

				$theme_style .= '.lte-content-wrapper { background-image: url(' . esc_url( $body_bg['url'] ) . ') !important; background-color: transparent !important; } ';
			}


			$body_color_ = fw_get_db_settings_option( 'body-bg' );
			$body_color_page = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'body-bg' );
			if ( !empty($body_color_page) AND $body_color_page != 'default' ) {

				$body_color = $body_color_page;
			}

			if  ( !empty($body_color) AND $body_color == 'main' ) {

				$footer_bg = fw_get_db_settings_option( 'footer_black_bg' );
			}
				else {

				$footer_bg = fw_get_db_settings_option( 'footer_bg' );
			}


			if (! empty( $footer_bg ) ) {

				$theme_style .= '.lte-footer-wrapper:before { background-image: url(' . esc_url( $footer_bg['url'] ) . ') !important; } ';
			}

			$overlay_bg = fw_get_db_settings_option( 'overlay_bg' );
			if ( !empty( $overlay_bg) ) {
				
				$theme_style .= '.lte-overlay-gray-bg:after { background-image: url(' . esc_url( $overlay_bg['url'] ) . ') !important; } ';				
			}
			

			$widgets_bg = fw_get_db_settings_option( 'widgets_bg' );
			if (! empty( $widgets_bg ) ) {

				$theme_style .= '#content-sidebar .widget_search, #content-sidebar .widget_product_search { background-image: url(' . esc_url( $widgets_bg['url'] ) . ') !important; } ';
			}

			$sidebar_bg = fw_get_db_settings_option( 'sidebar_bg' );
			if (! empty( $sidebar_bg ) ) {

				$theme_style .= '.woocommerce-MyAccount-navigation, .widget-area { background-image: url(' . esc_url( $sidebar_bg['url'] ) . ') !important; } ';
			}

			$nav_pattern = fw_get_db_settings_option( 'nav_pattern' );
			if (! empty( $nav_pattern ) ) {

				$theme_style .= '#lte-nav-wrapper.lte-layout-pattern .lte-navbar { background-image: url(' . esc_url( $nav_pattern['url'] ) . ') !important; } ';
			}

			$theme_icon = fw_get_db_settings_option( 'theme-icon-image' );
			if (! empty( $theme_icon ) ) {

				$theme_style .= '#content-sidebar .lte-sidebar-header .widget-icon { background-image: url(' . esc_url( $theme_icon['url'] ) . ') !important; } ';
			}

			$go_top_img = fw_get_db_settings_option( 'go_top_img' );
			if (! empty( $go_top_img ) ) {

				$theme_style .= '.go-top:before { background-image: url(' . esc_url( $go_top_img['url'] ) . ') !important; } ';
			}

			$nav_color = fw_get_db_customizer_option('navbar_dark_color');
			if ( isset($nav_color) ) {

				$theme_style .= '#nav-wrapper.lte-layout-transparent .lte-navbar.dark.affix { background-color: '.esc_attr($nav_color).' !important; } ';
			}

			$logo_height = fw_get_db_settings_option('logo_height');
			if ( !empty($logo_height) ) {

				$theme_style .= '.lte-logo img { max-height: '.esc_attr($logo_height).'px !important; } ';
			}

			$logo_big_height = fw_get_db_settings_option('logo_big_height');
			if ( !empty($logo_big_height) ) {

				$theme_style .= '.lte-layout-desktop-center-transparent .lte-navbar .lte-logo img { max-height: '.esc_attr($logo_big_height).'px !important; } ';
			}			

			$body_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'background-image' );
			if (! empty( $body_bg ) ) {

				$theme_style .= '.lte-content-wrapper { background-image: url(' . esc_url( $body_bg['url'] ) . ') !important; background-color: transparent !important; } ';
			}

			$sub_bg = fw_get_db_settings_option( 'subscribe-image' );
			$sub_bg_child = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'subscribe-image' );
			if ( !empty($sub_bg_child) ) {

				$sub_bg = $sub_bg_child;
			}
			if (! empty( $sub_bg ) ) {

				$theme_style .= '.subscribe-wrapper { background-image: url(' . esc_url( $sub_bg['url'] ) . ') !important; background-color: transparent !important; } ';
			}

			$pace = fw_get_db_settings_option( 'page-loader' );
			if ( !empty($pace) AND !empty($pace['image']) AND !empty($pace['image']['loader_img'])) {

				wp_add_inline_style( 'vibratex-theme-style', '.paceloader-image .pace-image { background-image: url(' . esc_attr( $pace['image']['loader_img']['url'] ) . ') !important; } ' );
			}

			$inline_style = vibratex_get_inline_style();
			if ( !empty($inline_style) ) {

				wp_add_inline_style( 'vibratex-theme-style', $inline_style );
			}

			vibratex_fa_init();
		}

		$theme_style = str_replace( array( "\n", "\r" ), '', $theme_style );

		return $theme_style;
	}
}




