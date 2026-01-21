<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying the footer
 */
    do_action( 'vibratex_wrapper_close' );
    do_action('vibratex_content_close');
    
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {

        vibratex_the_before_footer();

        vibratex_the_subscribe_block();

        do_action('vibratex_footer_open');

            /* Footer widgets area */
            vibratex_the_footer_block();

            /* Copyright */
            vibratex_the_copyrights_section();

        do_action('vibratex_footer_close');
    }

    wp_footer();
?>
</body>
</html>
