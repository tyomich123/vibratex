<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Services List
 */

$header = get_the_title();

$course = learn_press_get_course();

$icons = fw_get_db_post_option(get_The_ID(), 'items');

$cut = get_the_excerpt();

$item_cats = wp_get_post_terms( get_the_ID(), 'course_category' );

$layout = get_query_var( 'vibratex_services_layout' );
if ( empty($layout) ) {

    $layout = 'default';
}

if ( !empty($item_cats) ) {

	$item_cat = $item_cats[0]->name;
}

$link = fw_get_db_post_option(get_The_ID(), 'link');

if ( empty($link) ) {

    $link = get_the_permalink();
}       

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('lte-services-grid-item'); ?>>
 	<a href="<?php echo esc_url( $link ); ?>" class="lte-image">
		<?php

            if ( $layout == 'circles' OR $layout == 'images' ) {

                the_post_thumbnail('vibratex-gallery-big');
            }
                else {

                the_post_thumbnail('vibratex-blog');
            }

        ?>
		<span class="lte-photo-overlay"></span>
	</a>
    <?php
    
        if ( !empty($item_cat) ) echo '<span class="lte-cats">'.esc_html($item_cat).'</span>';
    ?>
    <?php

        if ( !empty($course->get_price_html()) ) {

            echo '<span class="lte-price"><span><span>'.wp_kses_post($course->get_price_html()).'</span></span></span>';
        }
    ?>
    <div class="lte-description">
        <?php

        if ( !empty($icons) ) {

            echo '<div class="lte-icons">';
            $x = 0;
            foreach ( $icons as $item ) {

                if ( !empty($item['icon']['icon-class']) ) {

                    echo '<span class="'.esc_attr($item['icon']['icon-class']).'"><span>'.esc_html($item['text']).'</span></span>';
                }
            }
            echo '</div>';
        }

        ?>
        <a href="<?php echo esc_url( $link ); ?>" class="lte-header">
            <h5 class="lte-header"><?php echo wp_kses_post($header); ?></h5>
        </a>
        <?php
            if ( !empty($subheader)) {

                echo '<h6 class="lte-subheader">'. esc_html($subheader).'</h6>';
            }

            if ( !empty($cut) ) {

                echo '<span class="lte-cut">'.wp_kses_post($cut).'</span>';
            }

            echo '<div><a href="'.esc_url( $link ).'" class="lte-more-link">'.esc_html__( 'Read More', 'vibratex' ).'</a></div>';

        ?>        
    </div>
</article>
