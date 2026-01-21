<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Theme Includes
 */
require_once get_template_directory() . '/inc/init.php';
require_once get_template_directory() . '/inc/tgmpa.php';


/**
 * Generate H1 header
 */
if ( !function_exists( 'vibratex_get_the_h1' ) ) {

	function vibratex_get_the_h1() {

		global $wp_post;
		
		if ( is_home() ) {

			$title = esc_html__( 'All Blog Posts', 'vibratex' );
		} 
			else
		if ( is_front_page() ) {

			$title = esc_html__( 'Home', 'vibratex' );
		}
			else
		if ( is_year() ) {

			$title = sprintf( esc_html__( 'Year Archives: %s', 'vibratex' ), get_the_date( 'Y' ) );
		}
			else				
		if ( is_month() ) {

			$title = sprintf( esc_html__( 'Month Archives: %s', 'vibratex' ), get_the_date( 'F Y' ) );
		}
			else
		if ( is_day() ) {

			$title = sprintf( esc_html__( 'Day Archives: %s', 'vibratex' ), get_the_date() );
		}
			else
		if ( is_category() ) {

			$title = single_cat_title( '', false );
		}
			else
		if ( is_tag() ) {

			$title = sprintf( esc_html__( 'Tag: %s', 'vibratex' ), single_tag_title( '', false ) );
		}
			else
		if ( is_tax() ) {

			$title = single_term_title( '', false );
		}
			else
		if ( is_search() ) {

			$title = sprintf( esc_html__( 'Search Results: %s', 'vibratex' ), get_search_query() );
		} 
			else				
		if ( is_author() ) {

			if ( !empty( get_query_var( 'author_name' ) ) ) {

				$q = get_user_by( 'slug', get_query_var( 'author_name' ) );
			}
				else {

				$q = get_userdata( get_query_var( 'author' ) );
			}

			$title = sprintf( esc_html__( 'Author: %s', 'vibratex' ), $q->display_name );
		} 
			else
		if ( is_post_type_archive() ) {

			$q   = get_queried_object();
			$title = '';
			if ( !empty( $q->labels->all_items ) ) {

				$title = $q->labels->all_items;
			}
		}
			else
		if ( is_attachment() ) {

			$title = sprintf( esc_html__( 'Attachment: %s', 'vibratex' ), get_the_title() );
		}
			else
		if ( is_404() ) {

			$title = esc_html__( '404 Not Found', 'vibratex' );
		}
			else {

			$title = get_the_title();
		}

		return $title;
	}
}

/**
 * Adds custom post type active item in menu
 */
if ( !function_exists( 'vibratex_add_current_nav_class' ) ) {

	function vibratex_add_current_nav_class( $classes, $item ) {

		// Getting the current post details
		global $post, $wp;

		$id = ( isset( $post->ID ) ? get_the_ID() : null );

		if ( isset( $id ) ) {

			// Getting the post type of the current post
			$current_post_type = get_post_type_object( get_post_type( $post->ID ) );
			if (!empty($current_post_type->rewrite['slug'])) {

				$current_post_type_slug = $current_post_type->rewrite['slug'];
			}
				else {

				$current_post_type_slug = '';
			}

			$home_url = parse_url( esc_url( home_url( add_query_arg( array(), $wp->request ) ) ) );
			if (isset($home_url['path'])) {

				$current_url = esc_url( str_replace( '/', '', $home_url['path'] ) );
			}
				else {


				$current_url = esc_url( home_url( '/' ) );
			}

			$menu_slug = strtolower( trim( $item->url ) );

			if ( !empty($current_post_type_slug) && strpos( $menu_slug,$current_post_type_slug ) !== false && $current_url != '#' && $current_url != '' && $current_url === str_replace( '/', '', parse_url( $item->url, PHP_URL_PATH ) ) ) {

				$classes[] = 'current-menu-item';

			}
				else {

				$classes = array_diff( $classes, array( 'current_page_parent' ) );
			}		}

		if ( get_post_type() != 'post' && $item->object_id == get_site_option( 'page_for_posts' ) ) {

			$classes = array_diff( $classes, array( 'current_page_parent' ) );
		}

		return $classes;
	}
}

add_action( 'nav_menu_css_class', 'vibratex_add_current_nav_class', 10, 2 );


/**
 * Displays excerpt with defined lenght
 */
