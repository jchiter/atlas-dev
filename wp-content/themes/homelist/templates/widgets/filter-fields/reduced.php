<?php if ( empty( $instance['hide_reduced'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<div class="checkbox">
			<input type="checkbox" name="filter-reduced" <?php echo ! empty( $_GET['filter-reduced'] ) ? 'checked' : ''; ?> id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_reduced">

			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_reduced">
				<?php echo esc_html__( 'Reduced', 'homelist' ); ?>
			</label>
		</div>
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
