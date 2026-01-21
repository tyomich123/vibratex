<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Link post format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<div class="lte-wrapper">
		<?php
		    the_content();
		?>
		<cite><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></cite>
	</div>
</article>