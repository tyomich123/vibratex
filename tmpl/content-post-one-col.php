<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The default template for displaying content classic layout
 *
 * Used for both single and index/archive/search.
 */

$div_class = '';
if ( has_post_thumbnail() OR get_post_format() == 'video' ) {

	$div_class = 'div-thumbnail';
}

if ( function_exists('FW') ) {

	add_filter( 'excerpt_length', function() { return (int)fw_get_db_settings_option( 'excerpt_auto' ); }, 999 );
}

?>
<div class="col-lg-12 col-xs-12 <?php echo esc_attr( $div_class ); ?>">
	<?php get_template_part( 'tmpl/post-formats/list', get_post_format() ); ?>
</div>