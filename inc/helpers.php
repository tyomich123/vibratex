<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Helper functions and classes with static methods for usage in theme
 */


/**
 * Display navigation to next/previous set of posts when applicable.
 */ 
if ( ! function_exists( 'vibratex_paging_nav' ) ) {

	function vibratex_paging_nav( $wp_query = null ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {

			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
		'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
		'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '',
			'next_text' => '',
		) );

		if ( $links ) :
		?>
		<div class="clearfix"></div>
		<nav class="navigation paging-navigation">
			<h3 class="screen-reader-text"><?php echo esc_html__( 'Posts navigation', 'vibratex' ); ?></h3>
			<div class="pagination loop-pagination">
				<?php 
				if ( $paged == 1 ) {

					echo '<a href="#" class="prev page-numbers disabled"></a>';
				}

				echo wp_kses( $links, 'links' );
				
				if ( $paged == $wp_query->max_num_pages ) {

					echo '<a href="#" class="next page-numbers disabled"></a>';
				}
				?>
			</div>
		</nav>
		<?php
		endif;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'vibratex_post_nav' ) ) {

	function vibratex_post_nav() {

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '',
		true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="navigation post-navigation clearfix" role="navigation">
			<h3 class="screen-reader-text"><?php echo esc_html__( 'Post navigation', 'vibratex' ); ?></h3>

			<div class="nav-links">
				<?php
					if ( !empty($previous) ) {

						previous_post_link( '%link', esc_html( '%title' ) );
					}

					if ( !empty($next) ) {

						next_post_link( '%link',  esc_html( '%title' ) );
					}
				?>
			</div>
		</nav>
		<?php

	}
}

/**
 * Find out if blog has more than one category.
 *
 * @return boolean true if blog has more than 1 category
 */
function vibratex_categorized_blog() {

	if ( false === ( $all_the_cats = get_transient( 'vibratex_category_count' ) ) ) {

		$all_the_cats = get_categories( array(

			'hide_empty' => 1,
		) );

		$all_the_cats = count( $all_the_cats );

		set_transient( 'vibratex_category_count', $all_the_cats );
	}

	if ( (int)$all_the_cats !== 1 ) {

		return true;
	}
		else {

		return false;
	}
}

