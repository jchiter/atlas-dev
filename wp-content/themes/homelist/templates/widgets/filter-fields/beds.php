<?php if ( empty( $instance['hide_beds'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_beds"><?php echo esc_html__( 'Beds', 'homelist' ); ?></label>
		<?php endif; ?>

		<select name="filter-beds"
				id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_beds"
				class="form-control">
			<option value="">
				<?php if ( 'placeholders' == $input_titles ) : ?>
					<?php echo esc_html__( 'Beds: any', 'homelist' ); ?>
				<?php else : ?>
					<?php echo esc_html__( 'Any', 'homelist' ); ?>
				<?php endif; ?>
			</option>

			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<option value="<?php echo esc_attr( $i ); ?>" <?php if ( ! empty( $_GET['filter-beds'] ) && $_GET['filter-beds'] == $i ) : ?>selected="selected"<?php endif; ?>>
					<?php echo esc_attr( $i ); ?>+
				</option>
			<?php endfor; ?>
		</select>
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
