<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Popular_Posts extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_popular_posts',
			__( 'Homelist Popular Posts', 'homelist' ),
			array(
				'description' => __( 'Displays popular posts.', 'homelist' ),
			)
		);
	}

	/**
	 * Frontend
	 *
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
        
        echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) );

        if ( ! empty( $instance['classes'] ) ) : 
        ?>
	        <div class="<?php echo esc_attr($instance['classes']); ?>">
        <?php 
        endif;
        ?>

        <?php
        if ( ! empty( $instance['title'] ) ) : 
            echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); 
	        echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); 
	        if ( ! empty( $instance['description'] ) ) : ?>
		        <small>
			        <?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
		        </small><!-- /.description -->
	        <?php endif;

            echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); 
        endif; 
        ?>


        <?php
		$current_post = array(get_the_ID());		
		$query_args = array('post_type' => 'post', 'suppress_filters' => false);
		$query_args['posts_per_page'] = $num_fetch;
		$query_args['orderby'] = 'comment_count';
		$query_args['order'] = 'desc';
		$query_args['paged'] = 1;
		$query_args['category_name'] = $category;
		$query_args['ignore_sticky_posts'] = 1;
		$query_args['post__not_in'] = array(get_the_ID());
		$query = new WP_Query( $query_args );
			
		if($query->have_posts()){
			echo '<div class="widget-posts">';
			echo '<ul>';
			while($query->have_posts()){ $query->the_post();
            ?>		
			<li class="img-cap-effect">
				<div class="img-box">
                <?php if(has_post_thumbnail()){ 
                    the_post_thumbnail( 'thumbnail' );
                } ?>
				</div>
				<div class="content">
					<a href="<?php the_permalink(); ?>"><h4><?php echo wp_trim_words(get_the_title(),3,'...'); ?></h4></a>
					<span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
				</div>
			</li>						
            <?php
			}
            echo '</ul>';
			echo '</div>';
		}
		wp_reset_postdata();
        ?>


        <?php if ( ! empty( $instance['classes'] ) ) : ?>
	        </div>
        <?php endif; ?>


        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); 
	}

	/**
	 * Update
	 *
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Backend
	 *
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {

    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
    $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';

    ?>

    <!-- TITLE -->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
            <?php echo __( 'Title', 'homelist' ); ?>
        </label>

        <input  class="widefat"
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                type="text"
                value="<?php echo esc_attr( $title ); ?>">
    </p>

    <!-- DESCRIPTION -->
    <p>
	    <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
		    <?php echo __( 'Description', 'homelist' ); ?>
	    </label>

	    <textarea class="widefat"
	              rows="4"
	              id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
	              name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
    </p>

    <!-- CLASSES -->
    <p>
	    <label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
		    <?php echo __( 'Classes', 'homelist' ); ?>
	    </label>

	    <input  class="widefat"
	            id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
	            name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
	            type="text"
	            value="<?php echo esc_attr( $classes ); ?>">
	    <br>
	    <small><?php echo __( 'Additional classes e.g. <i>fullwidth background-gray</i>', 'homelist' ); ?></small>
    </p>

    <?php
	}
}
