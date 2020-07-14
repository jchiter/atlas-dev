<?php
function homelist_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<?php esc_html__( 'Pingback:', 'homelist' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'homelist' ), '<span class="edit-link">', '</span>' ); ?>
	</li>
	<?php
		break;

		default :
		    global $post;
	?>
    <li class="clearfix" id="comment-<?php echo esc_html($comment->comment_ID); ?>">
        <?php echo get_avatar( $comment, 96 ); ?>
        <div class="post-comments">
            <p class="meta"><?php echo get_comment_date() .  esc_html__( ' at ', 'homelist' ) . get_comment_time() ?> <?php echo get_comment_author_link(); ?> says : <i class="pull-right"><?php edit_comment_link(esc_html__( 'Edit', 'homelist' ), '<small>', '</small>'); ?> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'homelist' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></i></p>
            <p><?php comment_text(); ?></p>
        </div>
    
	<?php
		break;
	}
}

add_filter( 'comment_form_default_fields', 'homelist_comment_form_fields' );
function homelist_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="row"><div class="col-md-6 col-sm-6 col-xs-12"><div class="form-group">' . '<label for="author">' . esc_html__( 'Name', 'homelist' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control input-lg" id="author" name="author" type="text" placeholder="' . esc_html__( 'Your name : ', 'homelist' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'email'  => '<div class="col-md-6 col-sm-6 col-xs-12"><div class="form-group"><label for="email">' . esc_html__( 'Your email : ', 'homelist' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control input-lg" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your E-Mail', 'homelist' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div></div>',
        'url'    => ''
    );
    
    return $fields;
}

add_filter( 'comment_form_defaults', 'homelist_comment_form' );
function homelist_comment_form( $args ) {
    $args['comment_field'] = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group">
            <label for="comment">' . esc_html__( 'Comment', 'homelist' ) . '</label> 
            <textarea class="form-control input-lg" id="comment" name="comment" cols="45" placeholder="' . esc_html__( 'Your comment : ', 'homelist' ) . '" rows="8" aria-required="true"></textarea>
        </div></div></div>';
    $args['class_submit'] = 'btn btn-success btn-lg';
    
    return $args;
}

function homelist_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'homelist_move_comment_field_to_bottom' );

?>