<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Homelist_Widget_Calculator extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct(
			'homelist_calculator',
			__( 'Homelist Mortgage Calculator', 'homelist' ),
			array(
				'description' => __( 'Displays mortgage calculator.', 'homelist' ),
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

        
        <form action="javascript:void(0);" autocomplete="off" class="mortgage-calculator" data-calc-currency="$">
			<div class="input-group">
				<input type="text" class="form-control" id="amount" name="amount" placeholder="<?php echo esc_attr__( 'Sale Price', 'homelist' ); ?>" required="" value="250000">
				<span for="amount" class="input-group-addon" aria-hidden="true"><i class="fa fa-money"></i></span>
			</div>

			<div class="input-group">
				<input type="text" class="form-control" id="downpayment" placeholder="<?php echo esc_attr__( 'Down Payment', 'homelist' ); ?>">
				<span for="downpayment" class="input-group-addon" aria-hidden="true"><i class="fa fa-money"></i></span>
			</div>

			<div class="input-group">
				<input type="text" class="form-control" id="years" placeholder="<?php echo esc_attr__( 'Loan Term (Years)', 'homelist' ); ?>" required="">
				<span for="years" class="input-group-addon" aria-hidden="true"><i class="fa fa-calendar"></i></span>
			</div>

			<div class="input-group">
				<input type="text" class="form-control" id="interest" placeholder="<?php echo esc_attr__( 'Interest Rate', 'homelist' ); ?>" required="">
				<span for="interest" class="input-group-addon" aria-hidden="true"><i class="fa fa-percent"></i></span>
			</div>

			<button class="button calc-button" formvalidate=""><?php echo esc_html__( 'Calculate', 'homelist' ); ?></button>
			<div class="calc-output-container"><div class="notification success"><?php echo esc_html__( 'Monthly Payment:', 'homelist' ); ?> <strong class="calc-output"></strong></div></div>
		</form>

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
