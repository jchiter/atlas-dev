<?php if ( empty( $instance['hide_sticky'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<div class="checkbox">
			<input type="checkbox" name="filter-sticky" <?php echo ! empty( $_GET['filter-sticky'] ) ? 'checked' : ''; ?> id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_sticky">

			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_sticky">
				<?php echo esc_html__( 'TOP', 'homelist' ); ?>
			</label>
		</div><!-- /.checkbox -->
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
