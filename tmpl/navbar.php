<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Navigation Bar
 */
$navbar_logo = $navlogo_class = $navbar_affix = '';
$navbar_color = 'black';
$navbar_layout = 'default';
$navbar_class = 'lte-navbar-items navbar-mobile-black navbar-collapse collapse';
$navbar_mobile_width = '1198';
$navbar_wrapper_class = array();

if ( function_exists( 'FW' ) ) {

	$navbar_affix = fw_get_db_settings_option( 'navbar-affix' );
	$navbar_breakpoint = fw_get_db_settings_option( 'navbar-breakpoint' );

	$navbar_hide_icons = fw_get_db_settings_option( 'hide-navbar-icons' );

	if ( !empty($navbar_breakpoint) ) {

		$navbar_mobile_width = $navbar_breakpoint;
	}

	// Current navbar layout
	$get_layout = vibratex_get_navbar_layout($navbar_layout);

	if ( is_array( $get_layout) ) {

		list($navbar_color_set, $navbar_layout_set) = $get_layout;
	}
		else {

		$navbar_layout_set = $get_layout;
	}

	if ( !empty( $navbar_color_set ) ) {

		$navbar_color = $navbar_color_set;
	}

	if ( !empty( $navbar_layout_set ) ) {

		$navbar_layout = $navbar_layout_set;
	}

	$navbar_logo = $navbar_color;

	if ( in_array( $navbar_layout, [ 'full-width', 'hamburger', 'hamburger-transparent', 'hamburger-left', 'transparent-left' ] ) ) {

		$navbar_mobile_width = '4000';
	}
}

$navbar_wrapper_class[] = 'lte-layout-'.$navbar_layout;
$navbar_wrapper_class[] = 'lte-nav-color-'.$navbar_color;

$navbar_layout = apply_filters ('vibratex_navbar_layout', $navbar_layout);

$topbar_offset = 0;
if ( $navbar_layout != 'disabled' ):

	if ( vibratex_the_topbar_block( $navbar_layout ) ) {

		$topbar_offset = 50;
	} 

?>
<div id="lte-nav-wrapper" class="<?php echo esc_attr(implode(' ', $navbar_wrapper_class));?>">
	<nav class="lte-navbar" data-spy="<?php echo esc_attr($navbar_affix); ?>" data-offset-top="<?php echo esc_attr($topbar_offset); ?>">
		<div class="container">	
			<div class="lte-navbar-logo">	
				<?php
					vibratex_the_logo($navbar_logo);

					if ( $navbar_layout == 'hamburger-transparent' ) {

						echo '<div class="lte-logo-dark">';
							vibratex_the_logo();
						echo '</div>';
					}					
				?>
			</div>	
			<?php
				if ( in_array($navbar_layout, ['desktop-center', 'desktop-center-transparent']) ) {

					echo vibratex_the_navbar_search($navbar_layout);
				}
			?>			
			<div class="<?php echo esc_attr( $navbar_class ); ?>" data-mobile-screen-width="<?php echo esc_attr( $navbar_mobile_width ); ?>">
				<div class="toggle-wrap">
					<?php
						vibratex_the_logo('white');
					?>						
					<button type="button" class="lte-navbar-toggle collapsed">
						<span class="close">&times;</span>
					</button>							
					<div class="clearfix"></div>
				</div>
				<?php
					vibratex_get_menu();
				?>
				<div class="lte-mobile-controls">
					<?php
						echo vibratex_the_navbar_icons( $navbar_layout, true );
					?>				
				</div>				
			</div>
			<?php			
				if ( !in_array($navbar_layout, ['desktop-center', 'desktop-center-transparent']) ) {
				
					vibratex_the_navbar_icons_add();
				}

				if ( empty($navbar_hide_icons) ) {

					vibratex_the_navbar_icons();
				}
			?>		
			<button type="button" class="lte-navbar-toggle">
				<span class="icon-bar top-bar"></span>
				<span class="icon-bar middle-bar"></span>
				<span class="icon-bar bottom-bar"></span>
			</button>			
		</div>
	</nav>
</div>
<?php

endif;

