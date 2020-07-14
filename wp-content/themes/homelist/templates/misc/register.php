<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( get_option( 'users_can_register' ) ) : ?>
	<form method="post" action="<?php the_permalink(); ?>" class="register-form">
		<div class="form-group">
			<label for="register-form-name"><?php echo __( 'Username', 'homelist' ); ?><i class="fa fa-user"></i>
			    <input id="register-form-name" type="text" name="name" class="form-control" required="required" placeholder="<?php esc_attr_e( 'Please enter a valid username', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-email"><?php echo __( 'E-mail', 'homelist' ); ?><i class="fa fa-at"></i>
			    <input id="register-form-email" type="email" name="email" class="form-control" required="required" placeholder="<?php esc_attr_e( 'Please enter a valid e-mail address', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-first-name"><?php echo __( 'First name', 'homelist' ); ?><i class="fa fa-user"></i>
			    <input id="register-form-first-name" type="text" name="first_name" class="form-control" placeholder="<?php esc_attr_e( 'Please enter your first name', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-last-name"><?php echo __( 'Last name', 'homelist' ); ?><i class="fa fa-user"></i>
			    <input id="register-form-last-name" type="text" name="last_name" class="form-control" placeholder="<?php esc_attr_e( 'Please enter your last name', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-phone"><?php echo __( 'Phone', 'homelist' ); ?><i class="fa fa-phone"></i>
			    <input id="register-form-phone" type="text" name="phone" class="form-control" placeholder="<?php esc_attr_e( 'Please enter your phone', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-password"><?php echo __( 'Password', 'homelist' ); ?><i class="fa fa-key"></i>
			    <input id="register-form-password" type="password" name="password" class="form-control" required="required" placeholder="<?php esc_attr_e( 'Please enter a valid password', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<div class="form-group">
			<label for="register-form-retype"><?php echo __( 'Retype Password', 'homelist' ); ?><i class="fa fa-key"></i>
			    <input id="register-form-retype" type="password" name="password_retype" class="form-control" required="required" placeholder="<?php esc_attr_e( 'Please enter a valid password', 'homelist' ) ?>">
            </label>
		</div><!-- /.form-group -->

		<?php $terms = get_theme_mod( 'realia_submission_terms' ); ?>

		<?php if ( ! empty( $terms ) ) : ?>
			<div class="checkbox terms-conditions-input">
				<input id="register-form-conditions" type="checkbox" name="agree_terms">

				<label for="register-form-conditions">
					<?php echo sprintf( __( 'I agree with <a href="%s">terms & conditions</a>', 'homelist' ), get_permalink( $terms ) ); ?>
				</label>
			</div><!-- /.form-group -->
		<?php endif; ?>

		<button type="submit" class="button-primary" name="register_form"><?php echo __( 'Sign Up', 'homelist' ); ?></button>
	</form>
<?php else: ?>
	<div class="alert alert-warning">
		<?php echo __( 'Registrations are not allowed.', 'homelist' ); ?>
	</div><!-- /.alert -->
<?php endif; ?>
