<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form method="post" action="<?php the_permalink(); ?>" class="login-form">
	<div class="form-group">
		<label for="login-form-username"><?php echo __( 'Username', 'homelist' ); ?><i class="fa fa-user"></i>
		    <input id="login-form-username" type="text" name="login" class="form-control" required="required" placeholder="<?php esc_attr_e( 'Please enter username', 'homelist' ) ?>">
        </label>
	</div><!-- /.form-group -->

	<div class="form-group">
		<label for="login-form-password"><?php echo __( 'Password', 'homelist' ); ?><i class="fa fa-key"></i>
		    <input id="login-form-password" type="password" name="password" class="form-control" required="required" placeholder="<?php esc_attr_e( 'Please enter password', 'homelist' ) ?>">
        </label>
	</div><!-- /.form-group -->

	<button type="submit" name="login_form" class="button-primary"><?php echo __( 'Sign in to your account', 'homelist' ); ?></button>
</form>