if ( !function_exists( 'vibratex_the_excerpt' ) ) {
	
	function vibratex_get_the_excerpt( $content = '' ) {

		global $post;

		$post_format = get_post_format();

		$extended = get_extended($post->post_content);

		if ( has_excerpt() ) {
			
			return get_the_excerpt();
		}
			else
		if ( !empty($extended['extended']) OR
			strpos( $content, '<!--more-->' )  OR
			 strpos( $content, '<!--nextpage-->' ) ) {

		    return get_the_content( esc_html__( 'Read more', 'vibratex' ) );
		}
			else {

			$excerpt_length = (int) apply_filters( 'excerpt_length', 55 );
			$excerpt_custom = get_query_var( 'lte_sc_excerpt_size' );

			if ( !empty($excerpt_custom) ) {

				$excerpt_length = $excerpt_custom;
			}

			return vibratex_cut_words(get_the_excerpt(), $excerpt_length );
		}
	}

	function vibratex_the_excerpt( $content = '' ) {

		$post_format = get_post_format();

		echo vibratex_get_the_excerpt( $content );
	}	
}

/**
 * Cuts text by the number of words
 * negative nubmer returns original text
 */
if ( ! function_exists( 'vibratex_cut_words' ) ) {

	function vibratex_cut_words( $text, $cut = 30, $aft = ' &hellip;' ) {

		$excerpt_add = (int) apply_filters( 'vibratex_excerpt_postfix', ' &hellip;' );
		if ( !empty($excerpt_add) OR $excerpt_add === '' ) {

			$aft = $excerpt_add;
		}

		if ( $cut < 0 ) {

			return $text;
		}

		$words = explode( ' ', wp_strip_all_tags( $text ) );
		if ( count( $words ) > $cut ) {

			$words = array_slice( $words, 0, $cut );
		}

		if ( !empty($words) AND count($words) > 1 ) {

			return implode( ' ', $words ) . esc_html($aft);
		}
	}
}

/**
 * Cuts text by the number of characters
 */
if ( !function_exists( 'vibratex_cut_text' ) ) {

	function vibratex_cut_text( $text, $cut = 300, $aft = ' ...' ) {

		if ( empty( $text ) OR !function_exists('mb_strripos') OR mb_strlen( $text ) <= $cut  ) {

			return $text;
		}
			else {

			$text = wp_strip_all_tags( $text, true );
			$text = strip_tags( $text );
			$text = preg_replace( "/<p>|<\/p>|<br>|(( *&nbsp; *)|(\s{2,}))|\\r|\\n/", ' ', $text );
			$text = mb_substr( $text, 0, $cut, 'UTF-8' );

			return mb_substr( $text, 0, mb_strripos( $text, ' ', 0, 'UTF-8' ), 'UTF-8' ) . $aft;
		}
	}
}
/**
 * Return true|false is woocommerce conditions.
 */
if ( !function_exists( 'vibratex_is_wc' ) ) {

	function vibratex_is_wc($tag, $attr='') {

		if( !class_exists( 'woocommerce' ) ) {
			return false;
		}
		switch ($tag) {

			case 'wc_active':
		        return true;
			
		    case 'woocommerce':
		        if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		        	return true;
		        }
				break;
		    case 'shop':
		        if( function_exists( 'is_shop' ) && is_shop() ) {
		        	return true;
		       	}
				break;
			case 'product_category':
		        if( function_exists( 'is_product_category' ) && is_product_category($attr) ) {
		        	return true;
		        }
				break;
		    case 'product_tag':
		        if( function_exists( 'is_product_tag' ) && is_product_tag($attr) ) {
		        	return true;
		        }
				break;
		    case 'product':
		    	if( function_exists( 'is_product' ) && is_product() ) {
		    		return true;
		    	}
				break;
		    case 'cart':
		        if( function_exists( 'is_cart' ) && is_cart() ) {
		        	return true;
		        }
				break;
		    case 'checkout':
		        if( function_exists( 'is_checkout' ) && is_checkout() ) {
		        	return true;
		        }
				break;
		    case 'account_page':
		        if( function_exists( 'is_account_page' ) && is_account_page() ) {
		        	return true;
		        }
				break;
		    case 'wc_endpoint_url':
		        if( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url($attr) ) {
		        	return true;
		        }
				break;
		    case 'ajax':
		        if( function_exists( 'is_ajax' ) && is_ajax() ) {
		        	return true;
		        }
				break;
		}

		return false;
	}
}

