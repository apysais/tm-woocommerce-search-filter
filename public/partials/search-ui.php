<div id="tm-search-filter-main" class="tm-filter-dev">

  <div id="tm-search-sticky-footer">
    <div class="search-mobile-container-action top show-mobile">
      <a href="#" class="search-mobile-filter"><div class="filter-mobile-top">Filter <span>▲</span></div>
      <div class="reset-mobile-wrap"><button class="configreset tm-search-filter-reset-button">Reset Filters</button></div></a>
    </div>
      <div class="form-search-filter-container">
        <form id="form-search-filter" class="tm-search-filter-form" method="GET">
          <div class="search-filter">

            <div class="search-price-container tm-price-range-wrap">
              <p>
                <label for="amount">Price</label>
                <input type="text" id="amount" class="tm-search-filter-price-range" readonly style="border:0; color:#f6931f; font-weight:bold;">
              </p>
              <div id="slider-range-price" class="tm-search-filter-price-range-slider"></div>
            </div>

            <div class="search-bed-container tm-search-filter-bed-container">
              <label class="label-search-ui">Bedrooms</label>
                <div class="radio-label-wrap">
                  <label class="radio-label is-chosen"><input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" value="-1" <?php echo ($bed == -1) ? 'checked':'';?> > All</label>
                  <label class="radio-label"><input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" <?php echo ($bed == 2) ? 'checked':'';?> value="2"> 2+</label>
                  <label class="radio-label"><input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" <?php echo ($bed == 3) ? 'checked':'';?> value="3"> 3+</label>
                  <label class="radio-label"><input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" <?php echo ($bed == 4) ? 'checked':'';?> value="4"> 4+</label>
                </div>
            </div>

            <div class="search-bath-container tm-search-filter-bath-container">
              <label class="label-search-ui">Bathrooms</label>
                <div class="radio-label-wrap">
                  <label class="radio-label is-chosen"><input type="radio" class="search-bath tm-search-filter-bath search-query" name="search-bath" data-request="search-bath" <?php echo ($bath == -1) ? 'checked':'';?> value="-1" checked> All</label>
                  <label class="radio-label"><input type="radio" class="search-bath tm-search-filter-bath search-query" name="search-bath" data-request="search-bath" <?php echo ($bath == 2) ? 'checked':'';?> value="2"> 2+</label>
                  <label class="radio-label"><input type="radio" class="search-bath tm-search-filter-bath search-query" name="search-bath" data-request="search-bath" <?php echo ($bath == 3) ? 'checked':'';?> value="3"> 3+</label>
                </div>
            </div>

            <div class="search-carspaces-container tm-search-filter-carspaces-container">
              <label class="label-search-ui">Carspaces</label>
                <div class="radio-label-wrap">
                  <label class="radio-label is-chosen"><input type="radio" class="search-carspaces tm-search-filter-carspaces search-query" name="search-carspaces" data-request="search-carspaces" value="-1" <?php echo ($carspaces == -1) ? 'checked':'';?>> All</label>
                  <label class="radio-label"><input type="radio" class="search-carspaces tm-search-filter-carspaces search-query" name="search-carspaces"  data-request="search-carspaces" value="2" <?php echo ($carspaces == 2) ? 'checked':'';?>> 2+</label>
                  <label class="radio-label"><input type="radio" class="search-carspaces tm-search-filter-carspaces search-query" name="search-carspaces" data-request="search-carspaces" value="3" <?php echo ($carspaces == 3) ? 'checked':'';?>> 3+</label>
                </div>
            </div>

            <div class="search-lot-area tm-search-filter-lot-area-container tm-price-range-wrap">
              <label for="lot-area" class="label-search-ui">Lot Area (sqm)</label>
                <input type="text" id="lot-area" class="tm-search-filter-lot-area-range" readonly style="border:0; color:#f6931f; font-weight:bold;">

              <div id="slider-range-lot-area" class="tm-search-filter-lot-area-slider-range"></div>
            </div>

            <div class="search-general-container">
              <label class="label-search-ui">General Search</label>
              <input type="text" name="search-general" class="tm-search-filter-general search-general" data-request="search-general" value="<?php echo $search_general;?>">
            </div>

            <?php TMWSF_GetBuilders::get_instance()->getHtml($atts); ?>

            <input type="hidden" name="action" value="tm_search_filter_action">
            <input type="hidden" name="category" class="search-category" value="<?php echo $atts['category'];?>">
            <input type="hidden" name="columns" value="<?php echo $atts['columns'];?>">
            <input type="hidden" name="limit" value="<?php echo $atts['limit'];?>">
            <input type="hidden" name="orderby" class="orderby-input" value="<?php echo $orderby;?>">
            <input type="hidden" name="min_price" class="min_price" value="<?php echo $min_price;?>">
            <input type="hidden" name="max_price" class="max_price" value="<?php echo $max_price;?>">
            <input type="hidden" name="min_lot_area" class="min_lot_area" value="<?php echo $min_lot_size;?>">
            <input type="hidden" name="max_lot_area" class="max_lot_area" value="<?php echo $max_lot_size;?>">
            <input type="hidden" name="is_reset" class="is_reset" value="0">
            <input type="hidden" name="paged_clicked" class="paged_clicked" value="0">
            <input type="hidden" name="product-page" class="product-page" value="<?php echo $paged;?>">
          </div>
          <div class="tm-search-filter-apply">
            <button class="et_pb_button search-mobile-filter-apply">Apply</button>
          </div>
          <button class="configreset tm-search-filter-reset-button show-desktop">Clear All Filters</button>
        </form>
      </div>

  </div>

</div>
