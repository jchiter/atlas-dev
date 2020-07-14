<?php
/*
Template Name: Register Box Template
*/

get_header(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="register-box">
            <div class="register-box-title title">
                <div class="register-title text-left">
                    <?php esc_html_e( 'Create Your Account', 'homelist' ); ?>
                    <small><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Login' ) ) ); ?>"><?php esc_html_e( 'Already have an account?', 'homelist' ); ?></a> </small>
                </div>
            </div>
        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

	            // Include the page content template.
	            get_template_part( 'templates/misc/register' );
	            // End of the loop.
            endwhile;
        ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
