<?php

/*
Template Name: Left Sidebar
*/

get_header(); ?>

<!-- begin:content -->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
		    <?php if ( have_posts() ) : 
                global $post;
                $args = array( 'posts_per_page' => 5 );
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) : 
                    setup_postdata( $post ); 
				    get_template_part( 'template-parts/content', get_post_format() );
			    // End the loop.
                endforeach;
                wp_reset_postdata();

			    // Previous/next page navigation.
                if ( function_exists('wp_bootstrap_pagination') ) :
                    wp_bootstrap_pagination();
                endif;

		    // If no content, include the "No posts found" template.
		    else :
			    get_template_part( 'template-parts/content', 'none' );

		    endif;
		    ?>
            </div>
            <?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	            <div class="col-md-3 col-md-pull-9 sidebar">
		            <?php dynamic_sidebar( 'sidebar-1' ); ?>
	            </div><!-- .sidebar .widget-area -->
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- end:content -->

<?php get_footer(); ?>
