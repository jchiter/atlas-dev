<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php global $show_content, $show_price; ?>
<?php $instance['per_row'] = ! empty( $instance['per_row'] ) ? $instance['per_row'] : 3; ?>
<?php $show_content = ! empty( $instance['show_content'] ) ? $instance['show_content'] : 'no'; ?>
<?php $show_price = ! empty( $instance['show_price'] ) ? $instance['show_price'] : 'no'; ?>
<?php $instance['fullwidth'] = ( ! empty( $instance['fullwidth'] ) && $instance['fullwidth'] == 'on' ) ? true : false; ?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['classes'] ) ) : ?>
<div class="<?php echo esc_attr( $instance['classes'] ); ?>">
<?php endif; ?>

<?php if ( ! $instance['fullwidth'] ) : ?>
<!-- begin:content -->
<div class="properties_content">
    <div class="container">
<?php endif; ?>

	<?php if ( ! empty( $instance['title'] ) ) : ?>
		<?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
		<?php echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); ?>
		<?php if ( ! empty( $instance['description'] ) ) : ?>
			<small>
				<?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
			</small><!-- /.description -->
		<?php endif; ?>
		<?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php endif; ?>

    <?php
	switch($instance['per_row']) {
		case '1': $class='col-md-12'; break;
		case '2': $class='col-md-6'; break;
		case '3': $class='col-md-4'; break;
		case '4': $class='col-md-3'; break;
	}	
    ?>
	<?php if ( have_posts() ) : ?>

		<div class="type-<?php echo esc_attr( $instance['display'] ); ?> item-per-row-<?php echo esc_attr( $instance['per_row'] ); ?>">
			<?php if ( 1 != $instance['per_row'] ) : ?>
			    <div class="row">
			<?php endif; ?>

			<?php $index = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
                <div class="<?php echo ( $instance['display'] == 'row' ) ? '' : esc_attr( $class ) . ' col-sm-6 col-xs-12'; ?>">
				    <?php $property = get_post( get_the_ID() ); ?>
				    <?php echo Realia_Template_Loader::load( 'properties/' . $instance['display'], array( 'property' => $property ) ); ?>
                </div><!-- /.col-md -->

			<?php if ( 0 == ( ( $index + 1 ) % $instance['per_row'] ) && 1 != $instance['per_row'] && Realia_Query::loop_has_next() ) : ?>
			    </div><div class="row">
			<?php endif; ?>

			<?php $index++; ?>
			<?php endwhile; ?>

			<?php if ( 1 != $instance['per_row'] ) : ?>
			    </div><!-- /.row -->
		    <?php endif; ?>
		</div>
	<?php else : ?>
		<div class="alert alert-warning">
			<?php echo esc_html__( 'No properties found.', 'homelist' ); ?>
		</div><!-- /.alert -->
	<?php endif; ?>

<?php if ( ! $instance['fullwidth'] ) : ?>
    </div>
</div>
<!-- end:content -->
<?php endif; ?>

<?php if ( ! empty( $instance['classes'] ) ) : ?>
</div>
<?php endif; ?>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
