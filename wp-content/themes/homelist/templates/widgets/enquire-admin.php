<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
<?php $receive_admin = ! empty( $instance['receive_admin'] ) ? $instance['receive_admin'] : ''; ?>
<?php $receive_author = ! empty( $instance['receive_author'] ) ? $instance['receive_author'] : ''; ?>
<?php $receive_agent = ! empty( $instance['receive_agent'] ) ? $instance['receive_agent'] : ''; ?>
<?php $disable_recaptcha = ! empty( $instance['disable_recaptcha'] ) ? $instance['disable_recaptcha'] : ''; ?>

<!-- TITLE -->
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php echo esc_html__( 'Title', 'homelist' ); ?>
    </label>


    <input  class="widefat"
            id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
            type="text"
            value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
	<strong><?php echo esc_html__( 'Who will receive an e-mail?', 'homelist' ); ?></strong><br>
</p>

<p>
    <!-- RECEIVE ADMIN -->
    <input  type="checkbox"
            class="checkbox"
            <?php echo ! empty( $receive_admin ) ? 'checked="checked"' : ''; ?>
            id="<?php echo esc_attr( $this->get_field_id( 'receive_admin' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'receive_admin' ) ); ?>">

    <label for="<?php echo esc_attr( $this->get_field_id( 'receive_admin' ) ); ?>">
        <?php echo esc_html__( 'Site admin', 'homelist' ); ?>
    </label>

    <br>

    <!-- RECEIVE AUTHOR -->
    <input  type="checkbox"
            class="checkbox"
            <?php echo ! empty( $receive_author ) ? 'checked="checked"' : ''; ?>
            id="<?php echo esc_attr( $this->get_field_id( 'receive_author' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'receive_author' ) ); ?>">

    <label for="<?php echo esc_attr( $this->get_field_id( 'receive_author' ) ); ?>">
        <?php echo esc_html__( 'Property author', 'homelist' ); ?>
    </label>

	<br>

    <!-- RECEIVE AGENT -->
    <input  type="checkbox"
            class="checkbox"
            <?php echo ! empty( $receive_agent ) ? 'checked="checked"' : ''; ?>
            id="<?php echo esc_attr( $this->get_field_id( 'receive_agent' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'receive_agent' ) ); ?>">

    <label for="<?php echo esc_attr( $this->get_field_id( 'receive_agent' ) ); ?>">
        <?php echo esc_html__( 'Assigned agent', 'homelist' ); ?>
    </label>

    <br>

   	<small><?php echo esc_html__( 'If none selected, post author will receive an email by default.', 'homelist' ); ?></small>
</p>

<p>
    <!-- DISABLE RECAPTCHA -->
    <input  type="checkbox"
            class="checkbox"
            <?php echo ! empty( $disable_recaptcha ) ? 'checked="checked"' : ''; ?>
            id="<?php echo esc_attr( $this->get_field_id( 'disable_recaptcha' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'disable_recaptcha' ) ); ?>">

    <label for="<?php echo esc_attr( $this->get_field_id( 'disable_recaptcha' ) ); ?>">
        <?php echo esc_html__( 'Disable reCAPTCHA', 'homelist' ); ?>
    </label>
</p>
