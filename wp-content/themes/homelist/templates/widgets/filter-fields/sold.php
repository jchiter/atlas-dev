<?php if ( empty( $instance['hide_sold'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<div class="checkbox">
			<input type="checkbox" name="filter-sold" <?php echo ! empty( $_GET['filter-sold'] ) ? 'checked' : ''; ?> id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_sold">

			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_sold">
				<?php echo esc_html__( 'Sold', 'homelist' ); ?>
			</label>
		</div><!-- /.checkbox -->
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
