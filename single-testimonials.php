<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Template for testimonials inner
 */

get_header();

?>
<div class="team-full lte-text-page inner-page margin-default">
	<?php
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				the_content();

			endwhile;
		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'tmpl/content', 'none' );
		endif;
	?>
</div>
<?php

get_footer();

