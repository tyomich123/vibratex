<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * TGM Plugin Activation
 */

require_once get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';

if ( !function_exists('vibratex_action_theme_register_required_plugins') ) {

	function vibratex_action_theme_register_required_plugins() {

		$config = array(

			'id'           => 'vibratex',
			'menu'         => 'vibratex-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'is_automatic' => false,
		);

		tgmpa( array(

			array(
				'name'      => esc_html__('Elementor', 'vibratex'),
				'slug'      => 'elementor',
				'required'  => true,
			),			
			array(
				'name'      => esc_html__('LTE Extension', 'vibratex'),
				'slug'      => 'lte-ext',
				'source'   	=> get_template_directory() . '/inc/plugins/lte-ext.zip',
				'version'   => '1.4.0',
				'required'  => true,
			),			
			array(
				'name'      => esc_html__('Events Calendar', 'vibratex'),
				'slug'      => 'the-events-calendar',
				'required'  => false,
			),										
			array(
				'name'      => esc_html__('Envato Market', 'vibratex'),
				'slug'      => 'envato-market',
				'source'   	=> get_template_directory() . '/inc/plugins/envato-market.zip',
				'required'  => false,
			),													
			array(
				'name'      => esc_html__('Breadcrumb-navxt', 'vibratex'),
				'slug'      => 'breadcrumb-navxt',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'vibratex'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'       => esc_html__('MailChimp for WordPress', 'vibratex'),
				'slug'       => 'mailchimp-for-wp',
				'required'   => false,
			),		
			array(
				'name'       => esc_html__('WooCommerce', 'vibratex'),
				'slug'       => 'woocommerce',
				'required'   => false,
			),
			array(
				'name'      => esc_html__('Post-views-counter', 'vibratex'),
				'slug'      => 'post-views-counter',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('YITH WooCommerce Wishlist', 'vibratex'),
				'slug'      => 'yith-woocommerce-wishlist',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('LT Core', 'vibratex'),
				'slug'      => 'lt-core',
				'source'   	=> 'http://update.just-theme.com/plugins/lt-core/lt-core.zip',
				'required'  => true,
			),
			
		), $config);
	}
}

add_action( 'tgmpa_register', 'vibratex_action_theme_register_required_plugins' );

