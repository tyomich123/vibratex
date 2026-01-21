<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header();

add_filter ('vibratex_copyright_layout', function() { return 'default'; });

?>
<section class="page-404 page-404-default">
	<div class="container">
		<div class="center">				
			<?php
				if ( function_exists('FW') ) {

					$image = fw_get_db_settings_option( '404-img' );
					if ( !empty($image))  {

						echo wp_get_attachment_image($image['attachment_id'], 'full');
					}
				}
			?>
			<div class="heading heading-large color-main">
				<h4><?php echo esc_html__( 'Oops! Page Not Found', 'vibratex' ) ?></h4>
			</div>
			<p class="center-404">
				<?php echo esc_html__( 'The page you are looking for was moved, removed, renamed or might never existed.', 'vibratex' ); ?></strong>
			</p>
			
			
			<div class="lte-empty-space"></div>
			<a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="lte-btn btn-lg btn-black color-hover-main align-center"><span class="lte-btn-inner"><span class="lte-btn-before"></span><?php echo esc_html__( 'Home Page', 'vibratex' ) ?><span class="lte-btn-after"></span></span></a>
		</div>
	</div>
</section>				
<?php

get_footer();

