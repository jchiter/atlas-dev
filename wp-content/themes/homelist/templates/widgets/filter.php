<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $input_titles = ! empty( $instance['input_titles'] ) ? $instance['input_titles'] : 'labels'; ?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
    <?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
    <?php echo esc_attr( $instance['title'] ); ?>
    <?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<form method="get" action="<?php echo get_post_type_archive_link( 'property' ); ?>">
	<?php $skip = Realia_Filter::get_field_names(); ?>

	<?php $fields = Realia_Filter::get_fields(); ?>
	<?php if ( ! empty( $instance['sort'] ) ) : ?>
		<?php
		$keys = explode( ',', $instance['sort'] );
		$filtered_keys = array_filter( $keys );
		$fields = array_merge( array_flip( $filtered_keys ), $fields );
		?>
	<?php endif; ?>

	<?php foreach ( $fields as $key => $value ) : ?>
		<?php $template = str_replace( '_', '-', $key ); ?>
		<?php include Realia_Template_Loader::locate( 'widgets/filter-fields/' . $template ); ?>
	<?php endforeach; ?>

	<?php if ( ! empty( $instance['button_text'] ) ) : ?>
        <div class="field col-md-3 col-sm-3 col-xs-6">
		    <div class="form-group">
			    <button class="btn btn-success btn-block"><?php echo esc_attr( $instance['button_text'] ); ?></button>
		    </div><!-- /.form-group -->
        </div><!-- /.col-md-3 -->
	<?php endif; ?>
</form>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