/**
 * Return inverted contrast value of color
 */
if ( !function_exists( 'vibratex_rgb_contrast' ) ) {
	
	function vibratex_rgb_contrast($r, $g, $b) {

		if ($r < 128) {

			return esc_attr(array(255,255,255,0.1));
		}
			else {

			return esc_attr(array(255,255,255,1));
		}
	}
}

/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * @param str $hex Colour as hexadecimal (with or without hash);
 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * @return str Lightened/Darkend colour as hexadecimal (with hash);
 */
if ( !function_exists( 'vibratex_color_change' ) ) {
	
	function vibratex_color_change( $hex, $percent ) {
		
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		
		if ( strlen( $hex ) < 6 ) {

			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		for ($i = 0; $i < 3; $i++) {

			$dec = hexdec( substr( $hex, $i*2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}		
		
		return esc_attr($new_hex);
	}
}

function vibratex_adjust_brightness($hex, $steps) {

    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return esc_attr($return);
}


/**
 * Return footer widget columns number and hidden widgets array
 * @return array();
 */
if ( !function_exists( 'vibratex_get_footer_cols_num' ) ) {

	function vibratex_get_footer_cols_num() {

		global $wp_query;	

		// Footer columns classes, depends on total columns number
	    $footer_tmpl = array(
	    	4	=>	array(
	    			'col-lg-3 col-md-4 col-sm-6 col-ms-12 col-xs-12',
	    			'col-lg-3 col-md-4 col-sm-6 col-ms-12 col-xs-12',
	    			'col-lg-3 col-md-4 col-sm-6 col-ms-12 col-xs-12',
	    			'col-lg-3 col-md-4 col-sm-6 col-ms-12 col-xs-12',
	    		),
	    	3	=>	array(
	    			'col-lg-4 col-md-6 col-sm-12 col-ms-12 col-xs-12',
	    			'col-lg-4 col-md-6 col-sm-12 col-ms-12 col-xs-12',
	    			'col-lg-4 col-md-6 col-sm-12 col-ms-12 col-xs-12',
	    			'col-lg-4 col-md-6 col-sm-12 col-ms-12 col-xs-12',
	    		),
	    	2	=>	array(
	    			'col-lg-6 col-md-6 col-sm-12 col-xs-12',
	    			'col-lg-6 col-md-6 col-sm-12 col-xs-12',
	    			'col-lg-6 col-md-6 col-sm-12 col-xs-12',
	    			'col-lg-6 col-md-6 col-sm-12 col-xs-12',
	    		),
	    	1	=>	array(
	    			'col-xl-10 col-lg-10 col-md-12 col-xs-12',
	    			'col-xl-10 col-lg-10 col-md-12 col-xs-12',
	    			'col-xl-10 col-lg-10 col-md-12 col-xs-12',
	    			'col-xl-10 col-lg-10 col-md-12 col-xs-12',
	    		),
	    );	

		if ( function_exists( 'FW' ) ) {

			$col_hidden_md = $col_hidden_mobile = $classes = $footer_hide = array();

		    $footer_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-layout' );
		    if ( $footer_layout != 'disabled') {

		    	$footer_cols_num = 0;
		    	for ($x = 1; $x <= 4; $x++) {

		    		if ( !is_active_sidebar( 'footer-' . $x ) ) {

		    			continue;
		    		}

		    		$col_hidden = fw_get_db_settings_option( 'footer_' . $x . '_hide' );
		    		if ( $col_hidden == 'show' ) {

		    			$footer_cols_num++;
		    		}
		    			else {

						$footer_hide[$x] = true;
	    			}

	              	$hide_md = fw_get_db_settings_option( 'footer_' . $x . '_hide_md');
	            	if ( $hide_md == 'hide' ) {

	            		$col_hidden_md[$x] = 'hidden-md';
	            	}    	
	            		else {

						$col_hidden_md[$x] = '';
	           		}

	              	$hide_mobile = fw_get_db_settings_option( 'footer_' . $x . '_hide_mobile');
	            	if ( $hide_mobile == 'hide' ) {

	            		$col_hidden_mobile[$x] = 'hidden-xs hidden-ms hidden-sm';
	            	}    	
	            		else {

						$col_hidden_mobile[$x] = '';
	           		}
	            			
		    	}

		    	for ($x = 1; $x <= 4; $x++) {

		    		if ( !is_active_sidebar( 'footer-' . $x ) ) {

		    			continue;
		    		}		    		

					if ( isset($footer_tmpl[$footer_cols_num][( $x - 1 )]) ) {

		        		$classes[$x] = $footer_tmpl[$footer_cols_num][( $x - 1 )];
		        	}
		        }	
		    }                
		    	else {

		        $footer_cols_num = 0;
		   	}    		

			return array(
				'num'			=>	$footer_cols_num,
				'hidden'		=>	$footer_hide,
				'hidden_md'		=>	$col_hidden_md,
				'hidden_mobile'	=>	$col_hidden_mobile,
				'classes'		=>	$classes,
			);
		}
			else {

			$col_hidden_md = $col_hidden_mobile = $classes = $footer_hide = array();
			$footer_cols_num = 0;

	    	for ($x = 1; $x <= 4; $x++) {

	    		if ( is_active_sidebar( 'footer-' . $x ) ) {

		    		$col_hidden_md[$x] = '';
		    		$col_hidden_mobile[$x] = '';
		    		$footer_cols_num++;
	    		}
	    			else {

	    			$footer_hide[$x] = true;
    			}
	        }	

	        for ($x = 1; $x <= 4; $x++) {

				if ( isset($footer_tmpl[$footer_cols_num][( $x - 1 )]) ) {

	        		$classes[$x] = $footer_tmpl[$footer_cols_num][( $x - 1 )];
	        	}
	        }

			return array(
				'num'			=>	$footer_cols_num,
				'hidden'		=>	$footer_hide,
				'hidden_md'		=>	$col_hidden_md,
				'hidden_mobile'	=>	$col_hidden_mobile,
				'classes'		=>	$classes
			);
		}
	}
}


/**
 * Get current page navbar and reset it to default if non-theme setting
 */
if ( !function_exists( 'vibratex_get_navbar_layout' ) ) {

	function vibratex_get_navbar_layout( $default = null ) {

		global $wp_query;

		$vibratex_theme_config = vibratex_theme_config();

		if ( function_exists('FW')) {

			$navbar_layout_default = fw_get_db_settings_option( 'navbar-default' );
			$navbar_layout_default_force = fw_get_db_settings_option( 'navbar-default-force' );
		}
		if ( empty( $navbar_layout_default ) ) {

			$navbar_layout_default = $default;
		}

		if ( function_exists('FW')) {
		
			$navbar_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'navbar-layout' );
		}

		if ( !empty($navbar_layout) AND $navbar_layout == 'disabled') {

			return 'disabled';
		}
			else
		if ( ( !empty( $navbar_layout) AND empty( $vibratex_theme_config['navbar'][$navbar_layout] ) )
			 OR empty( $navbar_layout )
			 OR $navbar_layout_default_force == 'force' ) {

			$navbar_layout = $navbar_layout_default;
		}

		$nav_elements = explode('-', $navbar_layout);
		$nav_color = end($nav_elements);
		array_pop($nav_elements);

		return array(
			$nav_color,
			implode('-', $nav_elements)
		);
	}
}

/**
 * Return navbar menu
*/
if ( !function_exists( 'vibratex_get_menu' ) ) {

	function vibratex_get_menu() {

		global $wp_query;

		$location = 'primary';
		$menu_id = null;

		wp_nav_menu(array(

			'theme_location'	=>  $location,
			'menu_class' 		=> 'lte-ul-nav',
			'container'			=> 'ul',
			'link_before' 		=> '<span><span>',     
			'link_after'  		=> '</span></span>'							
		));		
	}
}


/**
 * Returns all Sections
 */
if ( !function_exists( 'vibratex_get_sections' ) ) {

	function vibratex_get_sections() {

		static $list;
		$default = array('top_bar', 'before_footer', 'subscribe', 'footer');

		if ( empty($list) ) {

			$posts = get_posts( array(
				'nopaging'                  => true,
				'post_type' => 'sections',
				'posts_per_page'	=>	-1,
			) );

			$cat = array();

			if ( !empty($posts) ) {

				foreach ( $posts as $post ) {

					$tid = fw_get_db_post_option($post->ID, 'theme_block');
					$list[$tid][$post->ID] = $post->post_title;					
				}
			}

			wp_reset_postdata();
		}

		foreach ( $default as $item ) {

			if ( empty($list[$item]) ) {

				$list[$item] = array();
			}
		}

		return $list;
	}
}

/**
 * Get page header layout
 */
if ( !function_exists( 'vibratex_get_pageheader_layout' ) ) {

	function vibratex_get_pageheader_layout() {

		global $wp_query;

		$pageheader_layout = 'default';
		if ( function_exists( 'FW' ) ) {

			$pageheader_display = fw_get_db_settings_option( 'pageheader-display' );
			if ( $pageheader_display != 'disabled' ) {

				$pageheader_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'header-layout' );
			}
				else {

				$pageheader_layout = $pageheader_display;
			}
		}

		$post_type = get_post_type(get_The_ID());

		if ( isset($page_narrow) AND is_single() AND !vibratex_is_wc('woocommerce') AND ($pageheader_layout == 'default' OR empty($pageheader_layout)) AND $post_type == 'post' ) {

			$pageheader_layout = 'narrow';
		}

		$pageheader_layout = apply_filters ('vibratex_pageheader_layout', $pageheader_layout);

		return $pageheader_layout;	
	}
}

/**
 * Get page header class
 */
if ( !function_exists( 'vibratex_get_pageheader_class' ) ) {

	function vibratex_get_pageheader_class() {
		
		$vibratex_header_class = array();
		$vibratex_h1 = vibratex_get_the_h1();

		if ( !empty($vibratex_h1) ) {

			$vibratex_header_class[] = 'header-h1 ';
		}

		if ( function_exists('FW') ) {

			$header_fixed = fw_get_db_settings_option( 'header_fixed' );
			if ( $header_fixed == 'fixed' ) {

				$vibratex_header_class[] = 'header-parallax';
			}

			$overlay = fw_get_db_settings_option( 'pageheader-overlay' );
			if ( $overlay == 'enabled' ) {

				$vibratex_header_class[] = 'lte-header-overlay';
			}
		}

		if ( function_exists( 'bcn_display' ) && !is_front_page() ) {

			$vibratex_header_class[] = 'hasBreadcrumbs';
		}

		$navbar_layout = 'transparent';
		if ( function_exists( 'FW' ) ) {

			$navbar_layout = vibratex_get_navbar_layout('transparent');
		}

		if ( !is_array($navbar_layout) ) {

			$navbar_layout = [];
			$navbar_layout[1] = 'default';
		}

		$vibratex_header_class[] = 'lte-layout-' . $navbar_layout[1];

		return implode( ' ', $vibratex_header_class );
	}

	function vibratex_get_pageheader_parallax_class() {

		$classes = array();
		$classes[] = 'lte-page-header';

		if ( function_exists('FW') ) {

			$header_fixed = fw_get_db_settings_option( 'header_fixed' );
			if ( $header_fixed == 'fixed' ) {

				$classes[] = 'lte-parallax-yes';
			}
		}	

		return implode( ' ', $classes );
	}
}

/**
 * Get page header wrapper class
 */
if ( !function_exists( 'vibratex_get_pageheader_wrapper' ) ) {

	function vibratex_get_pageheader_wrapper() {

		global $wp_query;

		if ( function_exists('FW')) {

			$parallax = fw_get_db_settings_option( 'footer-parallax' );
			$parallax_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'footer-parallax' );

			if ( $parallax == 'enabled' AND $parallax_layout != 'disabled') {

				return 'lte-footer-parallax';
			}
		}

		return '';
	}
}

