<?php
/**
 * The template for displaying all single posts and attachments
 */

get_header(); ?>
<!-- begin:content -->
<div class="row">
    <!-- begin:article -->
    <div class="col-md-12 single-post">
		<?php
		    // Start the loop.
		    while ( have_posts() ) : the_post();

			    // Include the single post content template.
			    get_template_part( 'templates/content' );

			    // If comments are open or we have at least one comment, load up the comment template.
			    if ( comments_open() || get_comments_number() ) {
				    comments_template();
			    }
                        
			    if ( is_singular( 'attachment' ) ) {
				    // Parent post navigation.
				    the_post_navigation( array(
					    'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'homelist' ),
				    ) );
			    } elseif ( is_singular( 'post' ) ) {
				    // Previous/next post navigation.
                    if ( function_exists('wp_bootstrap_pagination') ) :
                        wp_bootstrap_pagination();
                    endif;
			    }
                        
			    // End of the loop.
		    endwhile;
		?>
    </div>
    <!-- end:article -->
</div>
<!-- end:content -->
<?php get_footer(); ?>
