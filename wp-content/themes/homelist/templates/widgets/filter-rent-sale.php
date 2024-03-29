<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
$input_titles = ! empty( $instance['input_titles'] ) ? $instance['input_titles'] : 'labels';
$classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
	<?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo esc_attr( $instance['title'] ); ?>
	<?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<div class="main-search">
    <div class="container">
        <div class="row">
            <div class="tabs <?php echo esc_attr( $classes );?>">
	            <ul id="myTab" class="nav nav-tabs nav-justified">

		            <?php
		            /**
		             * realia_before_rent_sale_widget_navigation_items
		             */
		            do_action( 'realia_before_rent_sale_widget_navigation_items', get_the_ID() );
		            ?>

		            <li class="rent <?php if ( empty( $_GET['filter-contract'] ) || 'RENT' == $_GET['filter-contract'] ) : ?>active<?php endif; ?>"><a href="#<?php echo esc_attr( $args['widget_id'] ); ?>-rent" data-toggle="tab"><?php echo esc_html__( 'For Rent', 'homelist' ); ?></a></li>
		            <li class="sale <?php if ( ! empty( $_GET['filter-contract'] ) && 'SALE' == $_GET['filter-contract'] ) : ?>active<?php endif; ?>"><a href="#<?php echo esc_attr( $args['widget_id'] ); ?>-sale" data-toggle="tab"><?php echo esc_html__( 'For Sale', 'homelist' ); ?></a></li>

		            <?php
		            /**
		             * realia_after_rent_sale_widget_navigation_items
		             */
		            do_action( 'realia_after_rent_sale_widget_navigation_items', get_the_ID() );
		            ?>

	            </ul>

	            <?php $fields = Realia_Filter::get_fields(); ?>

	            <div id="myTabContent" class="tab-content">
		            <div class="tab-pane fade in active rent-tab <?php if ( empty( $_GET['filter-contract'] ) || 'RENT' == $_GET['filter-contract'] ) : ?>active<?php endif; ?>" id="<?php echo esc_attr( $args['widget_id'] ); ?>-rent">
			            <form method="get" action="<?php echo get_post_type_archive_link( 'property' ); ?>">
				            <?php $skip = Realia_Filter::get_field_names(); ?>

				            <?php foreach ( $_GET as $key => $value ) : ?>
					            <?php if ( ! in_array( $key, $skip ) ) : ?>
						            <input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>">
					            <?php endif; ?>
				            <?php endforeach; ?>

				            <input type="hidden" name="filter-contract" value="RENT">

				            <?php if ( ! empty( $instance['sort_rent'] ) ) : ?>
					            <?php
					            $keys = explode( ',', $instance['sort_rent'] );
					            $filtered_keys = array_filter( $keys );
					            $fields = array_merge( array_flip( $filtered_keys ), $fields );
					            ?>
				            <?php endif; ?>

				            <?php $field_id_prefix = 'rent_'; ?>
				            <?php foreach ( $fields as $key => $value ) : ?>
					            <?php $template = str_replace( '_', '-', $key ); ?>
					            <?php $instance[ 'hide_' . $key ] = ! empty( $instance[ 'rent_hide_' . $key ] ) ? $instance[ 'rent_hide_' . $key ] : null; ?>
					            <?php include Realia_Template_Loader::locate( 'widgets/filter-fields/' . $template ); ?>
				            <?php endforeach; ?>

				            <?php if ( ! empty( $instance['button_text'] ) ) : ?>
                                <div class="col-md-3 col-sm-3 col-xs-6">
					                <div class="form-group">
                                        <?php if ( 'labels' == $input_titles ) : ?>
                                        <label>&nbsp;</label>
                                        <?php endif; ?>
						                <button class="btn btn-success btn-block"><?php echo esc_attr( $instance['button_text'] ); ?></button>
					                </div><!-- /.form-group -->
                                </div><!-- /.col-md-3 -->
				            <?php endif; ?>
			            </form>
		            </div>

		            <div class="tab-pane fade sale-tab <?php if ( ! empty( $_GET['filter-contract'] ) && 'SALE' == $_GET['filter-contract'] ) : ?>active<?php endif; ?>" id="<?php echo esc_attr( $args['widget_id'] ); ?>-sale">
			            <form method="get" action="<?php echo get_post_type_archive_link( 'property' ); ?>">
				            <?php $skip = Realia_Filter::get_field_names(); ?>

				            <?php foreach ( $_GET as $key => $value ) : ?>
					            <?php if ( ! in_array( $key, $skip ) ) : ?>
						            <input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>">
					            <?php endif; ?>
				            <?php endforeach; ?>

				            <input type="hidden" name="filter-contract" value="SALE">

				            <?php if ( ! empty( $instance['sort_sale'] ) ) : ?>
					            <?php
					            $keys = explode( ',', $instance['sort_sale'] );
					            $filtered_keys = array_filter( $keys );
					            $fields = array_merge( array_flip( $filtered_keys ), $fields );
					            ?>
				            <?php endif; ?>

				            <?php $field_id_prefix = 'sale_'; ?>
				            <?php foreach ( $fields as $key => $value ) : ?>
					            <?php $template = str_replace( '_', '-', $key ); ?>
					            <?php $instance[ 'hide_' . $key ] = ! empty( $instance[ 'sale_hide_' . $key ] ) ? $instance[ 'sale_hide_' . $key ] : null; ?>
					            <?php include Realia_Template_Loader::locate( 'widgets/filter-fields/' . $template ); ?>
				            <?php endforeach; ?>

				            <?php if ( ! empty( $instance['button_text'] ) ) : ?>
                                <div class="field col-md-3 col-sm-3 col-xs-6">
					                <div class="form-group">
                                        <?php if ( 'labels' == $input_titles ) : ?>
                                        <label>&nbsp;</label>
                                        <?php endif; ?>
						                <button class="btn btn-success btn-block"><?php echo esc_attr( $instance['button_text'] ); ?></button>
					                </div><!-- /.form-group -->
                                </div><!-- /.col-md-3 -->
				            <?php endif; ?>
			            </form>
		            </div>
	            </div>
            </div>
        </div>
    </div>
</div>
<!-- end:search -->

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
