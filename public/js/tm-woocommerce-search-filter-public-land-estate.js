function getLotFrontageRangeInterval() {
	return Number(tm_js.lot_frontage_range_interval);
}

function getMinLotFrontageVal() {
	var _get_var_url = getUrlVars();
	var _min;
	if ( typeof _get_var_url['min_lot_frontage'] !== 'undefined' && _get_var_url['min_lot_frontage'] !== null && _get_var_url['min_lot_frontage'] !== '' ) {
		_min = _get_var_url['min_lot_frontage'];
	} else if( typeof tm_js.post_session.min_lot_frontage !== 'undefined' && tm_js.post_session.min_lot_frontage !== null  ){
		_min = tm_js.post_session.min_lot_frontage;
	}else{
		_min = tm_js.min_max_lot_frontage.min;
	}

	return Number(_min);
}

function getMaxLotFrontageVal() {
	var _get_var_url = getUrlVars();
	var _max;
	if ( typeof _get_var_url['max_lot_frontage'] !== 'undefined' && _get_var_url['max_lot_frontage'] !== null && _get_var_url['max_lot_frontage'] !== '' ) {
	  _max = _get_var_url['max_lot_frontage'];
	} else if( typeof tm_js.post_session.max_lot_frontage !== 'undefined' && tm_js.post_session.max_lot_frontage !== null  ){
		_max = tm_js.post_session.max_lot_frontage;
	}else{
	 _max = tm_js.min_max_lot_frontage.max;
	}

	return Number(_max);
}

function getDefaultMinFrontageVal() {
	return Number(tm_js.min_max_lot_frontage.min);
}

function getDefaultMaxFrontageVal() {
	return Number(tm_js.min_max_lot_frontage.max);
}

