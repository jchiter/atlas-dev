<?php if ( empty( $instance['hide_lot_area'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_lot_area_from"><?php echo esc_html__( 'Lot area from', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-lot-area-from"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Lot area from', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-lot-area-from'] ) ? esc_attr( $_GET['filter-lot-area-from'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_lot_area_from">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->

<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_lot_area_to"><?php echo esc_html__( 'Lot area to', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-lot-area-to"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Lot area to', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-lot-area-to'] ) ? esc_attr( $_GET['filter-lot-area-to'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_lot_area_to">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
