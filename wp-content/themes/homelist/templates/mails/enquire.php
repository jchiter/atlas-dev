<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( ! empty( $name ) ) : ?>
    <strong><?php echo esc_html__( 'Name', 'homelist' ); ?>: </strong> <?php echo esc_attr( $name ); ?><br>
<?php endif; ?>

    <br>

<?php if ( ! empty( $email ) ) : ?>
    <strong><?php echo esc_html__( 'E-mail', 'homelist' ); ?>: </strong> <?php echo esc_attr( $email ); ?><br>
<?php endif; ?>

    <br>

<?php if ( ! empty( $phone ) ) : ?>
    <strong><?php echo esc_html__( 'Phone', 'homelist' ); ?>: </strong> <?php echo esc_attr( $phone ); ?><br>
<?php endif; ?>

    <br>

<?php $permalink = get_permalink( $post->ID ); ?>
<?php if ( ! empty( $permalink ) ) : ?>
    <strong><?php echo esc_html__( 'URL', 'homelist' ); ?>: </strong> <?php echo esc_attr( $permalink ); ?><br>
<?php endif; ?>

    <br>

<?php if ( ! empty( $_POST['message'] ) ) : ?>
    <?php echo esc_html( $_POST['message'] ); ?>
<?php endif; ?>
