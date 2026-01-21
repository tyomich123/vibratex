<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Filters and Actions
 */

/**
 * Enqueue Admin Styles
*/
if ( !function_exists( 'vibratex_action_theme_admin_styles' ) ) {

	function vibratex_action_theme_admin_styles() {

		wp_enqueue_style( 'vibratex-theme-admin-font', vibratex_font_url(), array(), '1.0' );
		wp_enqueue_style( 'vibratex-admin', get_template_directory_uri() . '/assets/css/admin.css', false, '1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'vibratex_action_theme_admin_styles' );


/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 * @internal
 */
if ( !function_exists( 'vibratex_theme_setup' ) ) {

	function vibratex_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'vibratex', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', vibratex_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( "responsive-embeds" );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1150, 770, true );

		add_image_size( 'vibratex-blog', 460, 280, true );	
		add_image_size( 'vibratex-blog-small', 530, 414, true );	
		add_image_size( 'vibratex-services', 300, 300, false );
		add_image_size( 'vibratex-wc-cat', 370, 600, true );
		add_image_size( 'vibratex-client', 480, 630, true );	
		add_image_size( 'vibratex-blog-full', 1120, 720, true );	
		add_image_size( 'vibratex-partners', 140, 140, true );	
		add_image_size( 'vibratex-tiny-square', 110, 110, true );	
		add_image_size( 'vibratex-team-square', 290, 290, true );	
		add_image_size( 'vibratex-team', 325, 250, true );	
		add_image_size( 'vibratex-tiny', 110, 80, true );	
		add_image_size( 'vibratex-product-tiny', 100, 100, false );	
		add_image_size( 'vibratex-pages', 100, 120, true );	
		add_image_size( 'vibratex-gallery-grid', 360, 360, true );	
		add_image_size( 'vibratex-gallery-big', 1250, 1250 );	
		add_image_size( 'vibratex-gallery', 755, 500, true );	


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
		add_filter( 'widget_text', 'do_shortcode' );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		$GLOBALS['content_width'] = apply_filters( 'vibratex_content_width', 1140 );

		/**
		 * WooCommerce Support
		 */
	    add_theme_support( 'woocommerce' );

	    if ( function_exists( 'FW' ) ) {

	    	$wc_zoom = fw_get_db_settings_option( 'wc_zoom' );
			if ( !empty($wc_zoom) AND $wc_zoom == 'enabled') {

				add_theme_support( 'wc-product-gallery-zoom' );
			}

			$widgets_block = fw_get_db_settings_option( 'widgets_block' );
			if (!empty($widgets_block) ) {

				add_theme_support( 'widgets-block-editor' );
			}
	    }

		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );   
		add_theme_support( 'woocommerce', array( 'thumbnail_image_width' => 480 ) );	
	}
}
add_action( 'after_setup_theme', 'vibratex_theme_setup' );

function vibratex_theme_init() {

    if ( function_exists( 'FW' ) ) {

		$widgets_block = fw_get_db_settings_option( 'widgets_block' );
		if (!empty($widgets_block) ) {

			add_theme_support( 'widgets-block-editor' );
		}
	}
}
add_action( 'init', 'vibratex_theme_init', 50 );

/**
 * Load Gutenberg stylesheet.
 */
if ( !function_exists( 'vibratex_block_assets' ) ) {

	function vibratex_block_assets() {

		wp_enqueue_style( 'vibratex-block-assets', get_theme_file_uri( '/assets/css/block-editor-style.css' ), false );
	}
}
add_action( 'enqueue_block_editor_assets', 'vibratex_block_assets' );

/**
 * Extend the default WordPress body classes.
 */
if ( !function_exists( 'vibratex_filter_theme_body_classes' ) ) {

	function vibratex_filter_theme_body_classes( $classes ) {

		global $wp_query, $wp_locale, $wp_styles;

		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {

			$current_position = fw_ext_sidebars_get_current_position();
			if ( in_array( $current_position, array( 'full', 'left' ) )
			     || empty( $current_position )
			     || is_page_template( 'page-templates/full-width.php' )
			     || is_page_template( 'page-templates/contributors.php' )
			     || is_attachment()
			) {
				$classes[] = 'full-width';
			}
		} else {
			$classes[] = 'full-width';
		}

		if ( is_singular() && ! is_front_page() ) {
			$classes[] = 'singular';
		}

		$sidebar_layout = 'hidden';
		$vibratex_pace = 'disabled';
		$body_color = 'white';

		if ( function_exists( 'FW' ) ) {

			$classes[] = 'lte-fw-loaded';

			$vibratex_pace = fw_get_db_settings_option( 'page-loader' );
			if ( !empty($vibratex_pace) AND !empty($vibratex_pace['loader'])) {

				$vibratex_pace = $vibratex_pace['loader'];
			}

			$body_color_ = fw_get_db_settings_option( 'body-bg' );
			$body_color_page = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'body-bg' );
			if ( !empty($body_color_page) AND $body_color_page != 'default' ) {

				$body_color = $body_color_page;
			}

			$body_border = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'margin-layout' );
			if ( !empty($body_border) AND $body_border == 'body-border' ) {

				$classes[] = "lte-body-border";
			}

			$sidebar_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );

			$vibratex_footer_cols = vibratex_get_footer_cols_num();

			$bg_404 = fw_get_db_settings_option( '404_bg' );
			if (! empty( $bg_404 ) ) {		

				$classes[] = 'lte-bg-404';
			}

			$current_scheme = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'color-scheme' );
			if ( !empty( $current_scheme) ) {

				$classes[] = 'lte-color-scheme-'.esc_attr($current_scheme);

				$color_schemes = fw_get_db_settings_option( 'items' );

				if ( !empty($color_schemes) ) {

					foreach ( $color_schemes as $scheme ) {

						if ( $scheme['slug'] == $current_scheme AND !empty($scheme['invert-button']) ) {

							$classes[] = 'lte-invert-color-main';
						}
					}
				}
			}

			if ( vibratex_is_wc('woocommerce') ) {

				$classes[] = 'lte-product-style-' . esc_attr(fw_get_db_settings_option( 'wc_product_style' ));
			}
		}
			else {
		}

		if ( !empty($body_color) AND $body_color != 'default' ) {

			$classes[] = "lte-body-".esc_attr($body_color)." lte-background-".esc_attr($body_color);
		}

		if ( empty($vibratex_footer_cols) ) {

			$classes[] = 'no-footer-widgets';
		}

		$classes[] = 'paceloader-'.esc_attr($vibratex_pace);


		$sidebar_active = vibratex_check_active_sidebar();
		if ( $sidebar_active === true ) {

			$sidebar_layout = 'visible';
		}

		if ( empty($sidebar_layout) OR $sidebar_layout == 'hidden' OR is_page_template( 'page-templates/full-width.php' ) OR !function_exists('FW') ) {

			$classes[] = 'full-width';
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'vibratex_filter_theme_body_classes' );