/**
 * Bcn first crumb title
 * Used for external plugin Breadcrumb NavXT
 */
if ( function_exists( 'bcn_display' ) ) {

	add_filter('bcn_breadcrumb_title', function($title, $type, $id) {

		if ($type[0] === 'home') {

			$title = esc_html__('Home', 'vibratex');
		}
		return $title;
	}, 42, 3);
}


/**
 * Checks is any sidebar active
 */
if ( !function_exists( 'vibratex_check_active_sidebar' ) ) {

	function vibratex_check_active_sidebar() {

		if ( vibratex_is_wc('woocommerce') || vibratex_is_wc('shop') || vibratex_is_wc('product') ) {

			if ( is_active_sidebar( 'sidebar-wc' ) ) {

				return true;
			}
		}
			else {

			if ( is_active_sidebar( 'sidebar-1' ) ) {

				if ( function_exists('FW') AND is_single() ) {

					$vibratex_sidebar = fw_get_db_settings_option( 'blog_post_sidebar' );
					if ( $vibratex_sidebar != 'hidden' ) {

						return true;
					}
				}
					else
				if ( is_single() ) {

					return false;
				}
					else {

					return true;
				}
			}
		}

		return false;
	}
}



/**
 * Checks WC sidebar position
 */
if ( !function_exists( 'vibratex_get_wc_sidebar_pos' ) ) {

	function vibratex_get_wc_sidebar_pos() {

		if ( vibratex_is_wc('product') ) {

			$vibratex_sidebar = false;
		}
			else {

			$vibratex_sidebar = 'left';
		}

		if ( function_exists( 'FW' ) ) {

			if ( vibratex_is_wc('product') ) {

				$vibratex_sidebar = fw_get_db_settings_option( 'shop_post_sidebar' );
			}	
				else {

				$vibratex_sidebar = fw_get_db_settings_option( 'shop_list_sidebar' );
			}

			if ( $vibratex_sidebar == 'hidden' ) {

				$vibratex_sidebar = false;
			}
		}	

		return $vibratex_sidebar;
	}
}

