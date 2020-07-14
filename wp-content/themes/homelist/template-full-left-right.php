<?php
/*
Template Name: Full Left-Right Template
*/

get_header(); ?>
<?php if ( is_active_sidebar( 'sidebar-left-fullwidth' ) ) : ?>
<div class="sidebar-left">
    <div class="widget">
		<?php dynamic_sidebar( 'sidebar-left-fullwidth' ); ?>
    </div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-right-fullwidth' ) ) : ?>
<div class="sidebar-right">
    <div class="widget">
		<?php dynamic_sidebar( 'sidebar-right-fullwidth' ); ?>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>
