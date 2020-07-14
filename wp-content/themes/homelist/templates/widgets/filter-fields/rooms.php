<?php if ( empty( $instance['hide_rooms'] ) ) : ?>
	<?php if ( empty( $instance['hide_rooms'] ) ) : ?>
    <div class="field col-md-3 col-sm-3 col-xs-6">
		<div class="form-group">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>-rooms"><?php echo esc_html__( 'Rooms', 'homelist' ); ?></label>
			<?php endif; ?>

			<select name="filter-rooms"
					id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>-rooms"
					class="form-control">
				<option value="">
					<?php if ( 'placeholders' == $input_titles ) : ?>
						<?php echo esc_html__( 'Rooms: any', 'homelist' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'Any', 'homelist' ); ?>
					<?php endif; ?>
				</option>

				<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
					<option value="<?php echo esc_attr( $i ); ?>" <?php if ( ! empty( $_GET['filter-rooms'] ) && $_GET['filter-rooms'] == $i ) : ?>selected="selected"<?php endif; ?>>
						<?php echo esc_attr( $i ); ?>+
					</option>
				<?php endfor; ?>
			</select>
		</div><!-- /.form-group -->
    </div><!-- /.col-md-3 -->
	<?php endif; ?>
<?php endif; ?>
