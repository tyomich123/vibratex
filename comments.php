<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/**
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {

	return;
}

/**
 * Single comment function
 */
if ( !function_exists( 'vibratex_single_comment' ) ) {

	function vibratex_single_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
			case 'pingback' :
				?>
				<li class="trackback">
				<?php
					esc_html_e( 'Trackback:', 'vibratex' );
					comment_author_link();
					edit_comment_link( esc_html__( 'Edit', 'vibratex' ), '<span class="edit-link">', '<span>' );
				break;
			case 'trackback' :
				?>
				<li class="pingback">
				<?php
					esc_html_e( 'Pingback:', 'vibratex' );
					comment_author_link();
					edit_comment_link( esc_html__( 'Edit', 'vibratex' ), '<span class="edit-link">', '<span>' );
				break;
			default :
				$author_id = $comment->user_id;
				$author_link = get_author_posts_url( $author_id );
				?>
				<li <?php comment_class( 'comment_item' ); ?>>
					<article id="comment-<?php comment_ID(); ?>" class="comment-body comment-single">
						<div class="comment-author-avatar">
							<?php
								echo get_avatar( $comment, 64 );
							?>
						</div>
						<div class="comment-content">
							<div class="comment-info">
	                            <span class="comment-date-time">
	                            	<span class="comment-date">
	                            		<span class="date-value">
		                            		<span class="comment_date_value">
		                            		<?php
		                            			echo get_comment_date( get_option( 'date_format' ) );
		                            		?> 
		                            		</span>
			                            	<?php echo esc_html__( 'at', 'vibratex' ); ?>
			                            	<span class="comment-time">
			                            	<?php
			                            		echo get_comment_date( get_option( 'time_format' ) );
			                            	?>
			                            	</span>
		                            	</span>
	                            	</span>
	                            </span>
	                            <h6 class="comment-author">
	                            <?php
                            		echo ( ! empty( $author_id ) ? '<a href="' . esc_url( $author_link ) . '">' : '') . comment_author() . ( ! empty( $author_id ) ? '</a>' : '');
                            	?>
	                            </h6>
								<?php if ( $comment->comment_approved == 0 ): ?>
								<div class="comment_not_approved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'vibratex' ); ?></div>
								<?php endif; ?>	                            
							</div>
							<div class="comment_text_wrap">
								<div class="comment-text"><?php comment_text(); ?></div>
							</div>
							<?php if ( $depth < $args['max_depth'] ): ?>
								<div class="comment-reply">
								<?php
									comment_reply_link( array_merge( $args, array(
									'depth' => $depth,
									'max_depth' => $args['max_depth'],
									) ) );
								?>
								</div>
							<?php endif; ?>
						</div>
					</article>
				<?php
				break;
		}
	}
}

?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php

			if ( get_comments_number() ) {

				echo esc_html( get_comments_number() .' '. _n( 'comment', 'comments', get_comments_number(), 'vibratex' ) );
			}
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'vibratex' ); ?></h3>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'vibratex' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'vibratex' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif;  ?>

		<div class="comments-ol">
			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'callback' => 'vibratex_single_comment',
					) );
				?>
			</ol>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'vibratex' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'vibratex' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'vibratex' ) ); ?></div>
		</nav>
		<?php endif;  ?>

		<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'vibratex' ); ?></p>
		<?php endif; ?>

	<?php endif;  ?>
	<?php
	if ( comments_open() ) :
	?>
		<div class="comments-form-wrap">
			<a class="anchor" id="comments-form"></a>
			<div class="comments-form anchor">
			<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? ' aria-required="true"' : '' );

				$comments_args = array(
					'id_submit' => 'send_comment',
					'label_submit' => esc_html__( 'Post Comment', 'vibratex' ),
					'title_reply' => esc_html__( 'Leave a comment', 'vibratex' ),
					'logged_in_as' => '',
					'comment_notes_before' => '<p class="comments_notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'vibratex' ) . '</p>',
					'comment_notes_after' => '',
					'comment_field' => '<div class="comments-field comments_message">'
						. '<label for="comment" class="required">' . esc_html__( 'Your Message', 'vibratex' ) . '</label>'
						. '<textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'vibratex' ) . '" aria-required="true"></textarea>'
						. '</div>',
					'fields' => apply_filters( 'comment_form_default_fields', array(
						'author' => '<div class="row"><div class="comments-field comments_author col-sm-6">'
						. '<label for="author"' . ( $req ? ' class="required"' : '' ) . '>' . esc_html__( 'Name', 'vibratex' ) . '</label>'
						. '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'vibratex' ) . ( $req ? ' *' : '') . '" value="' . esc_attr( isset( $commenter['comment_author'] ) ? $commenter['comment_author'] : '' ) . '" size="30"' . ($aria_req) . ' />'
						. '</div>',
						'email' => '<div class="comments-field comments_email col-sm-6">'
						. '<label for="email"' . ( $req ? ' class="required"' : '' ) . '>' . esc_html__( 'Email', 'vibratex' ) . '</label>'
						. '<input id="email" name="email" type="text" placeholder="' . esc_attr__( 'Email', 'vibratex' ) . ( $req ? ' *' : '') . '" value="' . esc_attr( isset( $commenter['comment_author_email'] ) ? $commenter['comment_author_email'] : '' ) . '" size="30"' . ($aria_req) . ' />'
						. '</div></div>',
					) ),
				);

				comment_form( $comments_args );
			?>
			</div>
		</div>
	<?php
	endif;
	?>

</div>
