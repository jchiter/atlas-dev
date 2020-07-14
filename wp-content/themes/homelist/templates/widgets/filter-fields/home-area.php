<?php if ( empty( $instance['hide_home_area'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_home_area_from"><?php echo esc_html__( 'Home area from', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-home-area-from"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Home area from', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-home-area-from'] ) ? esc_attr( $_GET['filter-home-area-from'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_home_area_from">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->

<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_home_area_to"><?php echo esc_html__( 'Home area to', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-home-area-to"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Home area to', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-home-area-to'] ) ? esc_attr( $_GET['filter-home-area-to'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_home_area_to">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
