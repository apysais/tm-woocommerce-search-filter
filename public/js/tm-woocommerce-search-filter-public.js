var _search_ui;
var isMobile = false; //initiate as false
var applyMobileClicked = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
	isMobile = true;
}

const userAgent = navigator.userAgent.toLowerCase();
const isTablet = /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(userAgent);
var windowsize = jQuery(window).width();
var windowheight = jQuery(window).height();
function showHideMobileFilter(elem = '.form-search-filter-container') {
	if ( isMobile ) {
		var _default_height = 45;
		var _window_height = (windowheight * .75);
		var _search_form = jQuery(elem);
		_search_form.toggle();
		if ( _search_form.is(':hidden') ) {
			jQuery('#tm-search-sticky-footer').height(_default_height);
		} else if ( _search_form.is(':visible') ) {
			jQuery('#tm-search-sticky-footer').height(_window_height);
		}
	}
}

function initMobileFilter() {
	var _mobile_filter = jQuery('.search-mobile-filter');
	if ( isMobile ) {
		jQuery(document).on('click', '.search-mobile-filter', function(e){
			e.preventDefault();
			showHideMobileFilter();
		});
	}
}

function init_sticky_sidebar() {
	var _sidebar = tm_js.sticky_sidebar_sideclass;

	if ( tm_js.use_stickey_sidebar == 1
			&& jQuery(tm_js.sticky_sidebar_sideclass).length > 0
			&& jQuery(tm_js.sticky_sidebar_container_class).length > 0
	) {
	 var _search_ui = new StickySidebar(tm_js.sticky_sidebar_sideclass, {
			topSpacing: 65,
			bottomSpacing: 20,
			minWidth: 978,
			containerSelector: tm_js.sticky_sidebar_container_class,
			innerWrapperSelector: tm_js.sticky_sidebar_innerwrapper_class
		});
	}
}

function removeSelectedOrderBy() {
	var _order_by = jQuery('.orderby > option');
	jQuery('.orderby').prop("disabled", true);
	jQuery.each(_order_by, function(k,v){
	 if ( jQuery(this).val() == 'sku_asc' ) {
		 jQuery(this).remove();
	 } else if ( jQuery(this).val() == 'sku_desc' ) {
		 jQuery(this).remove();
	 } else if ( jQuery(this).val() == 'stock_quantity_asc' ) {
		 jQuery(this).remove();
	 } else if ( jQuery(this).val() == 'stock_quantity_desc' ) {
		 jQuery(this).remove();
	 } else if ( jQuery(this).val() == 'popularity' ) {
		 jQuery(this).remove();
	 }
	});
	if (!jQuery('.orderby option[value="date"]').length) {
	jQuery('.orderby').append('<option value="date">Sort By Latest</option>');
	}
	jQuery('.orderby').prop("disabled", false);
	var _get_input_order = jQuery('.orderby-input');
	//console.log(_get_input_order.val());
	jQuery('.orderby').val(_get_input_order.val()).prop('selected', true);
}

function selectedOrderBy() {
	jQuery(document).on('change', '.orderby', function(){
	 var _this_value = jQuery(this).val();
	 jQuery('.orderby-input').val(_this_value);

	 var _new_uri = getFormUriParam();
	 setURL(_new_uri);
	 queryAjax();
	});
}

function getFormUriParam() {
	var _new_form_data = [];
	var formData = JSON.parse( JSON.stringify( jQuery('#form-search-filter').serializeArray() ) );
	jQuery.each(formData, function (k, v) {
		 //console.log(v.name +'-'+ v.value);
		 if ( v.name == 'search-general' && v.value == '' ) {
		 } else if ( v.name == 'builders' && v.value == '-1' ) {
		 } else if ( v.name == 'search-bed' && v.value == '-1' ) {
		 } else if ( v.name == 'search-bath' && v.value == '-1' ) {
		 } else if ( v.name == 'search-carspaces' && v.value == '-1' ) {
		 } else if ( v.name == 'is_reset' ) {
		 } else if ( v.name == 'action' ) {
		 } else {
			 _new_form_data.push(v);
		 }
	});
	var uri_str = jQuery.param( _new_form_data );
	return uri_str;
}

function setURL( uri_str ) {
	if ( uri_str == '' ) {
		var _uri_str = tm_js.home_url + '/';
	} else {
		var _uri_str = tm_js.home_url + '/?' + uri_str;
	}
	window.history.pushState("", "", _uri_str);
}

function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++)
	{
		 hash = hashes[i].split('=');
		 //vars.push(hash[0]);
		 vars[hash[0]] = hash[1];
	}
	return vars;
}

// const _min_price_val = 0;;
// const _max_price_val = 500000;
// const _min_lot_area_val = 100;
// const _max_lot_area_val = 400;

