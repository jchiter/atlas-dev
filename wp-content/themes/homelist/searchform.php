<form class="search-form" action="<?php echo esc_url( home_url() ) ; ?>" method="get" role="search">
	<div class="input-group">
		<input type="text" class="form-control" name="s" placeholder="<?php esc_attr_e( 'Search...', 'homelist' ); ?>">
		<div class="input-group-btn">
			<button class="btn btn-default" type="submit">
				<span class="fa fa-search"></span>
			</button>
		</div>
	</div>
</form>