<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

	do_action('vibratex_content_open');	

	$header_class = vibratex_get_pageheader_class();
	$pageheader_layout = vibratex_get_pageheader_layout();
	$pageheader_class = vibratex_get_pageheader_parallax_class();
?>
	<div class="lte-header-wrapper <?php echo esc_attr($header_class .' lte-pageheader-'. $pageheader_layout); ?>">
	<?php
		get_template_part( 'tmpl/navbar' );

		if ( $pageheader_layout != 'disabled' AND $pageheader_layout != 'narrow' ) : ?>
		<header class="<?php echo esc_attr($pageheader_class); ?>">
		    <div class="container">
		    	<?php	
			    	vibratex_the_h1();			
					vibratex_the_breadcrumbs();
				?>
		    </div>
			<?php
				vibratex_the_tagline_header_short();
				vibratex_the_social_header();
			?>
		</header>
		<?php endif; ?>
	</div>