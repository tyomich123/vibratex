<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Theme Settings
 */

$options = array(
	fw()->theme->get_options( 'general-settings' ),
	fw()->theme->get_options( 'header-settings' ),
	fw()->theme->get_options( 'footer-settings' ),
	fw()->theme->get_options( 'cpt-settings' ),
	fw()->theme->get_options( 'woocommerce-settings' ),
	fw()->theme->get_options( 'social-settings' ),
	fw()->theme->get_options( 'fonts-settings' ),
	fw()->theme->get_options( 'color-settings' ),
);