/**
 * Extend the default WordPress post classes.
 */
if ( !function_exists( 'vibratex_filter_theme_post_classes' ) ) {

	function vibratex_filter_theme_post_classes( $classes ) {

		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {

			$classes[] = 'has-post-thumbnail';
		}

		return $classes;
	}
}
add_filter( 'post_class', 'vibratex_filter_theme_post_classes' );

/**
 * Adds wp_kses allowed html tags
 */
if ( !function_exists( 'vibratex_kses_allowed_html' ) ) {

	function vibratex_kses_allowed_html($tags, $context) {

		switch($context) {

			case 'header': 
			  $tags = array( 
			    'br' => [],
			    'span' => [],
			    'em' => [],
			    'b' => [],
			    'p' => [],
			    'sup' => [],
			    'a' => array('href' => [], 'target' => []),
			  );
			  return $tags;
			case 'links': 
			  $tags = array( 
			    'span' => array('class' => []),
			    'a' => array('class' => [], 'href' => [], 'target' => []),
			  );
			  return $tags;
			case 'bio': 
			  $tags = array( 
			    'section' => array( 'class' => [] ),
			    'div' => array( 'class' => [] ),
			    'span' => array( 'class' => [] ),
			    'h1' => array( 'class' => [] ),
			    'h2' => array( 'class' => [] ),
			    'h3' => array( 'class' => [] ),
			    'h4' => array( 'class' => [] ),
			    'h5' => array( 'class' => [] ),
			    'h6' => array( 'class' => [] ),
			    'img' => array( 'class' => [], 'src' => [], 'alt' => [], 'width' => [], 'height' => [] ),
			    'b' => [],
			    'p' => array( 'class' => [] ),
			    'sup' => [],
			    'a' => array('class' => [], 'href' => [], 'target' => []),
			  );
			  return $tags;				  
			default: 
			  return $tags;
		}
	}
}
add_filter( 'wp_kses_allowed_html', 'vibratex_kses_allowed_html', 10, 2);


