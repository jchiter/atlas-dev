<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package OngoingThemes
 * @subpackage Resta
 * @since Resta 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


	<?php if ( have_comments() ) : ?>
    <div class="blog-comment">
		<h3 class="comment-heading">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'homelist' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'homelist'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ul class="comments">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
                    'callback'    => 'homelist_comment',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ul><!-- .comment-list -->

		<?php the_comments_navigation(); ?>
    </div><!-- .comments-area -->
	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'homelist' ); ?></p>
	<?php endif; ?>


<div class="blog-comment-form">
	<?php
		comment_form( array(
			'title_reply_before' => '<h3 class="comment-heading">',
			'title_reply_after'  => '</h3>',
		) );
	?>
</div>
