<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package homelist
 */
?>

<section class="no-search-results not-found">
	<header class="page-header">
        <?php if ( is_404() ) : ?>
        <h1 class="page-title"><?php esc_html_e( '404', 'homelist' ); ?></h1>
        <?php else : ?>
		<h2><?php esc_html_e( 'Nothing Found', 'homelist' ); ?></h2>
        <?php endif; ?>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'homelist' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'homelist' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'homelist' ); ?></p>
		
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-lg btn-success"><?php esc_html_e( 'Back To Homepage', 'homelist' ); ?></a>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->