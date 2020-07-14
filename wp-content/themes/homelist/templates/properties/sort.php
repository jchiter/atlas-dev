<!-- begin:sorting -->
<div class="row sort">
    <div class="col-md-4 col-sm-4 col-xs-3">
        <?php 
        $display = ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) ? 'grid' : ''; 
        $display = get_query_var( 'display', $display );
        ?>
        <a href="<?php echo esc_url( add_query_arg( 'display', 'box' ) ); ?>" class="btn <?php echo ( $display == 'box' ) ? 'btn-success' : 'btn-default'; ?>"><i class="fa fa-th"></i></a>
        <a href="<?php echo esc_url( add_query_arg( 'display', 'grid' ) ); ?>" class="btn <?php echo ( $display == 'grid' ) ? 'btn-success' : 'btn-default'; ?>"><i class="fa fa-list"></i></a>
    </div>
    <div class="col-md-8 col-sm-8 col-xs-9">
	    <form class="form-inline" method="get" action="?" id="sort-form">
		    <?php $skip = array(
			    'filter-sort-by',
		        'filter-sort-order',
		    ); ?>

		    <?php foreach ( $_GET as $key => $value ) : ?>
			    <?php if ( ! in_array( $key, $skip ) ) : ?>
				    <input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>">
			    <?php endif; ?>
		    <?php endforeach; ?>
            <span><?php echo esc_html__( 'Sort by : ', 'homelist' ); ?></span>
            <div class="form-group">
                <label class="sr-only" for="sortby"><?php echo esc_html__( 'Sort by : ', 'homelist' ); ?></label>
				<select class="form-control" name="filter-sort-by">
					<option value=""><?php echo esc_html__( 'Sort by', 'homelist' ); ?></option>
					<option value="price" <?php if ( ! empty( $_GET['filter-sort-by'] ) && 'price' == $_GET['filter-sort-by'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Price', 'homelist' ); ?></option>
					<option value="title" <?php if ( ! empty( $_GET['filter-sort-by'] ) && 'title' == $_GET['filter-sort-by'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Title', 'homelist' ); ?></option>
					<option value="published" <?php if ( ! empty( $_GET['filter-sort-by'] ) && 'published' == $_GET['filter-sort-by'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Published', 'homelist' ); ?></option>
				</select>
            </div> &nbsp; &nbsp;
            <span><?php echo esc_html__( 'Show : ', 'homelist' ); ?></span>
            <div class="form-group">
                <label class="sr-only" for="show"><?php echo esc_html__( 'Show : ', 'homelist' ); ?></label>
				<select class="form-control" name="filter-sort-order">
					<option value=""><?php echo esc_html__( 'Order', 'homelist' ); ?></option>
					<option value="asc" <?php if ( ! empty( $_GET['filter-sort-order'] ) && 'asc' == $_GET['filter-sort-order'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'ASC', 'homelist' ); ?></option>
					<option value="desc" <?php if ( ! empty( $_GET['filter-sort-order'] ) && 'desc' == $_GET['filter-sort-order'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'DESC', 'homelist' ); ?></option>
				</select>
            </div>
        </form>
    </div>
</div>
<!-- end:sorting -->
