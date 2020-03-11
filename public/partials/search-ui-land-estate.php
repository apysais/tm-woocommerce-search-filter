<div id="tm-search-filter-main" class="tm-filter-dev">

  <div id="tm-search-sticky-footer">
    <div class="search-mobile-container-action top show-mobile">
      <a href="#" class="search-mobile-filter"><div class="filter-mobile-top">Filter <span>▲</span></div>
      <div class="reset-mobile-wrap"><button class="configreset-land-estate tm-search-filter-reset-button">Reset Filters</button></div></a>
    </div>
      <div class="form-search-filter-container">
        <form id="form-search-filter" class="tm-search-filter-form" method="GET">
          <div class="search-filter">

            <div class="search-price-container tm-price-range-wrap">
              <label class="label-search-ui">Price Range</label>
                <input type="text" id="amount" class="tm-search-filter-price-range" readonly style="border:0; color:#f6931f; font-weight:bold;">
              <div id="slider-range-price" class="tm-search-filter-price-range-slider"></div>
            </div>

            <div class="search-lot-area tm-search-filter-lot-area-container tm-price-range-wrap">
              <label class="label-search-ui">Lot Area (m2)</label>
                <input type="text" id="lot-area" class="tm-search-filter-lot-area-range" readonly style="border:0; color:#f6931f; font-weight:bold;">
              <div id="slider-range-lot-area" class="tm-search-filter-lot-area-slider-range"></div>
            </div>

            <div class="search-lot-depth tm-search-filter-lot-depth-container tm-price-range-wrap">
              <label class="label-search-ui">Lot Depth (m)</label>
                <input type="text" id="lot-depth" class="tm-search-filter-lot-depth-range" readonly style="border:0; color:#f6931f; font-weight:bold;">

              <div id="slider-range-lot-depth" class="tm-search-filter-lot-depth-slider-range"></div>
            </div>

            <div class="search-general-container">
              <label class="label-search-ui">General Search</label>
              <input type="text" name="search-general" class="tm-search-filter-general search-general" data-request="search-general" value="<?php echo $search_general;?>">
            </div>

            <?php TMWSF_GetBuilders::get_instance()->getHtml($atts); ?>

            <input type="hidden" name="action" value="tm_search_land_estate_filter_action">
            <input type="hidden" name="category" class="search-category" value="<?php echo $atts['category'];?>">
            <input type="hidden" name="columns" value="<?php echo $atts['columns'];?>">
            <input type="hidden" name="limit" value="<?php echo $atts['limit'];?>">
            <input type="hidden" name="orderby" class="orderby-input" value="<?php echo $orderby;?>">
            <input type="hidden" name="min_price" class="min_price" value="<?php echo $min_price;?>">
            <input type="hidden" name="max_price" class="max_price" value="<?php echo $max_price;?>">
            <input type="hidden" name="min_lot_area" class="min_lot_area" value="<?php echo $min_lot_size;?>">
            <input type="hidden" name="max_lot_area" class="max_lot_area" value="<?php echo $max_lot_size;?>">
            <input type="hidden" name="min_lot_frontage" class="min_lot_frontage" value="<?php echo $min_lot_frontage;?>">
            <input type="hidden" name="max_lot_frontage" class="max_lot_frontage" value="<?php echo $max_lot_frontage;?>">
            <input type="hidden" name="min_lot_depth" class="min_lot_depth" value="<?php echo $min_lot_depth;?>">
            <input type="hidden" name="max_lot_depth" class="max_lot_depth" value="<?php echo $max_lot_depth;?>">
            <input type="hidden" name="is_reset" class="is_reset" value="0">
            <input type="hidden" name="paged_clicked" class="paged_clicked" value="0">
            <input type="hidden" name="product-page" class="product-page" value="<?php echo $paged;?>">
          </div>
          <div class="tm-search-filter-apply">
            <button class="et_pb_button search-mobile-filter-apply">Apply</button>
          </div>
          <button class="configreset-land-estate tm-search-filter-reset-button show-desktop">Reset Filters</button>
        </form>
      </div>

  </div>

</div>