/**
 * Collecting additional Custom CSS
 */
if ( !function_exists( 'vibratex_custom_css' ) ) {

	function vibratex_custom_css( $css = null ) {

		$custom_css = get_query_var('lte_custom_css');
		if ( empty($custom_css ) ) {

			$custom_css = '';
		}

		if ( !empty($css) ) {

			$custom_css .= $css;
			set_query_var('lte_custom_css', $custom_css);
		}

		return $custom_css;
	}	
}

/**
 * Find first http/s in string
 */
if ( !function_exists( 'vibratex_find_http' ) ) {

	function vibratex_find_http( $string ) {

		$reg_exUrl = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

		if (preg_match($reg_exUrl, $string, $url)) {

			return $url[0];
	    }
	}	
}

/**
 * Adds inline style for futher use
 */
if ( ! function_exists( 'vibratex_add_inline_style' ) ) {

	function vibratex_add_inline_style( $style ) {

		global $vibratex_variables;

		if ( empty( $vibratex_variables ) ) {

			$vibratex_variables = array();
			$vibratex_variables['inline_style'] = '';
		}

		$vibratex_variables['inline_style'] .= $style;

		return true;
	}
}

/**
 * Return stored inline styles
 */
if ( ! function_exists( 'vibratex_get_inline_style' ) ) {

	function vibratex_get_inline_style() {

		global $vibratex_variables;

		if ( !empty($vibratex_variables['inline_style']) ) {

			return $vibratex_variables['inline_style'];
		}
			else {

			return false;
		}
	}
}

