			<?php dynamic_sidebar( 'sidebar-bottom' ); ?>
		</div><!-- /.container -->
	</div><!-- /.main -->


    <!-- begin:footer -->
    <?php if ( is_active_sidebar( 'footer-first' ) || is_active_sidebar( 'footer-second' ) || is_active_sidebar( 'footer-third' ) || is_active_sidebar( 'footer-fourth' )) : ?>
    <div id="footer">
        <div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-first' ) ) : ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
	                <?php dynamic_sidebar( 'footer-first' ); ?>
                    </div>
                </div>
                <?php endif; ?>
                <!-- break -->
				<?php if ( is_active_sidebar( 'footer-second' ) ) : ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
						<?php dynamic_sidebar( 'footer-second' ); ?>
                    </div>
                </div>
				<?php endif; ?>
                <!-- break -->
				<?php if ( is_active_sidebar( 'footer-third' ) ) : ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
						<?php dynamic_sidebar( 'footer-third' ); ?>
                    </div>
                </div>
				<?php endif; ?>
                <!-- break -->
				<?php if ( is_active_sidebar( 'footer-fourth' ) ) : ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
						<?php dynamic_sidebar( 'footer-fourth' ); ?>
                    </div>
                </div>
				<?php endif; ?>
                <!-- break -->
            </div>
            <!-- break -->
            <!-- begin:copyright -->
            <div class="row">
                <div class="col-md-12 copyright">
                    <?php $copyright_text = get_theme_mod( 'homelist_copyright_text' ); ?>
                    <?php if ( ! empty( $copyright_text ) ) : ?>
                    <p><?php echo esc_html( $copyright_text ) ?></p>
                    <?php endif; ?>
                    <a href="#top" class="btn btn-success scroltop"><i class="fa fa-angle-up"></i></a>
                </div>
            </div>
            <!-- end:copyright -->
        </div>
    </div>
    <?php endif; ?>
    <!-- end:footer -->

	<?php if ( is_active_sidebar( 'footer-bottom-left') || is_active_sidebar( 'footer-bottom-right' ) ) : ?>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-inner">
					<?php if ( is_active_sidebar( 'footer-bottom-left' ) || is_active_sidebar( 'footer-bottom-right' )) : ?>
						<?php if ( is_active_sidebar( 'footer-bottom-left' ) ) : ?>
							<div class="footer-bottom-left">
								<?php dynamic_sidebar( 'footer-bottom-left' ); ?>
							</div><!-- /.footer-bottom-left -->
						<?php endif; ?>

						<?php if ( is_active_sidebar( 'footer-bottom-right' ) ) : ?>
							<div class="footer-bottom-right">
								<?php dynamic_sidebar( 'footer-bottom-right' ); ?>
							</div><!-- /.footer-bottom-left -->
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- /.footer-bottom-inner -->
			</div><!-- /.container -->
		</div><!-- /.footer-bottom -->
	<?php endif; ?>
</div><!-- /.page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>