<?php get_header(); ?>

<?php 
$display = ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) ? 'grid' : ''; 
$display = get_query_var( 'display', $display );
?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
		<?php dynamic_sidebar( 'sidebar-content-top' ); ?>

		<?php if ( have_posts() ) : ?>
			<?php
			/**
			 * realia_before_property_archive
			 */
			do_action( 'realia_before_property_archive' );
			?>

			<?php if ( $display == 'box' ) : ?>
				<div class="property-box-archive">
					<div class="row">
			<?php endif; ?>

			<?php $index = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
                
				<?php if ( $display == 'box' ) : ?>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
					</div><!-- /.property-container -->

					<?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
						</div><div class="row">
					<?php endif; ?>
				<?php else : ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php global $show_content; ?>
                            <?php $show_content = 'yes'; ?>
					        <?php echo Realia_Template_Loader::load( 'properties/grid' ); ?>
                        </div>
                        <!-- break -->
                    </div>
				<?php endif; ?>
				<?php $index++; ?>

			<?php endwhile; ?>

			<?php if ( $display == 'box' ) : ?>
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
			<?php get_template_part( 'templates/content-search', 'none' ); ?>
		<?php endif; ?>

		<?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
	</div><!-- /.content -->

	<?php get_sidebar(); ?>
</div><!-- /.row -->

<?php get_footer(); ?>