/**
 * Display image with srcset and sizes attr
 * 
 */
function vibratex_the_img_srcset( $attachment_id, $sizes_hooks, $sizes_media ) {

	if ( !empty($attachment_id) AND !empty($sizes_hooks) AND !empty($sizes_media) ) {

		$attachment_id = get_post_thumbnail_id();

		foreach ( $sizes_hooks as $hook ) {

			$size = wp_get_attachment_image_src( $attachment_id, $hook );
			$img = wp_get_attachment_image_url( $attachment_id, $hook );

			$srcset[] = $img .' '. $size[1].'w';
		}

		$sizes = array();
		foreach ( $sizes_media as $width => $hook ) {

			$size = wp_get_attachment_image_src( $attachment_id, $hook );
			$sizes[] = '(max-width: '.$width.') '.$size[1].'px';
		}

		$size = wp_get_attachment_image_src( $attachment_id, $sizes_hooks[0] );
		$sizes[] = $size[1].'px';

		$image_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true);
		$image = wp_get_attachment_image_url( $attachment_id, $sizes_hooks[0] );

		echo '<img src="'.esc_url($image).'" width="'.esc_attr($size[1]).'" height="'.esc_attr($size[2]).'" alt="'.esc_attr($image_alt).'" 
		srcset="'. esc_attr( implode(',', $srcset)) .'"
		sizes="'. esc_attr( implode(',', $sizes)) .'">';
	}
}

$vibratex_current_scheme = apply_filters ('vibratex_current_scheme', array());


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function vibratex_pingback_header() {

	global $wp_query;

	if ( is_singular() && pings_open() ) {

		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'vibratex_pingback_header' );