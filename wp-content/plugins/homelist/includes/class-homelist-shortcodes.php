<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Shortcodes {
	/**
	 * Initialize shortcodes
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
	    add_shortcode( 'homelist_favorite_list', array( __CLASS__, 'favorite_list' ) );
	}

	public static function favorite_list( $atts ) {
		if ( ! is_user_logged_in() ) {
			echo Realia_Template_Loader::load( 'misc/not-allowed' );
			return;
		}
        $paged = ( get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;

		$args = array(
	        'post_type'     => 'property',
	        'post_status'   => 'any',
	        'paged'         => $paged,
			'meta_key'      => '_homelist_like_count',
			'orderby'       => 'meta_value',
			'order'         => 'DESC',
	        'meta_query' => array(
		        array(
			        'key'     => '_homelist_like_count',
			        'value'   => '0',
			        'compare' => '>',
		        ),
	        ),
		);

        $post_like = get_user_meta(get_current_user_id(), 'wp_homelist_user_likes', false);
        if ( ! empty( $post_like ) ) {
	        if ( count( $post_like[0] ) ) {
                $args['post__in'] = $post_like[0];
	        } 
        } else {
		    $args['post__in'] = array(-1);
        }

		query_posts( $args ); ?>

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="row container-homelistate">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php global $show_content; ?>
                        <?php $show_content = 'yes'; ?>
					    <?php echo Realia_Template_Loader::load( 'properties/grid' ); ?>
                    </div>
                    <!-- break -->
                </div>

		    <?php endwhile; ?>
	        <?php the_posts_pagination( array(
		        'prev_text'          => __( 'Previous page', 'homelist' ),
		        'next_text'          => __( 'Next page', 'homelist' ),
		        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'homelist' ) . ' </span>',
	        ) ); ?>

        <?php else : ?>
	        <div class="alert alert-warning">
		        <p><?php echo __( 'You don\'t have any favorite properties, yet.', 'homelist' ); ?></p>
	        </div>
        <?php endif;
        wp_reset_query();

	}

}

Homelist_Shortcodes::init();
