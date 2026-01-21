<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The blog template file
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

$blog_class = $sidebar_wrap = $vibratex_layout = '';
$vibratex_sidebar_hidden = false;
$vibratex_sidebar = 'right';
$blog_wrap_class = 'col-xl-9 col-lg-8 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$vibratex_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'blog-layout' );
	$vibratex_sidebar = fw_get_db_settings_option( 'blog_list_sidebar' );

	$vibratex_sidebar_custom = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );
	if ( $vibratex_sidebar_custom != 'default') $vibratex_sidebar = $vibratex_sidebar_custom;

	if ( $vibratex_sidebar == 'hidden' OR $vibratex_sidebar == 'disabled' ) $vibratex_sidebar_hidden = true;

	$blog_wrap_class = 'col-xl-9 col-lg-8 col-md-12 col-xs-12 ';

	if ( $vibratex_sidebar == 'left' ) {

	
	}

	$blog_class = '';
	if ( $vibratex_layout == 'two-cols' OR $vibratex_layout == 'three-cols' ) {

		$blog_class = 'masonry';
		if ( $vibratex_sidebar_hidden ) $blog_wrap_class = 'col-lg-12 col-xs-12';
	}
		else {

		if ( $vibratex_sidebar_hidden ) $blog_wrap_class = 'col-xl-9 col-lg-10 col-md-12 col-xs-12';	
	}

	if ( $vibratex_layout == 'classic' ) {

		$sidebar_wrap = 'with-sidebar';
	}
		else {

		$sidebar_wrap = '';
	}
}

get_header(); ?>
<div class="inner-page margin-default">
	<div class="row lte-sidebar-position-<?php echo esc_attr($vibratex_sidebar); ?><?php if ( $vibratex_sidebar_hidden ) echo ' centered'; else echo esc_attr($sidebar_wrap); ?>">
        <div class="<?php echo esc_attr( $blog_wrap_class ); ?> lte-blog-wrap" >
            <div class="blog blog-block layout-<?php echo esc_attr($vibratex_layout); ?>">
				<?php

				if ( get_query_var( 'paged' ) ) {

					$paged = get_query_var( 'paged' );

				} elseif ( get_query_var( 'page' ) ) {

					$paged = get_query_var( 'page' );
					
				} else {

					$paged = 1;
				}

				if (isset($_GET['s'])) {

					$wp_query = new WP_Query( array(
						's'		=> esc_sql( $_GET['s'] ),
						'paged' => (int) $paged,
					) );
				}
					else {

					$wp_query = new WP_Query( array(
						'post_type' => 'post',
						'paged' => (int) $paged,
					) );
				}

            	echo '<div class="row '.esc_attr($blog_class).'">';
				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) : the_post();

						if ( !function_exists( 'FW' ) ) {

							get_template_part( 'tmpl/content-post-one-col', $wp_query->get_post_format() );
						}
							else {

							set_query_var( 'vibratex_layout', $vibratex_layout );

							if ($vibratex_layout == 'three-cols') {

								get_template_part( 'tmpl/content-post-three-cols', $wp_query->get_post_format() );
							}
								else
							if ($vibratex_layout == 'two-cols') {

								get_template_part( 'tmpl/content-post-two-cols', $wp_query->get_post_format() );
							}
								else {

								set_query_var( 'lte_display_excerpt', true );
								get_template_part( 'tmpl/content-post-one-col', $wp_query->get_post_format() );
							}
						}

						endwhile;

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'tmpl/content', 'none' );

					endif;
				echo '</div>';
				?>
	        </div>
			<?php
			if ( have_posts() ) {

				vibratex_paging_nav();
			}
            ?>	        
	    </div>
	    <?php
	    if ( !$vibratex_sidebar_hidden ) {

            if ( $vibratex_sidebar == 'left' ) {

            	get_sidebar( 'left' );
            }
            	else  {

            	get_sidebar();
            }
	    }
	    ?>
	</div>
</div>
<?php

get_footer();
