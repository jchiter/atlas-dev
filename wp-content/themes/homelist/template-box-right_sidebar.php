<?php

/*
Template Name: Right Sidebar
*/

get_header(); ?>

<div class="row">
    <div class="col-md-9">
        <div class="content-box">
        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

	            // Include the page content template.
	            get_template_part( 'templates/content', 'page' );
	            // End of the loop.
            endwhile;
        ?>
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
