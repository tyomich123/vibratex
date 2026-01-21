<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Header for theme
 *
 * Displays all of the <head>
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MKF8S7TR');</script>
<!-- End Google Tag Manager -->
	
<meta name="google-site-verification" content="Oo3mLctRV0YpKpcJfYZKm3Mc0p1OnTq_WBJnl3QEIFA" />
</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKF8S7TR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php

	/* WordPress 5.2 compatibility */
	if ( function_exists( 'wp_body_open' ) ) {

	    wp_body_open();
	}
		else {

		do_action( 'wp_body_open' );
	}

	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {		
	
		get_template_part( 'tmpl/pageheader' ); 
	}

	do_action( 'vibratex_wrapper_open' );

?>