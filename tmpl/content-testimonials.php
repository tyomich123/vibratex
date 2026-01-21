<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
	Testimonials Single Item
 */

$rate_display = false;
$subheader_display = false;
$photo_display = true;



$class = '';
if ( function_exists( 'FW' ) ) {

	$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
	$rate = fw_get_db_post_option(get_The_ID(), 'rate');	
	$short = fw_get_db_post_option(get_The_ID(), 'short');	

	$sc = get_query_var( 'lte-testimonials-sc' );
	$sc_cut = get_query_var( 'lte-testimonials-sc-cut' );

	$subheader_switch = get_query_var( 'lte-testimonials-subheader' );
	if ( !empty($subheader_switch) AND $subheader_switch == 1 ) {

		$subheader_display = true;
	}

	$readmore = get_query_var( 'lte-testimonials-readmore' );

	$photo_switch = get_query_var( 'lte-testimonials-photo' );

	if ( !empty($photo_switch) AND $photo_switch == 1 ) {

		$photo_display = true;
	}

	if ( !empty($short) AND empty($sc) ) {

		$class = ' lte-short';
	}

	$link = fw_get_db_post_option(get_The_ID(), 'link');

	if ( empty($link) ) {

	    $link = get_the_permalink();
	}   	

	if ( !$sc ) {

		$photo_display = false;
		$class .= ' showHeader';
		$sc_cut = 70;
	}
}

?>
<div class="lte-inner <?php echo esc_attr($class); ?>">
	<?php

		$photo_display = true;

		if ( !empty($rate_display) ) {

			echo '<div class="rate">';
			for ($x = 1; $x<= (int)($rate); $x++) {

				echo '<span class="fa fa-star"></span>';
			}
			echo '</div>';
		}

		echo '<div class="lte-descr">';

			echo '<span class="lte-testimonials-quote"><span></span><span></span></span>';
			echo '<span class="lte-triangle"></span>';

			if ( !empty($sc_cut) ) {

				echo '<p>'. vibratex_cut_words(get_the_content(), $sc_cut, '.') .'</p>';
			}
				else {

				echo '<p>'. get_the_content() .'</p>';
			}
		echo '</div>';

		if ( has_post_thumbnail() AND !empty($photo_display) AND ( empty($short) OR !empty($sc) ) ) {

			echo '<div class="lte-image">';
				the_post_thumbnail('vibratex-tiny-square');
			echo '</div>';
		}

		echo '<div class="lte-testimotials-author-wrap">';
		
		echo '<div class="lte-header">'. get_the_title() .'</div>';

		if ( !empty($subheader_display) AND !empty($subheader) ) {

			echo '<div class="lte-subheader">'. wp_kses($subheader, 'header') .'</div>';
		}
		
		echo '</div>';

		if ( !empty($readmore) ) {

			echo '<a class="lte-more-link" href="'.esc_url($link).'">'.esc_html($readmore).'</a>';
		} 
	?>
</div>
