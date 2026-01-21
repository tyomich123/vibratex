<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Welcome Page
 */

if ( !function_exists( 'vibratex_welcome_page_init' ) ) {

	function vibratex_welcome_page_init() {

		if ( !in_array('lte-ext/lte-ext.php', get_option( 'active_plugins' )) ) {

			$theme = wp_get_theme();

			add_theme_page(
				$theme->name,
				$theme->name,
				'install_themes',
				'vibratex_welcome',
				'vibratex_welcome_output'
			);
		}
	}

	add_action( 'admin_menu', 'vibratex_welcome_page_init' );
}

if ( !function_exists( 'vibratex_welcome_page_activate' ) ) {

	function vibratex_welcome_page_activate() {

		update_option( 'vibratex_welcome_page', 1 );
	}

	add_action( 'after_switch_theme', 'vibratex_welcome_page_activate', 100 );	
}

if ( !function_exists( 'vibratex_welcome_page_open' ) ) {

	function vibratex_welcome_page_open() {

		if ( get_option( 'vibratex_welcome_page' ) == 1 && !in_array('lte-ext/lte-ext.php', get_option( 'active_plugins' )) ) {

			update_option( 'vibratex_welcome_page', 0 );

			wp_safe_redirect( admin_url() . 'themes.php?page=vibratex_welcome' );
			exit;
		}
	}

	add_action( 'init', 'vibratex_welcome_page_open', 100 );
}


/**
 * Generating output of welcome screen
 */
if ( !function_exists( 'vibratex_welcome_output' ) ) {

	function vibratex_welcome_output() {

		$theme = wp_get_theme();
		echo '<div class="wrap">';

			echo '<h1>'.esc_html__( 'Welcome to', 'vibratex' ).' '.esc_html($theme->name).'</h1>';
			echo '<div class="lte-admin-section">';

			echo '<h2>'.esc_html($theme->name).' '.esc_html($theme->version).'</h2>';

			echo wp_kses(
				sprintf('<p>%1$s <a href="%2$s">%3$s</a>.</p>',
					esc_html__( 'In order to get the full functionality of the theme, we recommend you to install all required ', 'vibratex' ),
					esc_url( admin_url() . 'plugins.php' ),
					esc_html__( 'plugins', 'vibratex' )
				)
			, 'header');			

		echo '</div>
		</div>';
	}
}

