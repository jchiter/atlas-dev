<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<div class="row">
    <section id="primary" class="content-area">
	    <main id="main" class="site-main content" role="main">
		    <?php if ( have_posts() ) : ?>
			    <div class="heading-title heading-title-alt">
				    <?php the_archive_title( '<h3>', '</h3>' ); ?>
				    <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			    </div><!-- .page-header -->

			    <?php
			    /**
			     * realia_before_property_archive
			     */
			    do_action( 'realia_before_property_archive' );
			    ?>

			    <?php if ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) : ?>
				    <div class="property-box-archive">
					    <div class="row">
			    <?php endif; ?>

			    <?php $index = 0; ?>
			    <?php while ( have_posts() ) : the_post(); ?>
				    <?php if ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) : ?>
					    <div class="col-md-3 col-sm-6 col-xs-12">
						    <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
					    </div><!-- /.property-container -->

					    <?php if ( 0 == ( ( $index + 1 ) % 4 ) && Realia_Query::loop_has_next() ) : ?>
						    </div><div class="row">
					    <?php endif; ?>
				    <?php else : ?>
                        <div class="row">
					        <?php echo Realia_Template_Loader::load( 'properties/grid' ); ?>
                        </div>
				    <?php endif; ?>
				    <?php $index++; ?>
			    <?php endwhile; ?>

			    <?php if ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) : ?>
					    </div><!-- /.row -->
				    </div><!-- /.property-box-archive -->
			    <?php endif; ?>

			    <?php
			    /**
			     * realia_after_property_archive
			     */
			    do_action( 'realia_after_property_archive' );
			    ?>

			    <?php the_posts_pagination( array(
				    'prev_text'          => esc_html__( 'Previous page', 'homelist' ),
				    'next_text'          => esc_html__( 'Next page', 'homelist' ),
				    'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'homelist' ) . ' </span>',
			    ) ); ?>
		    <?php else : ?>
			    <?php get_template_part( 'content', 'none' ); ?>
		    <?php endif; ?>

	    </main><!-- .site-main -->
    </section><!-- .content-area -->
</div><!-- /.row -->

<?php get_footer(); ?>