function getDefaultMinPriceVal() {
	return Number(tm_js.min_max_price.min);
}

function getDefaultMaxPriceVal() {
	return Number(tm_js.min_max_price.max);
}

function getDefaultMinLotAreaVal() {
	return Number(tm_js.default_min_max_lot_area.min);
}

function getDefaultMaxLotAreaVal() {
	return Number(tm_js.default_min_max_lot_area.max);
}

function getMinPriceVal() {
	var _get_var_url = getUrlVars();
	var _min;

	if ( typeof _get_var_url['min_price'] !== 'undefined' && _get_var_url['min_price'] !== null && _get_var_url['min_price'] !== '' ) {
	 _min = _get_var_url['min_price'];
	} else if( typeof tm_js.post_session.min_price !== 'undefined' && tm_js.post_session.min_price !== null  ){
		_min = tm_js.post_session.min_price;
	}else{
	 _min = tm_js.min_max_price.min;
	}
	return Number(_min);
}

function getMaxPriceVal() {
	var _get_var_url = getUrlVars();
	var _max;
	if ( typeof _get_var_url['max_price'] !== 'undefined' && _get_var_url['max_price'] !== null && _get_var_url['max_price'] !== '') {
	_max = _get_var_url['max_price'];
	} else if( typeof tm_js.post_session.max_price !== 'undefined' && tm_js.post_session.max_price !== null  ){
	 _max = tm_js.post_session.max_price;
	} else {
	 _max = tm_js.min_max_price.max;
	}
	return Number(_max);
}

function getMinLotAreaVal() {
	var _get_var_url = getUrlVars();
	var _min;
	if ( typeof _get_var_url['min_lot_area'] !== 'undefined' && _get_var_url['min_lot_area'] !== null && _get_var_url['min_lot_area'] !== '' ) {
		_min = _get_var_url['min_lot_area'];
	} else if( typeof tm_js.post_session.min_lot_area !== 'undefined' && tm_js.post_session.min_lot_area !== null  ){
		_min = tm_js.post_session.min_lot_area;
	}else{
		_min = tm_js.min_max_lot_area.min;
	}
	return Number(_min);
}

function getMaxLotAreaVal() {
	var _get_var_url = getUrlVars();
	var _max;
	if ( typeof _get_var_url['max_lot_area'] !== 'undefined' && _get_var_url['max_lot_area'] !== null && _get_var_url['max_lot_area'] !== '' ) {
	 _max = _get_var_url['max_lot_area'];
  } else if( typeof tm_js.post_session.max_lot_area !== 'undefined' && tm_js.post_session.max_lot_area !== null  ){
		_max = tm_js.post_session.max_lot_area;
	}else{
	 _max = tm_js.min_max_lot_area.max;
	}
	return Number(_max);
}

function getPriceRangeInterval() {
	return Number(tm_js.price_range_interval);
}

function getLotAreaRangeInterval() {
	return Number(tm_js.lot_area_range_interval);
}

function setClickedPagination( clicked = 0) {
	jQuery('.paged_clicked').val( clicked );
}

function getPage() {
	var _elem_paged = jQuery('.product-page');

	var _paged = 1;
	if ( _elem_paged.val() > 1 ) {
		_paged = _elem_paged.val();
	}
	return _paged;
}

function resetPagination() {
	if ( getPage() > 1 ) {
		jQuery('.paged_clicked').val(1);
		jQuery('.product-page').val(1);
	}
}

function mobileApplySeach() {
	if ( isMobile ) {
		var _this = jQuery('.search-mobile-filter-apply');
		jQuery(document).on('click', '.search-mobile-filter-apply', function(e) {
			e.preventDefault();
			applyMobileClicked = true;
			resetPagination();
			var _new_uri = getFormUriParam();
			setURL(_new_uri);
			queryAjax();
			//showHideMobileFilter();
		});
	}
}

function queryAjax() {
	var form = document.getElementById('form-search-filter');
	var form_data = new FormData(form);

	if ( jQuery(".woocommerce").length != 0 ) {
		jQuery('.woocommerce').prepend('<div class="tm-loader" style="'+tm_js.preload_image_style+'"></div>');

		var _request = jQuery.ajax({
			url: woocommerce_params.ajax_url,
			method: "POST",
			data: form_data,
			dataType: "HTML",
			contentType: false,
			processData:false,
			cache: false
		});

		_request.done(function( msg ) {

			jQuery('.is_reset').val('0');
			jQuery('.woocommerce').html(msg);
			removeSelectedOrderBy();

			if ( jQuery(".woocommerce").length != 0 ) {

			 // jQuery([document.documentElement, document.body]).animate({
				// scrollTop: jQuery(".woocommerce").offset().top
			 // }, 2000);
			 //console.log(applyMobileClicked);
			 if ( applyMobileClicked ) {
				 applyMobileClicked = false;
				 showHideMobileFilter();
			 }
			 //showHideMobileFilter();
			}

		});
	}
}

