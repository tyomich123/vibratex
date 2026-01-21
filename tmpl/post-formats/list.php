<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The default template for displaying standard post format
 */

$post_class = '';
$display_excerpt = 'visible';
$display_button = 'visible';

$vibratex_layout = get_query_var( 'vibratex_layout' );

if ( empty( $gallery_files ) AND !has_post_thumbnail() ) {

	$post_class .= 'lte-background-no-img';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<?php 

		if ( function_exists( 'FW' ) AND get_post_format() == 'gallery' ) {

			$gallery_files = fw_get_db_post_option(get_The_ID(), 'gallery');
		}	

		if ( !empty( $gallery_files ) AND function_exists('lte_swiper_get_the_container') ) {

			$atts['swiper_arrows'] = 'sides-tiny';
			$atts['swiper_autoplay'] = fw_get_db_settings_option( 'blog_gallery_autoplay' );
		
			echo lte_swiper_get_the_container('lte-post-gallery', $atts, '', ' id="lte-slide-'.get_the_ID().'" ');
			echo '<div class="swiper-wrapper">';

			foreach ( $gallery_files as $item ) {

				echo '<a href="'.esc_url(get_the_permalink()).'" class="swiper-slide">';
					echo wp_get_attachment_image( $item['attachment_id'], 'full' );
				echo '</a>';
			}

			echo '</div>
			</div>
			</div>';
		}
			else
		if ( has_post_thumbnail() ) {

			$vibratex_photo_class = 'lte-photo';
        	
        	$ratio = 'horizontal';

        	$display_excerpt = 'visible';

			$vibratex_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

			if ($vibratex_image_src[2] > $vibratex_image_src[1]) {

				$vibratex_photo_class .= ' vertical';
				$ratio = 'vertical';
			}

			if ( get_post_type() !== 'product' ) {

			    echo '<span class="lte-post-date">';

					vibratex_the_blog_date_large();

				echo '</span>';
			}

		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($vibratex_photo_class).'">';

		    	if ( empty($vibratex_layout) OR $vibratex_layout == 'classic'  ) {

		    		the_post_thumbnail('full');
		    	}
		    		else
		    	if ( $vibratex_layout == 'two-cols'  ) {	    	

		    		the_post_thumbnail();
		    	}
		    		else {

		    		$thumb_size = get_query_var( 'lte_blog_thumb' );
		    		if ( !empty($thumb_size) ) {

	    				the_post_thumbnail($thumb_size);
		    		}
		    			else {

	    				the_post_thumbnail('vibratex-blog');
	    			}
	    		}

	    		echo '<span class="lte-photo-overlay"></span>';

		    echo '</a>';


		}

		if ( empty($vibratex_layout) OR $vibratex_layout == 'classic'  ) {

			$display_excerpt = 'visible';
		}

	?>
    <?php 

		if ( !has_post_thumbnail() ) {

		    echo '<span class="lte-post-date">';

				vibratex_the_blog_date_large();

			echo '</span>';
		}

		vibratex_get_the_cats_archive();
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

			if ( $display_button == 'visible') {

				echo '<span class="lte-btn-wrap">
						<a href="'. esc_url( get_the_permalink() ) .'" class="lte-more-link">'. esc_html__('Read more', 'vibratex') .'</a>
					</span>';
			}
		?>	
					
    </div>    
</article>