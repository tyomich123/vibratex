<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Services List
 */

$header = get_the_title();
$subheader = fw_get_db_post_option(get_The_ID(), 'header');
$large = get_query_var( 'vibratex-services-large' );
$cut = fw_get_db_post_option(get_The_ID(), 'cut');
$price = fw_get_db_post_option(get_The_ID(), 'price');

$icon = fw_get_db_post_option(get_The_ID(), 'icon');

$item_cats = wp_get_post_terms( get_the_ID(), 'services-category' );

$layout = get_query_var( 'vibratex_services_layout' );

if ( empty($layout) ) {

    $layout = 'photos';
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
    <div class="lte-description">
        <?php
            if ( !empty($icon['icon-class']) ) {

                echo '<a href="'.esc_url( $link ).'" class="lte-icon-wrapper">';

                    echo '<span class="'.esc_attr($icon['icon-class']).'"></span>';

                echo '</a>';
            }

            if ( has_post_thumbnail() ) {

                echo '<a href="'.esc_url( $link ).'" class="lte-photo-wrapper">';


                    if ( $layout == 'bg' ) {

                        the_post_thumbnail( 'vibratex-gallery-big' );
                    }   
                        else {

                        the_post_thumbnail( 'vibratex-services' );
                    }

                echo '</a>';
            }

        ?>
        <span class="lte-info">
            <a href="<?php echo esc_url( $link ); ?>" class="lte-header">
                <?php if ( !empty($subheader) ) { echo '<span class="lte-subheader">'.wp_kses_post($subheader).'</span>'; }  ?>
                <span class="lte-header"><?php echo wp_kses_post($header); ?></span>
            </a>
            <?php
                if ( !empty($cut) ) {

                    echo '<span class="lte-cut">'.wp_kses_post($cut).'</span>';
                }

                if ( $layout == 'photos' ) {

                    $read_more = get_query_var( 'vibratex_read_more' );

                if ( !empty($read_more) ) {

                        echo '<span class="lte-btn-wrap"><a href="'.esc_url( $link ).'" class="lte-more-link">'.esc_html($read_more).'</a></span>';
                    }
                }
            ?>        
        </span>
    </div>
</article>
