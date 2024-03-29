<ol class="breadcrumb">
	<?php if ( is_front_page() ) :   ?>
		<li><?php echo esc_html__( 'Home', 'homelist' ); ?></li>
		<li><?php bloginfo( 'name' ); ?></li>
	<?php elseif ( is_home() ) : ?>
        <li><a href="<?php echo site_url(); ?>"><?php echo esc_html__( 'Blog', 'homelist' ); ?></a></li>
	<?php elseif ( ! is_home() ) : ?>
        <li><a href="<?php echo site_url(); ?>"><?php echo esc_html__( 'Home', 'homelist' ); ?></a></li>

        <?php if ( is_archive() && is_tax() ) : ?>
        	<?php if ( is_tax() ) : ?>
        		<?php
	        	global $wp_query;
				$tax = $wp_query->get_queried_object();
				$term = get_term_by( 'slug', get_query_var( 'term' ), $tax->taxonomy );
				$ancestors = get_ancestors( $term->term_id, $tax->taxonomy );
				?>

				<?php if ( is_array( $ancestors ) ) : ?>
					<?php foreach ( array_reverse( $ancestors ) as $ancestor ) : ?>
						<li>
							<?php $term = get_term( $ancestor, $tax->taxonomy ); ?>
							<a href="<?php echo get_term_link( $term->term_id, $tax->taxonomy ); ?>"><?php echo esc_attr( $term->name ); ?></a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>

				<li><?php echo single_cat_title(); ?></li>
        	<?php else : ?>
	        	<li><?php echo single_cat_title(); ?></li>
	        <?php endif; ?>
        <?php elseif ( is_category() ) : ?>
    		<li>
                <a href="<?php echo get_post_type_archive_link( get_post_type() ); ?>">
                    <?php echo get_post_type_object( get_post_type() )->labels->name; ?>
                </a>
            </li>

        	<li><?php single_cat_title(); ?></li>	        
        <?php elseif ( is_archive() ) : ?>
        	<li><?php post_type_archive_title(); ?></li>
        <?php endif; ?>

        <?php if ( is_category() || is_single() ) : ?>
            <?php if ( is_single() ) : ?>
				<li><?php the_title(); ?></li>
            <?php endif; ?>
        <?php elseif ( is_404() ) : ?>
        	<li><?php echo esc_html__( 'Page not found', 'homelist' ); ?></li>
        <?php elseif ( is_page() ) :   ?>
                <li><?php the_title(); ?></li>
        <?php endif; ?>
	<?php elseif ( is_tag() ) : ?>
		<li><?php single_tag_title() ?></li>
	<?php elseif ( is_day() ) : ?>
		<li><?php echo esc_html__( 'Archive for', 'homelist' ); ?>  <?php the_time( 'F jS, Y' ); ?></li>
	<?php elseif ( is_month() ) :   ?>
		<li><?php echo esc_html__( 'Archive for', 'homelist' ); ?>  <?php the_time( 'F, Y' ); ?></li>
	<?php elseif ( is_year() ) : ?>
		<li><?php echo esc_html__( 'Archive for', 'homelist' ); ?>  <?php the_time( 'Y' ); ?></li>
	<?php elseif ( is_author() ) :   ?>
		<li><?php echo esc_html__( 'Author Archive', 'homelist' ); ?></li>
	<?php elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) : ?>
		<li><?php echo esc_html__( 'Blog Archives', 'homelist' ); ?></li>
	<?php elseif ( is_search() ) : ?>
		<li><?php echo esc_html__( 'Search Results', 'homelist' ); ?></li>
    <?php endif; ?>
</ol>
