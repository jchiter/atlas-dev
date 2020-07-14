<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>

<div class="page-wrapper">
    <!-- begin:topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php $phone1 = get_theme_mod( 'homelist_contact_phone1' ); ?>
                    <?php $email1 = get_theme_mod( 'homelist_contact_email1' ); ?>
                    <?php if ( ! empty( $phone1 ) || ! empty( $email1 ) ) : ?>
                    <ul class="topbar-nav topbar-left">
                        <li class="disabled"><a href="#"><i class="fa fa-envelope"></i> <?php echo esc_html( $email1 ) ?></a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-phone"></i> <?php echo esc_html( $phone1 ) ?></a></li>
                    </ul>
                    <?php endif; ?>
                    <?php homelist_social_links( 'topbar-nav topbar-right hidden-xs', array( 'fa fa-', '' ) ); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end:topbar -->

    <?php if ( get_theme_mod( 'homelist_general_show_header_contact' ) ) : ?>
    <div class="header-middle header-middle-second bg-white">
        <div class="container header-middle-1">
            <div class="row">
                <div class="col-sm-3 logo-area-2">
                </div>
                <div class="col-sm-9 padd-left">
                    <div class="row">
                        <?php $phone1 = get_theme_mod( 'homelist_contact_phone1' ); ?>
                        <?php $email1 = get_theme_mod( 'homelist_contact_email1' ); ?>
                        <?php if ( ! empty( $phone1 ) || ! empty( $email1 ) ) : ?>
                        <div class="header-info col-xs-4">
                            <ul class="list-inline">
                                <li>
                                    <span class="flaticon-telephone header-icon c-red"></span>
                                </li>
                                <li>
                                    <h2 class="hi-head c-gray">  <?php echo esc_html( $phone1 ) ?></h2>
                                    <h2 class="hi-title f2 "><?php echo esc_html( $email1 ) ?></h2>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php $address1 = get_theme_mod( 'homelist_contact_address1' ); ?>
                        <?php $address2 = get_theme_mod( 'homelist_contact_address2' ); ?>
                        <?php if ( ! empty( $address1 ) || ! empty( $address2 ) ) : ?>
                        <div class="header-info col-xs-4">

                            <ul class="list-inline">
                                <li>
                                    <span class="flaticon-maps-and-flags header-icon c-red"></span>
                                </li>
                                <li>
                                    <h2 class="hi-head fw-5 c-gray"><?php echo esc_html( $address1 ) ?></h2>
                                    <h2 class="hi-title f2 fw-3"><?php echo esc_html( $address2 ) ?></h2>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php $opening_hours = get_theme_mod( 'homelist_contact_opening_hours' ); ?>
                        <?php if ( ! empty( $opening_hours ) ) : ?>
                        <div class="header-info col-xs-4">
                            <ul class="list-inline">
                                <li>
                                    <span class="flaticon-clock header-icon c-red"></span>
                                </li>

                                <li>
                                    <h2 class="hi-head fw-5 c-gray"><?php echo esc_html__( 'Office Hour', 'homelist' ); ?></h2>
                                    <h2 class="hi-title f2 fw-3"><?php echo esc_html( $opening_hours ) ?></h2>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

	<div class="header">
		<nav class="navbar navbar-default">
			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
						<span class="sr-only"><?php echo esc_html__( 'Toggle navigation', 'homelist' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	                    <?php if ( get_theme_mod( 'homelist_general_logo' ) ) : ?>
		                    <img src="<?php echo get_theme_mod( 'homelist_general_logo' ); ?>" height="80" alt="<?php esc_attr_e( 'Home', 'homelist' ); ?>">
	                    <?php else : ?>
		                    <h4 class="site-title"><?php bloginfo( 'name' ); ?></h4>
	                    <?php endif; ?>
                    </a>
				</div>

                <div class="collapse navbar-collapse" id="navbar-top">
                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if ( is_user_logged_in() ) {
                    ?>
                    <li><a href="<?php echo wp_logout_url(); ?>" class="signout"><i class="flaticon-login-3"></i> <?php esc_html_e( 'Sign out', 'homelist' ); ?></a></li>
                    <?php
                    } else {
                    ?>
                    <li><a class="signin" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Login' ) ) ); ?>"><i class="fa flaticon-lock-1"></i> <?php esc_html_e( 'Sign in', 'homelist' ); ?></a></li>
                    <?php if ( get_theme_mod('homelist_allow_register') === 'yes' ) { ?>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Register' ) ) ); ?>" class="signup"><?php esc_html_e( 'Sign up', 'homelist' ); ?></a></li>
                    <?php } ?>
                    <?php
                    }
                    ?>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Create Property' ) ) ); ?>" class="submit-property"><i class="flaticon-right-arrow"></i> <?php esc_html_e( 'Submit Property', 'homelist' ); ?></a></li>
                </ul>
                <?php endif; ?>
				<?php 
                $menu = wp_nav_menu( array(
                    'menu'              => 'primary',
					'menu_id'           => 'primary-menu',
                    'theme_location'    => 'primary',
                    'depth'             => 10,
                    'container'         => 'div',
                    'container_id'      => 'navbar-top-2',
                    'menu_class'        => 'nav navbar-nav navbar-right',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
                );

                ?>

				<?php if ( ! empty( $menu ) ) : ?>
					<?php echo wp_kses( $menu ) ; ?>
				<?php endif; ?>
                </div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
	</div><!-- /.header -->

	<?php if ( ( ! is_front_page() && ! is_page_template( 'template-full-width.php' ) && ! is_page_template( 'template-full-left-right.php' ) ) || is_home() ) : ?>

    <?php
    $background_image = '';
    $background_image = get_post_meta( get_the_ID(), 'property_header_background_image', true );

    if ( ! empty( $background_image ) ) {
        $header_background_image = $background_image;
    } else {
        $background_image = get_header_image();
        if ( ! empty( $background_image ) ) {
            $header_background_image = $background_image;
        } else {
            $header_background_image = '';
        }
    }
    ?>
    <!-- begin:header -->
    <div id="header" class="heading" style="background-image: url(<?php echo esc_url( $header_background_image ); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="page-title">
                        <?php the_homelist_title('<h2>', '</h2>'); ?>
                    </div>
                    <?php if ( homelist_check_realia_plugin( ) ) : ?>
                        <?php echo Realia_Template_Loader::load( 'misc/breadcrumb' ); ?>
                    <?php else: ?>
                        <?php homelist_get_breadcrumb(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end:header -->
    <?php endif; ?>

	<div <?php if ( ! is_front_page() && ! is_page_template( 'template-full-width.php' ) && ! is_page_template( 'template-full-left-right.php' ) ) { ?> id="content" <?php } ?> class="main">
		<?php dynamic_sidebar( 'sidebar-top-fullwidth' ); ?>

		<div class="<?php if ( ! is_page_template( 'template-full-left-right.php' ) ) { ?>container<?php } ?> ">
			<?php get_sidebar( 'top' ); ?>

			<?php if ( ! empty( $_SESSION['messages'] ) && is_array( $_SESSION['messages'] ) ) : ?>
				<?php $_SESSION['messages'] = Realia_Utilities::array_unique_multidimensional( $_SESSION['messages'] );?>

				<div class="alerts notify">
					<?php foreach ( $_SESSION['messages'] as $message ) : ?>
						<div class="alert alert-dismissible alert-<?php echo esc_attr( $message[0] ); ?>">
							<div class="alert-inner">
								<?php echo wp_kses( $message[1], wp_kses_allowed_html( 'post' ) ); ?>

								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="pp pp-normal-circle-cross"></i></button>
							</div><!-- /.alert-inner -->
						</div><!-- /.alert -->
					<?php endforeach; ?>
				</div><!-- /.alerts -->

				<?php unset( $_SESSION['messages'] ); ?>
			<?php endif; ?>
