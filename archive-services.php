<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Services template file
 *
 */

$vibratex_sidebar_hidden = true;
$vibratex_sidebar = 'hidden';
$wrap_class = 'col-lg-12 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$vibratex_sidebar = fw_get_db_settings_option( 'services_list_sidebar' );

	if ( $vibratex_sidebar == 'hidden' ) {

		$vibratex_sidebar_hidden = true;
	}


	if ( $vibratex_sidebar == 'left' ) {

		$wrap_class = 'col-xl-8 col-xl-push-4 col-lg-9 col-lg-push-3 col-lg-offset-0 col-md-12 col-xs-12';
	}
}

get_header(); ?>
<div class="lte-services-sc lte-layout-photos inner-page margin-default">
	<div class="row <?php if ( $vibratex_sidebar_hidden ) { echo 'centered'; } ?>">
        <div class="lte-item <?php echo esc_attr( $wrap_class ); ?>">
				<?php

				if ( get_query_var( 'paged' ) ) {

					$paged = get_query_var( 'paged' );

				} elseif ( get_query_var( 'page' ) ) {

					$paged = get_query_var( 'page' );
					
				} else {

					$paged = 1;
				}

				if ( is_tax() || is_category() || is_tag() ) {

					$qobj = get_queried_object();

					$wp_query = new WP_Query(
						array(
							'post_type' => 'services',
							'paged' => (int) $paged,
							'posts_per_page' => -1,
							'tax_query' => array(
							    array(
							      'taxonomy' => $qobj->taxonomy,
							      'field' => 'id',
							      'terms' => $qobj->term_id,
								)
							)							
						)
					);

				}	
					else {

					$wp_query = new WP_Query( array(
						'post_type' => 'services',
						'paged' => (int) $paged,
						'posts_per_page' => -1,
					) );
				}

            	echo '<div class="row">';
				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) :

						the_post();

						echo '<div class="col-lg-3">';
							get_template_part( 'tmpl/content-services' );
						echo '</div>';

					endwhile;

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'tmpl/content', 'none' );
				endif;
				echo '</div>';
				?>
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
