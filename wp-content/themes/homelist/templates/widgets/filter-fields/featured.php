<?php if ( empty( $instance['hide_featured'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<div class="checkbox">
			<input type="checkbox" name="filter-featured" <?php echo ! empty( $_GET['filter-featured'] ) ? 'checked' : ''; ?> id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_featured">

			<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_featured">
				<?php echo esc_html__( 'Featured', 'homelist' ); ?>
			</label>
		</div><!-- /.checkbox -->
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