function initSliderRangePrice() {
	jQuery( "#slider-range-price" ).slider({
		range: true,
		min: getDefaultMinPriceVal(),
		max: getDefaultMaxPriceVal(),
		step: getPriceRangeInterval(),
		values: [ getMinPriceVal(), getMaxPriceVal() ],
		slide: function( event, ui ) {
		 jQuery( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		 jQuery('.min_price').val(ui.values[ 0 ]);
		 jQuery('.max_price').val(ui.values[ 1 ]);
		},
		stop: function( event, ui ) {
		 jQuery('.min_price').val(ui.values[ 0 ]);
		 jQuery('.max_price').val(ui.values[ 1 ]);
		 resetPagination();
		 var _new_uri = getFormUriParam();
		 setURL(_new_uri);

		 if( isMobile ) {
 		 } else {
 			queryAjax();
 		 }

		}
	});
	jQuery( "#amount" ).val( "$" + jQuery( "#slider-range-price" ).slider( "values", 0 ) + " - $" + jQuery( "#slider-range-price" ).slider( "values", 1 ) );
}

function initSliderRangeLotArea() {
	jQuery( "#slider-range-lot-area" ).slider({
		range: true,
		min: getDefaultMinLotAreaVal(),
		max: getDefaultMaxLotAreaVal(),
		step: getLotAreaRangeInterval(),
		values: [ getMinLotAreaVal(), getMaxLotAreaVal() ],
		slide: function( event, ui ) {
		 jQuery( "#lot-area" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		 jQuery('.min_lot_area').val(ui.values[ 0 ]);
		 jQuery('.max_lot_area').val(ui.values[ 1 ]);
		},
		stop: function( event, ui ) {
		 jQuery('.min_lot_area').val(ui.values[ 0 ]);
		 jQuery('.max_lot_area').val(ui.values[ 1 ]);
		 resetPagination();
		 var _new_uri = getFormUriParam();
		 setURL(_new_uri);

		 if( isMobile ) {
		 } else {
			 queryAjax();
		 }

		}
	});
	jQuery( "#lot-area" ).val( jQuery( "#slider-range-lot-area" ).slider( "values", 0 ) + " - " + jQuery( "#slider-range-lot-area" ).slider( "values", 1 ) );
}

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

(function( $ ) {
	'use strict';
		$( window ).load(function() {

			var windowsize = jQuery(window).width();
			var windowheight = jQuery(window).height();

			initMobileFilter();

			if ( !isMobile ) {
				//init_sticky_sidebar();
			}

			removeSelectedOrderBy();

			selectedOrderBy();

			mobileApplySeach();

			initSliderRangePrice();

			initSliderRangeLotArea();

			jQuery(document).on('change', '.search-query', function(e){
				resetPagination();
				var _new_uri = getFormUriParam();
				setURL(_new_uri);

				if( isMobile ) {

				} else {
					queryAjax();
				}

			});

			jQuery(window).keydown(function(event){
				if(event.keyCode == 13) {
				 event.preventDefault();
				 resetPagination();
				 var _new_uri = getFormUriParam();
				 setURL(_new_uri);
				 queryAjax();
				 return false;
				}
			});

			jQuery(document).on('click', '.configreset', function(e){
				e.preventDefault();
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

				jQuery('.search-builder').val('-1');
				jQuery('.search-general').val('');

				jQuery("input[name='search-bath'][value='-1']").prop('checked', true);
				jQuery("input[name='search-bed'][value='-1']").prop('checked', true);
				jQuery("input[name='search-carspaces'][value='-1']").prop('checked', true);

				jQuery('.is_reset').val('1');
				var _new_uri = getFormUriParam();

				setURL('');

				queryAjax();
			});

			jQuery(document).on('click', '.page-numbers', function(event){
				event.preventDefault();
				var _get_text = jQuery(this).attr('href');
				if ( typeof _get_text !== 'undefined' ) {
				 var splitString = _get_text.split("?product-page=");
				 jQuery('.product-page').val(splitString[1]);

				 setClickedPagination();

				 var _new_uri = getFormUriParam();
				 setURL(_new_uri);
				 queryAjax();
				}
			});

			jQuery(document).on('submit', '.woocommerce-ordering', function(event) {
				event.preventDefault();
				return false;
			});

			var _get_var_url = getUrlVars();

			if ( Object.size(_get_var_url) > 1 ) {
				var _new_uri = getFormUriParam();
				setURL(_new_uri);
				queryAjax();
			} else if (tm_js.session !== '0') {
				//console.log('hasdsa');
				var _new_uri = getFormUriParam();
				setURL(_new_uri);
				queryAjax();
			}

		});
})( jQuery );
