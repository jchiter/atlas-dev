<?php if ( empty( $instance['hide_price'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_from"><?php echo esc_html__( 'Price from', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-price-from"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Price from', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-price-from'] ) ? esc_attr( $_GET['filter-price-from'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_from">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_to"><?php echo esc_html__( 'Price to', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-price-to"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Price to', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-price-to'] ) ? esc_attr( $_GET['filter-price-to'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_to">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
