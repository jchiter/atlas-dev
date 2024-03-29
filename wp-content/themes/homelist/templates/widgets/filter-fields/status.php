<?php if ( empty( $instance['hide_status'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-12">
	<div class="form-group">
		<?php if ( 'labels' == $input_titles ) : ?>
			<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_status"><?php echo esc_html__( 'Status', 'homelist' ); ?></label>
		<?php endif; ?>

		<select class="form-control" name="filter-status" id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_status">
			<?php $statuses = get_terms( 'statuses', array( 'hide_empty' => false ) ); ?>

			<option value="">
				<?php if ( 'placeholders' == $input_titles ) : ?>
					<?php echo esc_html__( 'Status', 'homelist' ); ?>
				<?php else : ?>
					<?php echo esc_html__( 'All statuses', 'homelist' ); ?>
				<?php endif; ?>
			</option>

			<?php if ( is_array( $statuses ) ) : ?>
				<?php foreach ( $statuses as $status ) : ?>
					<option value="<?php echo esc_attr( $status->term_id ); ?>" <?php if ( ! empty( $_GET['filter-status'] ) &&  $_GET['filter-status'] == $status->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $status->name ); ?></option>
				<?php endforeach ?>
			<?php endif; ?>
		</select>
	</div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
