<?php

add_action( 'wp_ajax_tm_search_filter_action', 'tm_search_filter_action' );
add_action( 'wp_ajax_nopriv_tm_search_filter_action', 'tm_search_filter_action' );

function tm_search_filter_action() {

	$category = '';
	if ( isset( $_POST['category'] ) ) {
		$category = $_POST['category'];
	}
	$columns = '';
	if ( isset( $_POST['columns'] ) ) {
		$columns = $_POST['columns'];
	}
	$orderby = 'menu_order';
	if ( isset( $_POST['orderby'] ) ) {
		$orderby = $_POST['orderby'];
	}
	$limit = '';
	if ( isset( $_POST['limit'] ) ) {
		$limit = $_POST['limit'];
	}
	$title = '';
	if ( isset( $_POST['title'] ) ) {
		$title = $_POST['title'];
	}
	
	add_filter( 'woocommerce_shortcode_products_query', 'filter_woocommerce_shortcode_products_query', 10, 1 );
	echo do_shortcode('[products columns="'.$columns.'" category="'.$category.'" orderby="'.$orderby.'" limit="'.$limit.'" paginate=true]');
	wp_die(); // this is required to terminate immediately and return a proper response
}
