<?php
/*
Template Name: Login Box Template
*/

get_header(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="login-box">
            <div class="login-box-title title">
                <div class="login-title text-left">
                    <?php esc_html_e( 'Welcome Back', 'homelist' ); ?>
                    <small><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Register' ) ) ); ?>"><?php esc_html_e( 'Don\'t have an account?', 'homelist' ); ?></a> </small>
                </div>
                <div class="text-right">
                    <?php esc_html_e( 'Username:', 'homelist' ); ?> <strong>demo</strong> <br>
                    <?php esc_html_e( 'Password:', 'homelist' ); ?> <strong>demo</strong> 
                </div>
            </div>
        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

	            // Include the page content template.
	            get_template_part( 'templates/misc/login' );
	            // End of the loop.
            endwhile;
        ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
