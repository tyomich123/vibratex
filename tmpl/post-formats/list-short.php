<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The default template for displaying standard post format
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="lte-description">
        <?php
            vibratex_get_the_post_headline();          
        ?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="lte-header"><h3><?php the_title(); ?></h3></a>
            <?php

                $display_excerpt = 'visible';

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