/**
 * Changes text direction for certain page. In most cases used only for demo.
 */
if ( !function_exists( 'vibratex_custom_text_direction' ) ) {

	function vibratex_custom_text_direction() {

		global $wp_query, $wp_locale, $wp_styles;

		if ( function_exists('FW') ) {

			$direction = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'direction' );

			if ( !empty($direction) AND $direction != 'default' ) {

				if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
					$wp_styles = new WP_Styles();
				}
				if ( $direction == 'rtl') {

					$wp_locale->text_direction = $wp_styles->text_direction = 'rtl';
				}
					else {

					$wp_locale->text_direction = $wp_styles->text_direction = 'ltr';
				}
			}
		}
	}
}
add_action( 'get_header', 'vibratex_custom_text_direction' );


/**
 * Flush out the transients used in vibratex_categorized_blog.
 */
if ( !function_exists( 'vibratex_action_theme_category_transient_flusher' ) ) {

	function vibratex_action_theme_category_transient_flusher() {

		delete_transient( 'vibratex_category_count' );
	}
}

add_action( 'edit_category', 'vibratex_action_theme_category_transient_flusher' );
add_action( 'save_post', 'vibratex_action_theme_category_transient_flusher' );

/**
 * Changes default Unyson FW path
 */
if ( !function_exists('vibratex_theme_custom_framework_customizations_dir_rel_path') ) {

	function vibratex_theme_custom_framework_customizations_dir_rel_path( $rel_path ) {

	    return '/inc/fw';
	}
}
add_filter( 'fw_framework_customizations_dir_rel_path', 'vibratex_theme_custom_framework_customizations_dir_rel_path' );


/**
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */
if ( !function_exists( 'vibratex_filter_theme_fw_ext_backups_demos' ) ) {

	function vibratex_filter_theme_fw_ext_backups_demos( $demos ) {

		$demos_array = array(

			'vibratex-demo' => array(
				'title' => esc_html__( 'Vibratex Demo Content', 'vibratex' ),
				'screenshot' => 'http://update.just-theme.com/vibratex/screenshot.png',
				'preview_link' => 'http://vibratex.just-theme.com/',
			),
		);

		$download_url = 'http://update.just-theme.com/vibratex/?v='.esc_attr(wp_get_theme(get_template())->version);

		foreach ( $demos_array as $id => $data ) {

			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(

				'url' => $download_url,
				'file_id' => $id,
			));

			$demo->set_title( $data['title'] );
			$demo->set_screenshot( $data['screenshot'] );
			$demo->set_preview_link( $data['preview_link'] );

			$demos[ $demo->get_id() ] = $demo;

			unset( $demo );
		}

		return $demos;
	}
}
add_filter( 'fw:ext:backups-demo:demos', 'vibratex_filter_theme_fw_ext_backups_demos' );

