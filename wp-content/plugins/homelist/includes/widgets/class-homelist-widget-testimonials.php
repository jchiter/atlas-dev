<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Testimonials extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_testimonials_widget',
			__( 'Homelist Testimonials', 'homelist' ),
			array(
				'description' => __( 'Displays testimonials in multiple ways.', 'homelist' ),
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
		query_posts( array(
			'post_type'         => 'homelist_testimonial',
			'posts_per_page'    => ! empty( $instance['count'] ) ? $instance['count'] : 3,
		) );

        $instance['per_row'] = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 3;
        $instance['display'] = ! empty( $instance['display'] ) ? $instance['display'] : 'style-1';

        global $wp_query; 

        echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) );

        if ( ! empty( $instance['classes'] ) ) : ?>
	        <div class="<?php echo esc_attr($instance['classes']); ?>">
        <?php endif; ?>

        <!-- begin:testimonial -->
        <div id="testimonials" class="container-fluid">
            <div class="container">
                <div class="row">
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

	    switch($instance['per_row']) {
		    case '1': $class='col-md-12'; break;
		    case '2': $class='col-md-6'; break;
		    case '3': $class='col-md-4'; break;
		    case '4': $class='col-md-3'; break;
	    }	
        ?>

        <?php
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $is_realia_active = false;
        if ( is_plugin_active( 'realia/realia.php' ) ) {
            $is_realia_active = true;
        }

        if ( have_posts() ) : ?>
		    <?php while ( have_posts() ) : the_post(); ?>
            <?php if ( $is_realia_active ) : ?>
                <?php include Realia_Template_Loader::locate( 'testimonials/' . $instance['display'] ); ?>
            <?php else: ?>
                <div class="col-sm-6 col-md-4">
                    <div class="testimonial-box">
                        <div class="testimonial-image"><?php the_post_thumbnail( 'full' ); ?></div>
                        <div class="testimonial-title">Great Services!</div>
                        <div class="testimonial-details"><?php echo esc_html( wp_trim_words( get_the_content(), 20, '...' ) ); ?></div>
                        <div class="testimonial-quote-icon"><span class="fa fa-quote-left"></span></div>                    
                        <div class="testimonial-info"><span class="name"><?php the_title() ?></span> - Manager @ Brandio  &nbsp;&nbsp;<ul class="rating-stars"><li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li> <li><i class="fa fa-star"></i></li></ul></div>
                    </div>
                </div>
                <!-- break -->
            <?php endif; ?>
		    <?php endwhile; ?>


        <?php else : ?>
	        <div class="alert alert-warning">
		        <?php echo __( 'No testimonials found.', 'homelist' ); ?>
	        </div><!-- /.alert -->
        <?php endif; ?>

              </div> <!-- end of row -->
          </div> <!-- end of container -->
      </div>

        <?php if ( ! empty( $instance['classes'] ) ) : ?>
	        </div>
        <?php endif; ?>

        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); 

		wp_reset_query();
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
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 3; 
        $per_row = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 1; 
        $display = ! empty( $instance['display'] ) ? $instance['display'] : 'style-1'; 
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


        <!-- COUNT -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
                <?php echo __( 'Count', 'homelist' ); ?>
            </label>

            <input  class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $count ); ?>">
        </p>

        <!-- PER ROW -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'per_row' ) ); ?>">
		        <?php echo __( 'Items per row', 'homelist' ); ?>
	        </label>

	        <select id="<?php echo esc_attr( $this->get_field_id( 'per_row' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'per_row' ) ); ?>">
		        <option value="1" <?php echo ( '1' == $per_row ) ? 'selected="selected"' : ''; ?>>1</option>
		        <option value="2" <?php echo ( '2' == $per_row ) ? 'selected="selected"' : ''; ?>>2</option>
		        <option value="3" <?php echo ( '3' == $per_row ) ? 'selected="selected"' : ''; ?>>3</option>
		        <option value="4" <?php echo ( '4' == $per_row ) ? 'selected="selected"' : ''; ?>>4</option>
		        <option value="6" <?php echo ( '5' == $per_row ) ? 'selected="selected"' : ''; ?>>5</option>
		        <option value="6" <?php echo ( '6' == $per_row ) ? 'selected="selected"' : ''; ?>>6</option>
	        </select>
        </p>

        <!-- DISPLAY -->
        <p>
	        <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>">
		        <?php echo __( 'Display as', 'homelist' ); ?>
	        </label>

	        <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
		        <option value="style-1" <?php echo ( 'style-1' == $display || empty( $display ) ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Style 1', 'homelist' ); ?></option>
		        <option value="style-2" <?php echo ( 'style-2' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Style 2', 'homelist' ); ?></option>
		        <option value="style-3" <?php echo ( 'style-3' == $display ) ? 'selected="selected"' : ''; ?>><?php echo __( 'Style 3', 'homelist' ); ?></option>
	        </select>
        </p>

        <?php
	}
}
