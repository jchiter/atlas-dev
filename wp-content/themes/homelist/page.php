<?php
/**
 * The template for displaying pages
 */

get_header(); ?>
<!-- begin:content -->
<?php if ( 'posts' == get_option( 'show_on_front' ) || ( ! is_front_page() && ! is_page_template( 'template-full-width.php' ) ) ) : ?>
<div id="content">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php if ( have_posts() ) : ?>
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

	            // Include the page content template.
	            get_template_part( 'templates/content', 'page' );

			    // If comments are open or we have at least one comment, load up the comment template.
			    if ( comments_open() || get_comments_number() ) {
				    comments_template();
			    }

	            // End of the loop.
            endwhile;
            ?>
        <?php else : ?>
	        <?php get_template_part( 'templates/content', 'none' ); ?>
        <?php endif; ?>
        </div>
    </div>
    </div>
</div>
<!-- end:content -->
<?php endif; ?>
<?php get_footer(); ?>
