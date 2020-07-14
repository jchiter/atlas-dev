<?php
$payment_type = ! empty( $_POST['payment_type'] ) ? $_POST['payment_type'] : null;
$object_id = ! empty( $_POST['object_id'] ) ? $_POST['object_id'] : null;
$title = get_the_title( $object_id );
$variable_symbol = $object_id;
$reference = $title;
?>

<?php if ( 'pay_for_featured' == $payment_type ) : ?>
    <?php $reference = sprintf( esc_html__( 'for featuring property "%s"', 'homelist' ), $title ); ?>
<?php elseif ( 'pay_for_sticky' == $payment_type ) : ?>
    <?php $reference = sprintf( esc_html__( 'for TOP property "%s"', 'homelist' ), $title ); ?>
<?php elseif ( 'pay_per_post' == $payment_type ) : ?>
    <?php $reference = sprintf( esc_html__( 'for publishing property "%s"', 'homelist' ), $title ); ?>
<?php elseif ( 'package' == $payment_type ) : ?>
    <?php $reference = sprintf( esc_html__( 'for package "%s"', 'homelist' ), $title ); ?>
<?php endif; ?>

<div class="wire-transfer">
    <div class=".wire-transfer-section wire-transfer-section-one">
        <div class="wire-transfer-info wire-transfer-account-number">
            <dt><?php echo esc_html__( "Beneficiary's account number", 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_account_number', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-bank-code">
            <dt><?php echo esc_html__( 'Bank code (SWIFT/BIC)', 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_swift', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-variable-symbol">
            <dt><?php echo esc_html__( 'Variable symbol', 'homelist' ); ?></dt>
            <dd><?php echo esc_attr( $variable_symbol ); ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-reference">
            <dt><?php echo esc_html__( 'Information / reference', 'homelist' ); ?></dt>
            <dd><?php echo esc_attr( $reference ); ?></dd>
        </div><!-- /.wire-transfer-info -->
    </div><!-- /.wire-transfer-section -->

    <div class="wire-transfer-section wire-transfer-section-two">
        <div class="wire-transfer-info wire-transfer-full-name">
            <dt><?php echo esc_html__( "Beneficiary's name", 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_full_name', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-street">
            <dt><?php echo esc_html__( 'Street / P.O.Box', 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_street', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-postcode">
            <dt><?php echo esc_html__( 'Postcode (ZIP)', 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_postcode', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-city">
            <dt><?php echo esc_html__( 'City', 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_city', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->

        <div class="wire-transfer-info wire-transfer-country">
            <dt><?php echo esc_html__( 'Country', 'homelist' ); ?></dt>
            <dd><?php echo get_theme_mod( 'realia_wire_transfer_country', null ) ?></dd>
        </div><!-- /.wire-transfer-info -->
    </div><!-- /.wire-transfer-section -->
</div>
