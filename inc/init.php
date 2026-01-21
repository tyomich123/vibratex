<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Vibratex_Theme_Includes {

	private static $rel_path = null;

	private static $initialized = false;

	public static function init() {

		if ( self::$initialized ) {

			return;
		}
			else {

			self::$initialized = true;
		}

		/**
		 * Both frontend and backend
		 */
		self::include_child_first( '/helpers.php' );
		self::include_child_first( '/hooks.php' );
		
		self::include_child_first( '/theme-config.php' );
		self::include_child_first( '/template-parts.php' );
		self::include_child_first( '/theme-style/font-packs.php' );
		self::include_child_first( '/theme-welcome.php' );

		add_action( 'init', array( __CLASS__, 'vibratex_action_init' ) );

		/**
		 * Only frontend
		 */
		if ( !is_admin() ) {
			
			add_action('wp_enqueue_scripts', array( __CLASS__, 'vibratex_action_enqueue_scripts' ), 20 );
		}
	}

	public static function vibratex_action_enqueue_scripts() {
		
		self::include_child_first( '/static.php' );
	}

	public static function vibratex_action_init() {
		
		self::include_child_first( '/menus.php' );
		self::include_child_first( '/woocommerce.php' );
	}

	private static function get_rel_path($append = '') {

		if (self::$rel_path === null) {

			self::$rel_path = '/inc';
		}

		return self::$rel_path . $append;
	}

	public static function get_parent_path( $rel_path ) {

		return get_template_directory() . self::get_rel_path( $rel_path );
	}

	public static function get_child_path( $rel_path ) {

		if ( !is_child_theme() ) {

			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path( $rel_path );
	}

	public static function include_isolated( $path ) {

		include $path;
	}

	public static function include_child_first( $rel_path ) {

		if ( is_child_theme() ) {

			$path = self::get_child_path( $rel_path );

			if ( file_exists( $path ) ) {

				self::include_isolated( $path );
			}
		}

		$path = self::get_parent_path( $rel_path );

		if ( file_exists( $path ) ) {

			self::include_isolated( $path );
		}
	}
}

Vibratex_Theme_Includes::init();

