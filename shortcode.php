<?php

function tm_search_ui_func( $atts ) {
	global $wp, $post;

	$atts = shortcode_atts( array(
		'category' => '',
		'columns' => '4',
		'limit' => '10',
		'orderby' => 'menu_order',
		'use_stickey_sidebar' => true,
		'stickey_sidebar_class' => 'sidebar',
		'stickey_sidebar_container' => 'container',
		'stickey_sidebar_inner_wrapper_class' => 'sidebar__inner',
	), $atts, 'tm_search_ui' );

	$bath = '';
	if ( isset( $_POST['search-bath'] ) ) {
		$bath = $_POST['search-bath'];
	} elseif ( isset( $_GET['search-bath'] ) ) {
		$bath = $_GET['search-bath'];
	}

	$bed = -1;
	if ( isset( $_POST['search-bed'] ) ) {
		$bed = $_POST['search-bed'];
	} elseif ( isset( $_GET['search-bed'] ) ) {
		$bed = $_GET['search-bed'];
	}

	$carspaces = -1;
	if ( isset( $_POST['search-carspaces'] ) ) {
		$carspaces = $_POST['search-carspaces'];
	} elseif ( isset( $_GET['search-carspaces'] ) ) {
		$carspaces = $_GET['search-carspaces'];
	}

	$min_price = 0;
	if ( isset( $_POST['min_price'] ) ) {
		$min_price = $_POST['min_price'];
	} elseif ( isset( $_GET['min_price'] ) ) {
		$min_price = $_GET['min_price'];
	}

	$max_price = 500000;
	if ( isset( $_POST['max_price'] ) ) {
		$max_price = $_POST['max_price'];
	} elseif ( isset( $_GET['max_price'] ) ) {
		$max_price = $_GET['max_price'];
	}

	$min_lot_size = 0;
	if ( isset( $_POST['min_lot_area'] ) ) {
		$min_lot_size = $_POST['min_lot_area'];
	} elseif ( isset( $_GET['min_lot_area'] ) ) {
		$min_lot_size = $_GET['min_lot_area'];
	}

	$max_lot_size = 500;
	if ( isset( $_POST['max_lot_area'] ) ) {
		$max_lot_size = $_POST['max_lot_area'];
	} elseif ( isset( $_GET['max_lot_area'] ) ) {
		$max_lot_size = $_GET['max_lot_area'];
	}

	//$is_reset = isset( $_POST['is_reset'] ) ? $_POST['is_reset'] : 0;

	$search_general = '';
	if ( isset( $_POST['search-general'] ) ) {
		$search_general = $_POST['search-general'];
	} elseif ( isset( $_GET['search-general'] ) ) {
		$search_general = $_GET['search-general'];
	}

	$builders = -1;
	if ( isset( $_POST['builders'] ) ) {
		$builders = $_POST['builders'];
	} elseif ( isset( $_GET['builders'] ) ) {
		$builders = $_GET['builders'];
	}

	$category = $atts['category'];
	if ( isset( $_POST['category'] ) ) {
		$category = $_POST['category'];
	} elseif ( isset( $_GET['category'] ) ) {
		$category = $_GET['category'];
	}

	$paged = 1;
	if ( isset( $_POST['product-page'] ) ) {
		$paged = $_POST['product-page'];
	} elseif ( isset( $_GET['product-page'] ) ) {
		$paged = $_GET['product-page'];
	}

	$orderby = 'menu_order';
	if ( isset( $_POST['orderby'] ) ) {
			$orderby = $_POST['orderby'];
	} elseif ( isset( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
	}

	wp_enqueue_script( 'jquery-ui-mouse' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'jquery-ui-slider' );

	$js_path = tmwsf_get_plugin_dir_url() . 'public/';

	wp_enqueue_script( 'jquery-ui-touch-punch', $js_path . 'js/jquery.ui.touch-punch.min.js', array('jquery'), '0.2.3', true );

	if ( $atts['use_stickey_sidebar'] ) {
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar-raf', $js_path . 'js/sticky-sidebar/src/rAF.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar-resize-sensor', $js_path . 'js/sticky-sidebar/src/ResizeSensor.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar', $js_path . 'js/sticky-sidebar/dist/sticky-sidebar.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
	}
	wp_enqueue_script( tmwsf_get_text_domain(), $js_path . 'js/tm-woocommerce-search-filter-public.js', array( 'jquery' ), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
	// Localize the script with new data
	$tm_arr_js = array(
			'home_url' => home_url( $wp->request ),
			'use_stickey_sidebar' => $atts['stickey_sidebar_class'] ? 1 : 0,
	);
	if ( $atts['use_stickey_sidebar'] ) {
		$min_max_lot_area = tmwsf_get_house_and_land_lot_range();
		$min_max_price = tmwsf_get_house_and_land_price_range();

		$tm_arr_js['sticky_sidebar_sideclass'] = '.' . $atts['stickey_sidebar_class'];
		$tm_arr_js['sticky_sidebar_container_class'] = '.' . $atts['stickey_sidebar_container'];
		$tm_arr_js['sticky_sidebar_innerwrapper_class'] = '.' . $atts['stickey_sidebar_inner_wrapper_class'];
		$tm_arr_js['min_max_price'] = $min_max_price;
		$tm_arr_js['min_max_lot_area'] = $min_max_lot_area;

		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar-raf', $js_path . 'js/sticky-sidebar/src/rAF.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar-resize-sensor', $js_path . 'js/sticky-sidebar/src/ResizeSensor.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar', $js_path . 'js/sticky-sidebar/dist/sticky-sidebar.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
	}
	wp_localize_script( tmwsf_get_text_domain(), 'tm_js', $tm_arr_js );

	ob_start();
	require_once tmwsf_get_plugin_dir() . 'public/partials/search-ui.php';
	return ob_get_clean();
}
add_shortcode( 'tm_search_ui', 'tm_search_ui_func' );
