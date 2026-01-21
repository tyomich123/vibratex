<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The sidebar layout for blogs, left position
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="col-xl-3 col-xl-offset-2 col-xl-pull-8 col-lg-4 col-lg-pull-8 col-md-12 col-xs-12 div-sidebar" >
		<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
			<span class="lte-sidebar-close"></span>
		</div>
		<span class="lte-sidebar-filter"></span>
		<span class="lte-sidebar-overlay"></span>			
	</div>
<?php endif; ?>
