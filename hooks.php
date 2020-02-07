<?php
function tmwsf_set_range( $post_id, $post, $update ) {
	if ( $parent_id = wp_is_post_revision( $post_id ) )
			$post_id = $parent_id;

	if ( isset( $_POST['post_type'] ) && $_POST['post_type'] == 'product' ) {
		// get data and set any variables here

		// get price range
		// house and land category
		TMWSF_StoreMinMaxPrice::get_instance()->houseAndLAndCategory( $post_id );
		TMWSF_StoreMinMaxPrice::get_instance()->lAndCategory( $post_id );

		// get the lot area range
		//  house and land
		TMWSF_StoreMinMaxLotArea::get_instance()->houseAndLAndCategory( $post_id );
		TMWSF_StoreMinMaxLotArea::get_instance()->lAndCategory( $post_id );

		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'tmwsf_set_range', 10, 3 );

		// do your thing here, which calls save_post again
		//wp_update_post( array( 'ID' => $post_id, 'post_status' => 'private' ) );

		// re-hook this function
		add_action( 'save_post', 'tmwsf_set_range', 10, 3 );
	}
	//exit();
}
add_action( 'save_post', 'tmwsf_set_range', 10, 3 );

function tre_pagination($link) {

	return $link;
}
add_filter('paginate_links', 'tre_pagination', 10, 1);

add_filter( 'woocommerce_catalog_orderby', 'tmwsf_custom_woocommerce_catalog_orderby' );
function tmwsf_custom_woocommerce_catalog_orderby( $sortby ) {
	$sortby['rand'] = 'Sort by: Random';
	if ( !isset( $sortby['date'] ) ) {
		$sortby['date'] = 'Sort by latest';
	}
	return $sortby;
}
