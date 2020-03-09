<?php

function tm_search_ui_land_estate_func( $atts ) {
	global $wp, $post;

	$atts = shortcode_atts( array(
		'category' => TMWSF_LAND_CAT_SLUG,
		'columns' => '4',
		'limit' => '10',
		'orderby' => 'rand',
		'use_stickey_sidebar' => true,
		'stickey_sidebar_class' => 'sidebar',
		'stickey_sidebar_container' => 'container',
		'stickey_sidebar_inner_wrapper_class' => 'sidebar__inner',
	), $atts, 'tm_search_ui' );
	//tmwsf_pre($_SESSION);
	$category = $atts['category'];
	if ( isset( $_POST['category'] ) ) {
		$category = $_POST['category'];
	} elseif ( isset( $_GET['category'] ) ) {
		$category = $_GET['category'];
	}
	//echo $category;
	$get_session = TMWSF_CookieSearchEstate::get_instance()->get($category);
	$post_session = [];
	//tmwsf_pre($get_session);
	if( $get_session ) {
		parse_str($get_session, $post_session);
	}

	$min_max_lot_area = tmwsf_get_land_estate_lot_area_range();
	$min_max_price = tmwsf_get_land_estate_price_range();
  $min_max_frontage = tmwsf_get_land_estate_lot_frontage_range();
  $min_max_depth = tmwsf_get_land_estate_lot_depth_range();

	$interval_price = TMWSF_PRICE_RANGE_INTERVAL;
	$interval_lot_area = TMWSF_LOT_RANGE_INTERVAL;
	$interval_lot_frontage = TMWSF_LOT_FRONTAGE_RANGE_INTERVAL;
	$interval_lot_depth = TMWSF_LOT_DEPTH_RANGE_INTERVAL;

	$default_min_max_lot_area = $min_max_lot_area;
	$default_min_max_price = $min_max_price;

	$min_price = $min_max_price['min'];
	if ( isset( $_POST['min_price'] ) ) {
		$min_price = $_POST['min_price'];
	} elseif ( isset( $_GET['min_price'] ) ) {
		$min_price = $_GET['min_price'];
	} elseif ( isset( $post_session['min_price'] ) ) {
		$min_price = $post_session['min_price'];
	}

	$max_price = $min_max_price['max'];
	if ( isset( $_POST['max_price'] ) ) {
		$max_price = $_POST['max_price'];
		$min_max_price['max'] = $max_price;
	} elseif ( isset( $_GET['max_price'] ) ) {
		$max_price = $_GET['max_price'];
	} elseif ( isset( $post_session['max_price'] ) ) {
		$max_price = $post_session['max_price'];
	}

	$min_lot_size = $min_max_lot_area['min'];
	if ( isset( $_POST['min_lot_area'] ) ) {
		$min_lot_size = $_POST['min_lot_area'];
	} elseif ( isset( $_GET['min_lot_area'] ) ) {
		$min_lot_size = $_GET['min_lot_area'];
	} elseif ( isset( $post_session['min_lot_area'] ) ) {
		$min_lot_size = $post_session['min_lot_area'];
	}

	$max_lot_size = $min_max_lot_area['max'];
	if ( isset( $_POST['max_lot_area'] ) ) {
		$max_lot_size = $_POST['max_lot_area'];
	} elseif ( isset( $_GET['max_lot_area'] ) ) {
		$max_lot_size = $_GET['max_lot_area'];
	} elseif ( isset( $post_session['max_lot_area'] ) ) {
		$max_lot_size = $post_session['max_lot_area'];
	}

	$min_lot_frontage = $min_max_frontage['min'];
	if ( isset( $_POST['min_lot_frontage'] ) ) {
		$min_lot_frontage = $_POST['min_lot_frontage'];
	} elseif ( isset( $_GET['min_lot_frontage'] ) ) {
		$min_lot_frontage = $_GET['min_lot_frontage'];
	} elseif ( isset( $post_session['min_lot_frontage'] ) ) {
		$min_lot_frontage = $post_session['min_lot_frontage'];
	}

	$max_lot_frontage = $min_max_frontage['max'];
	if ( isset( $_POST['max_lot_frontage'] ) ) {
		$max_lot_frontage = $_POST['max_lot_frontage'];
	} elseif ( isset( $_GET['max_lot_frontage'] ) ) {
		$max_lot_frontage = $_GET['max_lot_frontage'];
	} elseif ( isset( $post_session['max_lot_frontage'] ) ) {
		$max_lot_frontage = $post_session['max_lot_frontage'];
	}

	$min_lot_depth = $min_max_depth['min'];
	if ( isset( $_POST['min_lot_depth'] ) ) {
		$min_lot_depth = $_POST['min_lot_depth'];
	} elseif ( isset( $_GET['min_lot_depth'] ) ) {
		$min_lot_depth = $_GET['min_lot_depth'];
	} elseif ( isset( $post_session['min_lot_depth'] ) ) {
		$min_lot_depth = $post_session['min_lot_depth'];
	}
	if( $min_lot_depth == 0 ) {

	}

	$max_lot_depth = $min_max_depth['max'];
	if ( isset( $_POST['max_lot_depth'] ) ) {
		$max_lot_depth = $_POST['max_lot_depth'];
	} elseif ( isset( $_GET['max_lot_depth'] ) ) {
		$max_lot_depth = $_GET['max_lot_depth'];
	} elseif ( isset( $post_session['max_lot_depth'] ) ) {
		$max_lot_depth = $post_session['max_lot_depth'];
	}

	//$is_reset = isset( $_POST['is_reset'] ) ? $_POST['is_reset'] : 0;

	$search_general = '';
	if ( isset( $_POST['search-general'] ) ) {
		$search_general = $_POST['search-general'];
	} elseif ( isset( $_GET['search-general'] ) ) {
		$search_general = $_GET['search-general'];
	} elseif ( isset( $post_session['search-general'] ) ) {
		$search_general = $post_session['search-general'];
	}

	$builders = -1;
	if ( isset( $_POST['builders'] ) ) {
		$builders = $_POST['builders'];
	} elseif ( isset( $_GET['builders'] ) ) {
		$builders = $_GET['builders'];
	} elseif ( isset( $post_session['builders'] ) ) {
		$builders = $post_session['builders'];
	}

	$paged = 1;
	if ( isset( $_POST['product-page'] ) ) {
		$paged = $_POST['product-page'];
	} elseif ( isset( $_GET['product-page'] ) ) {
		$paged = $_GET['product-page'];
	} elseif ( isset( $post_session['product-page'] ) ) {
		$paged = $post_session['product-page'];
	}

	$orderby = 'rand';
	if ( isset( $_POST['orderby'] ) ) {
			$orderby = $_POST['orderby'];
	} elseif ( isset( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
	} elseif ( isset( $post_session['orderby'] ) ) {
			$orderby = $post_session['orderby'];
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
	wp_enqueue_script( tmwsf_get_text_domain() . '-land-estate', $js_path . 'js/tm-woocommerce-search-filter-public-land-estate.js', array( 'jquery' ), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
	// Localize the script with new data

	$tm_arr_js = array(
			'home_url' => home_url( $wp->request ),
			'use_stickey_sidebar' => $atts['stickey_sidebar_class'] ? 1 : 0,
			'category' => $category,
			'session' => $get_session ? $get_session : 0,
			'post_session' => $post_session ? $post_session : []
	);

	if ( $atts['use_stickey_sidebar'] ) {

		$tm_arr_js['sticky_sidebar_sideclass'] = '.' . $atts['stickey_sidebar_class'];
		$tm_arr_js['sticky_sidebar_container_class'] = '.' . $atts['stickey_sidebar_container'];
		$tm_arr_js['sticky_sidebar_innerwrapper_class'] = '.' . $atts['stickey_sidebar_inner_wrapper_class'];
		$tm_arr_js['min_max_price'] = $min_max_price;
		$tm_arr_js['default_min_max_price'] = $default_min_max_price;

		$tm_arr_js['min_max_lot_area'] = $min_max_lot_area;
		$tm_arr_js['default_min_max_lot_area'] = $default_min_max_lot_area;

		$tm_arr_js['min_max_lot_frontage'] = $min_max_frontage;
		$tm_arr_js['lot_frontage_range_interval'] = TMWSF_LOT_FRONTAGE_RANGE_INTERVAL;

		$tm_arr_js['min_max_lot_depth'] = $min_max_depth;
		$tm_arr_js['lot_depth_range_interval'] = TMWSF_LOT_DEPTH_RANGE_INTERVAL;

		$tm_arr_js['price_range_interval'] = $interval_price;
		$tm_arr_js['lot_area_range_interval'] = $interval_lot_area;

		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar-raf', $js_path . 'js/sticky-sidebar/src/rAF.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar-resize-sensor', $js_path . 'js/sticky-sidebar/src/ResizeSensor.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
		wp_enqueue_script( tmwsf_get_text_domain() . '-sticky-sidebar', $js_path . 'js/sticky-sidebar/dist/sticky-sidebar.js', array(), TM_WOOCOMMERCE_SEARCH_FILTER_VERSION, true );
	}
	wp_localize_script( tmwsf_get_text_domain(), 'tm_js', $tm_arr_js );

	ob_start();
	require_once tmwsf_get_plugin_dir() . 'public/partials/search-ui-land-estate.php';
	return ob_get_clean();
}
add_shortcode( 'tm_search_ui_land_estate', 'tm_search_ui_land_estate_func' );
