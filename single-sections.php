<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Template for displaying sections preview
 * Peview uses full-width page without any elements
 */

add_filter('vibratex_navbar_layout', function() { return 'disabled'; } );
add_filter('vibratex_pageheader_layout', function() { return 'disabled'; } );
add_filter('vibratex_footer_cols_num', function() { return 0; } );
add_filter('vibratex_copyright_layout', function() { return 'disabled'; } );

remove_action( 'vibratex_wrapper_open', 'vibratex_wrapper_open' );
remove_action( 'vibratex_wrapper_close', 'vibratex_wrapper_close' );

get_header();

?>
<div class="lte-text-page lte-sections-block">
	<?php
	while ( have_posts() ) : 

		the_post();

		get_template_part( 'tmpl/content', 'page' );

	endwhile;
	?>
</div>
<?php

get_footer();