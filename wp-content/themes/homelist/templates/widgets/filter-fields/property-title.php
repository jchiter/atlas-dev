<?php if ( empty( $instance['hide_property_title'] ) ) : ?>
<div class="field col-md-3 col-sm-3 col-xs-6">
    <div class="form-group">
        <?php if ( 'labels' == $input_titles ) : ?>
            <label for="<?php echo esc_attr( $args['widget_id'] ); ?>_property_title"><?php echo esc_html__( 'Property title', 'homelist' ); ?></label>
        <?php endif; ?>

        <input type="text" name="filter-property-title" class="form-control"
               <?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php esc_attr_e( 'Property title', 'homelist' ); ?>"<?php endif; ?>
               value="<?php echo ! empty( $_GET['filter-property-title'] ) ? esc_attr( $_GET['filter-property-title'] ) : ''; ?>"
               id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_property_title">
    </div><!-- /.form-group -->
</div><!-- /.col-md-3 -->
<?php endif; ?>
