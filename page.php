<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying all text pages
 *
 * This is the template that displays all pages by default.
 *
 */

$sidebar_layout = 'hidden';
$margin_layout = 'margin-default';
$wrapper_class = 'col-xl-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$sidebar_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );
	$margin_layout = 'margin-'.fw_get_db_post_option( $wp_query->get_queried_object_id(), 'margin-layout' );

	add_filter ('vibratex_current_scheme', function() {
		global $wp_query;	

		$vibratex_current_scheme_db = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'color-scheme' );
		if ($vibratex_current_scheme_db == 'default') {

			$vibratex_current_scheme_db = 1; 
		}
		return $vibratex_current_scheme_db; 
	} );

	$current_page_template = get_page_template_slug();
	if ( !empty($current_page_template) ) {

		$current_page_template = explode('/', $current_page_template);
		if ( !empty( $current_page_template ) AND $current_page_template[1] == 'full-width.php' ) {

			$wrapper_class = 'col-xl-12 col-xs-12';
			remove_action( 'vibratex_wrapper_open', 'vibratex_wrapper_open' );
			remove_action( 'vibratex_wrapper_close', 'vibratex_wrapper_close' );

			$sidebar_layout = 'hidden';
		}
	}
}

if ( !vibratex_check_active_sidebar() OR vibratex_is_wc('cart') OR vibratex_is_wc('checkout') ) {

	$sidebar_layout = 'hidden';	
}

if ( empty($margin_layout) OR $margin_layout == 'margin-' ) {

	$margin_layout = 'margin-default';
}

get_header(); ?>

	<!-- Content -->
	<div class="lte-text-page <?php if ( $sidebar_layout != 'hidden' ) echo 'hasSidebar'; ?> <?php echo esc_html( $margin_layout ); ?>">
        <div class="row centered">
        	<?php if ( $sidebar_layout == 'left' ): ?>
        		<?php get_sidebar(); ?>
			<?php endif; ?>
            <div class="<?php if ( empty($sidebar_layout) OR $sidebar_layout == 'hidden' OR $sidebar_layout == 'disabled' ): ?><?php echo esc_html($wrapper_class); ?><?php else: ?> col-xl-9 col-lg-8 col-md-12<?php endif; ?>">
				<?php
				while ( have_posts() ) : 

					the_post();

					get_template_part( 'tmpl/content', 'page' );

					if ( comments_open() || get_comments_number() ) {
						
						comments_template();
					}
				endwhile;
				?>
            </div>
        	<?php if ( $sidebar_layout == 'right' ): ?>
        		<?php get_sidebar(); ?>
			<?php endif; ?>        
        </div>
	</div>

<?php

get_footer();
