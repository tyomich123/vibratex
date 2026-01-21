<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Parses fontello css file and generates array with icons names
 */
if ( !function_exists( 'vibratex_get_fontello_icons' ) ) {

	function vibratex_get_fontello_icons( $css_uri ) {

		static $list = false;

		if ( !is_array($list) ) {

			$list = array();

			if ( is_admin() )  {

				$fontello = $css_uri;
				$file = vibratex_get_contents_array( $fontello );

				if ( empty($file) ) return $list;


				foreach ($file as $row) {

					if ( substr($row, 0, 1 ) == '.') {

						$i = explode(':', $row);

						if ( !empty($i[0]) ) {

							$list[] = substr($i[0], 1);
						}
					}
				}				
			}
		}

		return $list;
	}
}

/**
 * Getting file contents as array
 * https://codex.wordpress.org/Filesystem_API
 */
function vibratex_get_contents_array( $file ) {

	if ( function_exists('lte_get_font_pack') ) {

    	return lte_get_font_pack($file);
	}
		else {

		return false;
	}
}



/**
 * Get Fontello packs path
 */
if ( !function_exists('vibratex_get_fontello_path') ) {

	function vibratex_get_fontello_path() {

		if ( is_child_theme() AND file_exists(get_stylesheet_directory() . '/assets/fonts/') ) {

			$fontello['css']['url'] = get_stylesheet_directory_uri() . '/assets/fonts/lte-font-codes.css';
			$fontello['eot']['url'] = get_stylesheet_directory_uri() . '/assets/fonts/lte-font.eot';
			$fontello['ttf']['url'] = get_stylesheet_directory_uri() . '/assets/fonts/lte-font.ttf';
			$fontello['woff']['url'] = get_stylesheet_directory_uri() . '/assets/fonts/lte-font.woff';
			$fontello['woff2']['url'] = get_stylesheet_directory_uri() . '/assets/fonts/lte-font.woff2';
			$fontello['svg']['url'] = get_stylesheet_directory_uri() . '/assets/fonts/lte-font.svg';
		}

		if ( empty($fontello) AND file_exists(get_template_directory() . '/assets/fonts/') ) {

			$fontello['css']['url'] = get_template_directory_uri() . '/assets/fonts/lte-font-codes.css';
			$fontello['eot']['url'] = get_template_directory_uri() . '/assets/fonts/lte-font.eot';
			$fontello['ttf']['url'] = get_template_directory_uri() . '/assets/fonts/lte-font.ttf';
			$fontello['woff']['url'] = get_template_directory_uri() . '/assets/fonts/lte-font.woff';
			$fontello['woff2']['url'] = get_template_directory_uri() . '/assets/fonts/lte-font.woff2';
			$fontello['svg']['url'] = get_template_directory_uri() . '/assets/fonts/lte-font.svg';
		}

		return $fontello;	
	}
}

/**
 * Get Fontello CSS file
 */
if ( !function_exists('vibratex_get_fontello_css') ) {

	function vibratex_get_fontello_css() {

		if ( !function_exists('FW')) {

			return false;
		}

		if ( is_child_theme() AND file_exists(get_stylesheet_directory() . '/assets/fonts/lte-font-codes.css') ) {

			$file = get_stylesheet_directory() . '/assets/fonts/lte-font-codes.css';
		}
			else
		if ( file_exists(get_template_directory() . '/assets/fonts/') ) {

			$file = get_template_directory() . '/assets/fonts/lte-font-codes.css';
		}
		
		if ( !empty($file) AND file_exists($file) ) {

			return $file;	
		}
			else {

			return false;
		}
	}
}

/**
 * Generating Fontello inline style and FontAwesome 5
 */
if ( !function_exists('vibratex_get_fontello_generate') ) {

	function vibratex_get_fontello_generate($admin_style = false) {
	
		$fontello = vibratex_get_fontello_path();	

		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style(  'font-awesome',  get_template_directory_uri().'/assets/fonts/font-awesome/css/all.min.css', array(), wp_get_theme()->get('Version') );
		wp_enqueue_style(  'font-awesome-shims',  get_template_directory_uri().'/assets/fonts/font-awesome/css/v4-shims.min.css', array(), wp_get_theme()->get('Version') );

		if ( !empty($fontello['css']) AND !empty( $fontello['eot']) AND  !empty( $fontello['ttf']) AND  !empty( $fontello['woff']) AND  !empty( $fontello['woff2']) AND  !empty( $fontello['svg']) ) {

			wp_enqueue_style(  'lte-font',  $fontello['css']['url'], array(), wp_get_theme()->get('Version') );

			$randomver = wp_get_theme()->get('Version');
			$css_content = "@font-face {
			font-family: 'lte-font';
			  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."');
			  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."#iefix') format('embedded-opentype'),
			       url('". esc_url ( $fontello['woff2']['url']. "?" . $randomver )."') format('woff2'),
			       url('". esc_url ( $fontello['woff']['url']. "?" . $randomver )."') format('woff'),
			       url('". esc_url ( $fontello['ttf']['url']. "?" . $randomver )."') format('truetype'),
			       url('". esc_url ( $fontello['svg']['url']. "?" . $randomver )."#" . pathinfo(wp_basename( $fontello['svg']['url'] ), PATHINFO_FILENAME)  . "') format('svg');
			  font-weight: normal;
			  font-style: normal;
			}";

			if ( $admin_style )  {

				wp_add_inline_style( 'lte-font', $css_content );

			}
				else {

				wp_add_inline_style( 'lte-font-theme-style', $css_content );
			}

		}
	}
}

