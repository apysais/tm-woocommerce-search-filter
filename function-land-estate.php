<?php
function filter_land_woocommerce_shortcode_products_query( $array ) {
	$bath_array = [];
	$bed_array = [];
	$carspaces_array = [];
	$price_array = [];
	$lot_size_array = [];

	if ( isset( $_POST ) || isset( $_GET ) ) {

		$min_price = 0;
		if ( isset( $_POST['min_price'] ) ) {
			$min_price = $_POST['min_price'];
		} elseif ( isset( $_GET['min_price'] ) ) {
			$min_price = $_GET['min_price'];
		}

		$max_price = 1000000;
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

		$max_lot_size = 800;
		if ( isset( $_POST['max_lot_area'] ) ) {
			$max_lot_size = $_POST['max_lot_area'];
		} elseif ( isset( $_GET['max_lot_area'] ) ) {
			$max_lot_size = $_GET['max_lot_area'];
		}

		$is_reset = isset( $_POST['is_reset'] ) ? $_POST['is_reset'] : 0;

		$search_general = '';
		if ( isset( $_POST['search-general'] ) ) {
			$search_general = $_POST['search-general'];
		} elseif ( isset( $_GET['search-general'] ) ) {
			$search_general = $_GET['search-general'];
		}

		if ( $search_general != '' ) {
			//$array['s'] = $search_general;
		}

    $attribute_pa_bathrooms = "pa_bathrooms";
	  $attribute_pa_bedrooms = "pa_bedrooms";
	  $attribute_pa_car_garage = "pa_car-garage";

		$category = false;
		if ( isset( $_POST['category'] ) ) {
			$category = $_POST['category'];
		} elseif ( isset( $_GET['category'] ) ) {
			$category = $_GET['category'];
		}

		if ( $category ) {
			$array['tax_query'][] = [
				'taxonomy'        => 'product_cat',
				'field'						=> 'slug',
				'terms'           =>  [$category],
				'operator'        => 'IN'
			];
		}

		$builders = -1;
		if ( isset( $_POST['builders'] ) ) {
			$builders = $_POST['builders'];
		} elseif ( isset( $_GET['builders'] ) ) {
			$builders = $_GET['builders'];
		}
		if ( $builders != '-1' ) {
			$array['tax_query'][] = [
				'taxonomy'        => 'dc_vendor_shop',
				'field'						=> 'slug',
				'terms'           =>  [$builders],
				'operator'        => 'IN'
			];
		}

		$price_array = [
			'key'     => '_price',
			'value'   => [$min_price, $max_price],
			'compare' => 'BETWEEN',
			'type' => 'DECIMAL'
		];

		$lot_size_array = tre_get_tax_query($min_lot_size, $max_lot_size, 'pa_lot-area');
		$term_lot_sizes = [
			'taxonomy'        => 'pa_lot-area',
			'field'						=> 'term_id',
			'terms'           =>  $lot_size_array,
			'operator'        => 'IN',
		];
		if ( $is_reset == 0 ) {
			$array['tax_query'][] = [
				$term_lot_sizes
			];
		}

	}

	$def_mq = [
		'key' => '_visibility',
		'value' => array('catalog', 'visible'),
		'compare' => 'IN'
	];

	if ( $is_reset == 0 ) {
		$array['meta_query'][] = [
			$price_array,
		];
	}

	$paged = 1;
	if ( isset( $_POST['product-page'] ) ) {
		$paged = $_POST['product-page'];
	} elseif ( isset( $_GET['product-page'] ) ) {
		$paged = $_GET['product-page'];
	}

	$array['paged'] = $paged;

	$orderby = 'rand';
	if ( isset( $_POST['orderby'] ) ) {
			$orderby = $_POST['orderby'];
	} elseif ( isset( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
	}
	$array['orderby'] = $orderby;

	$array['exact'] = true;
	$array['sentence'] = true;

	// print_r($_POST);
	// print_r($array);

  return $array;
};

function tmwsf_get_land_estate_price_range() {
	$min = TMWSF_StoreMinMaxPrice::get_instance()->min([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 0
	]);
	$max = TMWSF_StoreMinMaxPrice::get_instance()->max([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 500000
	]);

	$get = [
		'min' => roundNearestDownBy($min, TMWSF_PRICE_RANGE_INTERVAL),
		'max' => roundNearestUpBy($max, TMWSF_PRICE_RANGE_INTERVAL)
	];

	return $get;
}

function tmwsf_get_land_estate_lot_area_range() {
	$min = TMWSF_StoreMinMaxLotArea::get_instance()->min([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 0
	]);
	$max = TMWSF_StoreMinMaxLotArea::get_instance()->max([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 500
	]);
	$get = [
		'min' => roundNearestDownBy($min, TMWSF_LOT_RANGE_INTERVAL),
		'max' => roundNearestUpBy($max, TMWSF_LOT_RANGE_INTERVAL)
	];

	return $get;
}

function tmwsf_get_land_estate_lot_frontage_range() {
	$min = TMWSF_StoreMinMaxLotFrontage::get_instance()->min([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 0
	]);
	$max = TMWSF_StoreMinMaxLotFrontage::get_instance()->max([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 500
	]);
	$get = [
		'min' => roundNearestDownBy($min, TMWSF_LOT_FRONTAGE_RANGE_INTERVAL),
		'max' => roundNearestUpBy($max, TMWSF_LOT_FRONTAGE_RANGE_INTERVAL)
	];

	return $get;
}

function tmwsf_get_land_estate_lot_depth_range() {
	$min = TMWSF_StoreMinMaxLotDepth::get_instance()->min([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 0
	]);
	$max = TMWSF_StoreMinMaxLotDepth::get_instance()->max([
		'extend_prefix' => '_' . TMWSF_LAND_CAT_SLUG,
		'action' => 'r',
		'default' => 500
	]);
	$get = [
		'min' => roundNearestDownBy($min, TMWSF_LOT_DEPTH_RANGE_INTERVAL),
		'max' => roundNearestUpBy($max, TMWSF_LOT_DEPTH_RANGE_INTERVAL)
	];

	return $get;
}
