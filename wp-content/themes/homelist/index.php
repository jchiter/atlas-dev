<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
    <?php if ( 'posts' == get_option( 'show_on_front' ) || ( ! is_front_page() && ! is_page_template( 'template-full-width.php' ) ) ) : ?>
    <div id="content">
        <div class="row">
	        <div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
		        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

		        <?php if ( have_posts() ) : ?>
			        <?php while ( have_posts() ) : the_post(); ?>
				        <?php get_template_part( 'templates/content', get_post_format() ); ?>
			        <?php endwhile; ?>

			        <?php the_posts_navigation(); ?>
		        <?php else : ?>
			        <?php get_template_part( 'templates/content', 'none' ); ?>
		        <?php endif; ?>

		        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	        </div><!-- /.content -->

	        <?php get_sidebar(); ?>
        </div><!-- /.row -->
    </div><!-- /.content -->
    <?php endif; ?>
<?php else : ?>
	<?php get_template_part( 'templates/content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
