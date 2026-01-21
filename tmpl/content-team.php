<?php
/**
 * The template for displaying posts in the Gallery post format
 */

if ( function_exists( 'FW' ) ) {
	
	$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
	$social_icons = fw_get_db_post_option(get_The_ID(), 'items');
	$cut = fw_get_db_post_option(get_The_ID(), 'cut');
}

?>
<div class="lte-team-item">
	<a href="<?php esc_url( the_permalink() ); ?>" class="lte-image">
        <?php
	        echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'vibratex-team', false  );
        ?>  			
	</a>
	<div class="lte-descr">
	<?php

		$item_cats = wp_get_post_terms( get_the_ID(), 'team-category' );
		$item_term = '';
		if ( $item_cats && !is_wp_error ( $item_cats ) ) {
			
			foreach ($item_cats as $cat) {

				$item_term = $cat->name;
			}
		}

		echo '<a href="'.esc_url( get_the_permalink() ).'"><h4 class="lte-header">'. get_the_title().'</h4></a>';

		if (!empty($subheader)) {

			echo '<div class="lte-subheader color-black">'. wp_kses($subheader, 'header') .'</div>';
		}

		if ( !empty($item_term) ) {

			echo '<p class="lte-subheader">'. wp_kses($item_term, 'header') .'</p>';
		}

		if ( !empty($cut) ) {

			echo '<div class="lte-excerpt">'. esc_html($cut) .'</div>';
		}

		if ( !empty($social_icons) ) {

			echo '<div class="lte-social-wrapper">';
				echo '<span class="lte-social-icon"></span>';
				echo '<ul class="lte-social">';
				foreach ($social_icons as $item) {

					if ( !empty($item['icon-v2']) ) {

						echo '<li><a href="'.esc_url( $item['href'] ).'" class="'.esc_attr( $item['icon'] ) .'"></a></li>';
					}
						else {

						echo '<li><a href="'.esc_url( $item['href'] ).'" class="lte-icon-header">'.esc_html($item['header']).'</a></li>';
					}
				}
				echo '</ul>';
			echo '</div>';
		}		
	?>
	</div>
</div>