//min_max_lot_frontage
function initSliderRangeLotFrontage() {
	jQuery( "#slider-range-lot-frontage" ).slider({
		range: true,
		min: getDefaultMinFrontageVal(),
		max: getDefaultMaxFrontageVal(),
		step: getLotFrontageRangeInterval(),
		values: [ getMinLotFrontageVal(), getMaxLotFrontageVal() ],
		slide: function( event, ui ) {
		 jQuery( "#lot-frontage" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		 jQuery('.min_lot_frontage').val(ui.values[ 0 ]);
		 jQuery('.max_lot_frontage').val(ui.values[ 1 ]);
		},
		stop: function( event, ui ) {
		 jQuery('.min_lot_frontage').val(ui.values[ 0 ]);
		 jQuery('.max_lot_frontage').val(ui.values[ 1 ]);
		 resetPagination();
		 var _new_uri = getFormUriParam();
		 setURL(_new_uri);

		 if( isMobile ) {
		 } else {
			 queryAjax();
		 }

		}
	});
	jQuery( "#lot-frontage" ).val( jQuery( "#slider-range-lot-frontage" ).slider( "values", 0 ) + " - " + jQuery( "#slider-range-lot-frontage" ).slider( "values", 1 ) );
}

function getLotDepthRangeInterval() {
	return Number(tm_js.lot_depth_range_interval);
}

function getMinLotDepthVal() {
	var _get_var_url = getUrlVars();
	var _min;
	if ( typeof _get_var_url['min_lot_depth'] !== 'undefined' && _get_var_url['min_lot_depth'] !== null && _get_var_url['min_lot_depth'] !== '') {
		_min = _get_var_url['min_lot_depth'];
	} else if( typeof tm_js.post_session.min_lot_depth !== 'undefined' && tm_js.post_session.min_lot_depth !== null  ){
		_min = tm_js.post_session.min_lot_depth;
	}else{
		_min = tm_js.min_max_lot_depth.min;
	}

	return Number(_min);
}

function getMaxLotDepthVal() {
	var _get_var_url = getUrlVars();
	var _max;
	if ( typeof _get_var_url['max_lot_depth'] !== 'undefined' && _get_var_url['max_lot_depth'] !== null && _get_var_url['max_lot_depth'] !== '' ) {
	  _max = _get_var_url['max_lot_depth'];
	} else if( typeof tm_js.post_session.max_lot_depth !== 'undefined' && tm_js.post_session.max_lot_depth !== null  ){
		_max = tm_js.post_session.max_lot_depth;
	}else{
	 _max = tm_js.min_max_lot_depth.max;
	}

	return Number(_max);
}

function getDefaultMinDepthVal() {
	return Number(tm_js.min_max_lot_depth.min);
}

function getDefaultMaxDepthVal() {
	return Number(tm_js.min_max_lot_depth.max);
}

function initSliderRangeLotDepth() {
	jQuery( "#slider-range-lot-depth" ).slider({
		range: true,
		min: getDefaultMinDepthVal(),
		max: getDefaultMaxDepthVal(),
		step: getLotDepthRangeInterval(),
		values: [ getMinLotDepthVal(), getMaxLotDepthVal() ],
		slide: function( event, ui ) {
		 jQuery( "#lot-depth" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		 jQuery('.min_lot_depth').val(ui.values[ 0 ]);
		 jQuery('.max_lot_depth').val(ui.values[ 1 ]);
		},
		stop: function( event, ui ) {
		 jQuery('.min_lot_depth').val(ui.values[ 0 ]);
		 jQuery('.max_lot_depth').val(ui.values[ 1 ]);
		 resetPagination();
		 var _new_uri = getFormUriParam();
		 setURL(_new_uri);

		 if( isMobile ) {
		 } else {
			 queryAjax();
		 }

		}
	});
	jQuery( "#lot-depth" ).val( jQuery( "#slider-range-lot-depth" ).slider( "values", 0 ) + " - " + jQuery( "#slider-range-lot-depth" ).slider( "values", 1 ) );
}

(function( $ ) {
	'use strict';
	$( window ).load(function() {
		initSliderRangeLotFrontage();
		initSliderRangeLotDepth();
		jQuery(document).on('click', '.configreset-land-estate', function(e){
			e.preventDefault();
			console.log('.configreset-land-estate');
			jQuery('#form-search-filter')[0].reset();

			setClickedPagination();

			var slider_amount = jQuery("#slider-range-price");
			slider_amount.each(function(){
				var options = jQuery(this).slider( 'option' );
				jQuery(this).slider( 'values', [ options.min, options.max ] );
			});
			jQuery( "#amount" ).val( "$" + slider_amount.slider( "values", 0 ) + " - $" + slider_amount.slider( "values", 1 ) );
			jQuery( ".min_price" ).val( slider_amount.slider( "values", 0 ) );
			jQuery( ".max_price" ).val( slider_amount.slider( "values", 1 ) );

			var slider_lot = jQuery("#slider-range-lot-area");
			slider_lot.each(function(){
				var options = jQuery(this).slider( 'option' );
				jQuery(this).slider( 'values', [ options.min, options.max ] );
			});
			jQuery( "#lot-area" ).val( slider_lot.slider( "values", 0 ) + " - " + slider_lot.slider( "values", 1 ) );
			jQuery( ".min_lot_area" ).val( slider_lot.slider( "values", 0 ) );
			jQuery( ".max_lot_area" ).val( slider_lot.slider( "values", 1 ) );

			var slider_depth = jQuery("#slider-range-lot-depth");
			slider_depth.each(function(){
				var options = jQuery(this).slider( 'option' );
				jQuery(this).slider( 'values', [ options.min, options.max ] );
			});
			jQuery( "#lot-depth" ).val( slider_depth.slider( "values", 0 ) + " - " + slider_depth.slider( "values", 1 ) );
			jQuery( ".min_lot_depth" ).val( slider_depth.slider( "values", 0 ) );
			jQuery( ".max_lot_depth" ).val( slider_depth.slider( "values", 1 ) );

			var slider_frontage = jQuery("#slider-range-lot-frontage");
			slider_frontage.each(function(){
				var options = jQuery(this).slider( 'option' );
				jQuery(this).slider( 'values', [ options.min, options.max ] );
			});
			jQuery( "#lot-frontage" ).val( slider_frontage.slider( "values", 0 ) + " - " + slider_frontage.slider( "values", 1 ) );
			jQuery( ".min_lot_frontage" ).val( slider_frontage.slider( "values", 0 ) );
			jQuery( ".max_lot_frontage" ).val( slider_frontage.slider( "values", 1 ) );

			jQuery('.search-builder').val('-1');
			jQuery('.search-general').val('');

			jQuery('.is_reset').val('1');
			var _new_uri = getFormUriParam();

			setURL('');

			queryAjax();
		});

	});

})( jQuery );
