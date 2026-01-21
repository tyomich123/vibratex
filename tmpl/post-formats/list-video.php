<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Video Post Format
 */

$post_class = '';
$display_excerpt = 'visible';

$vibratex_layout = get_query_var( 'vibratex_layout' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>	
	<?php
	if ( has_post_thumbnail() ) {

		$vibratex_photo_class = 'lte-photo lte-video-popup swipebox';

		echo '<div class="lte-wrapper">';
		    echo '<a href="'.esc_url(vibratex_find_http(get_the_content())).'" class="'.esc_attr($vibratex_photo_class).'">';

				the_post_thumbnail('full');
				
			    echo '<span class="lte-icon-video"></span>';

		    echo '</a>';
		echo '</div>';
	}
		else {

		if ( !empty(wp_oembed_get(vibratex_find_http(get_the_content()))) ) {

			echo '<div class="lte-wrapper">';
				echo wp_oembed_get(vibratex_find_http(get_the_content()));	
			echo '</div>';
		}
	}

	vibratex_get_the_cats_archive();

	$display_excerpt_q = get_query_var( 'lte_display_excerpt' );
	if ( isset($display_excerpt_q) AND $display_excerpt_q === true ) {

		$display_excerpt = 'visible';
	}

	?>
    <div class="lte-description"> 
        <a href="<?php esc_url( the_permalink() ); ?>" class="lte-header"><h3><?php the_title(); ?></h3></a>
		<?php

			$display_excerpt_q = get_query_var( 'lte_display_excerpt' );

			if ( !empty($display_excerpt_q) OR $display_excerpt_q === false ) {

				if ( $display_excerpt_q === true  ) {

					$display_excerpt = 'visible';
				}
					else {

					$display_excerpt = 'hidden';
				}
			}

			if ( !empty( $display_excerpt ) AND $display_excerpt == 'visible' ) {
	    			echo '<div class="lte-excerpt">';

				set_query_var( 'vibratex_excerpt_activity', 'enable' );

				vibratex_the_excerpt( get_the_content() );

			    set_query_var( 'vibratex_excerpt_activity', 'disable' );

			    echo '</div>';
			}
		?>	
        <?php 
			vibratex_the_post_info();
        ?>    					
    </div>      
</article>