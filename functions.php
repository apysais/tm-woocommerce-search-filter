<?php
require_once plugin_dir_path( __FILE__ ) . 'function-house-n-land.php';
require_once plugin_dir_path( __FILE__ ) . 'function-land-estate.php';

function tmwsf_set_cookie() {
	$cookie_search = new TMWSF_CookieSearchEstate;
	$allowed_action_ajax = [
		'tm_search_filter_action',
		'tm_search_land_estate_filter_action'
	];
	if ( wp_doing_ajax() ) {
		if( isset($_POST['action']) && in_array($_POST['action'], $allowed_action_ajax) ) {
			$category = isset( $_POST['category'] ) ? $_POST['category'] : false;
			if ( $category ) {
				$http_build = http_build_query($_POST);
				$cookie_search->set( $http_build, $category );
			}
		}
	}
}
