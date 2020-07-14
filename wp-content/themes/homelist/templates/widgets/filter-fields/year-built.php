<?php if ( empty( $instance['hide_year_built'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_year_built"><?php echo esc_html__( 'Year built', 'homelist' ); ?></label>
		<?php endif; ?>

		<input type="number" min="0" name="filter-year-built"
				<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Year built', 'homelist' ); ?>"<?php endif; ?>
		       class="form-control" value="<?php echo ! empty( $_GET['filter-year-built'] ) ? esc_attr( $_GET['filter-year-built'] ) : ''; ?>"
		       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_year_built">
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif;?>
