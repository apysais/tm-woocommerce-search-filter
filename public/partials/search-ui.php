<div id="tm-search-filter-main">
<form id="form-search-filter" class="tm-search-filter-form" method="GET">
  <div class="search-filter">


    <div class="search-price-container">
      <p>
        <label for="amount">Price range:</label>
        <input type="text" id="amount" class="tm-search-filter-price-range" readonly style="border:0; color:#f6931f; font-weight:bold;">
      </p>
      <div id="slider-range-price" class="tm-search-filter-price-range-slider"></div>
    </div>

    <div class="search-bed-container tm-search-filter-bed-container">
      <p>Bed</p>
      <input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" value="-1" <?php echo ($bed == -1) ? 'checked':'';?> > All
      <input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" <?php echo ($bed == 2) ? 'checked':'';?> value="2"> 2+
      <input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" <?php echo ($bed == 3) ? 'checked':'';?> value="3"> 3+
      <input type="radio" class="search-bed tm-search-filter-bed search-query" name="search-bed" data-request="search-bed" <?php echo ($bed == 4) ? 'checked':'';?> value="4"> 4+
    </div>

    <div class="search-bath-container tm-search-filter-bath-container">
      <p>Bath</p>
      <input type="radio" class="search-bath tm-search-filter-bath search-query" name="search-bath" data-request="search-bath" <?php echo ($bath == -1) ? 'checked':'';?> value="-1" checked> All
      <input type="radio" class="search-bath tm-search-filter-bath search-query" name="search-bath" data-request="search-bath" <?php echo ($bath == 2) ? 'checked':'';?> value="2"> 2+
      <input type="radio" class="search-bath tm-search-filter-bath search-query" name="search-bath" data-request="search-bath" <?php echo ($bath == 3) ? 'checked':'';?> value="3"> 3+
    </div>

    <div class="search-carspaces-container tm-search-filter-carspaces-container">
      <p>Carspaces</p>
      <input type="radio" class="search-carspaces tm-search-filter-carspaces search-query" name="search-carspaces" data-request="search-carspaces" value="-1" <?php echo ($carspaces == -1) ? 'checked':'';?>> All
      <input type="radio" class="search-carspaces tm-search-filter-carspaces search-query" name="search-carspaces"  data-request="search-carspaces" value="2" <?php echo ($carspaces == 2) ? 'checked':'';?>> 2+
      <input type="radio" class="search-carspaces tm-search-filter-carspaces search-query" name="search-carspaces" data-request="search-carspaces" value="3" <?php echo ($carspaces == 3) ? 'checked':'';?>> 3+
    </div>

    <div class="search-lot-area tm-search-filter-lot-area-container">
      <p>
        <label for="lot-area">Lot Area (sqm):</label>
        <input type="text" id="lot-area" class="tm-search-filter-lot-area-range" readonly style="border:0; color:#f6931f; font-weight:bold;">
      </p>

      <div id="slider-range-lot-area" class="tm-search-filter-lot-area-slider-range"></div>
    </div>

    <div class="search-general-container">
      <p>General Search</p>
      <input type="text" name="search-general" class="tm-search-filter-general search-general" data-request="search-general" value="<?php echo $search_general;?>">
    </div>

    <?php TMWSF_GetBuilders::get_instance()->getHtml(); ?>

    <input type="hidden" name="action" value="tm_search_filter_action">
    <input type="hidden" name="category" value="<?php echo $atts['category'];?>">
    <input type="hidden" name="columns" value="<?php echo $atts['columns'];?>">
    <input type="hidden" name="limit" value="<?php echo $atts['limit'];?>">
    <input type="hidden" name="orderby" class="orderby-input" value="<?php echo $orderby;?>">
    <input type="hidden" name="min_price" class="min_price" value="<?php echo $min_price;?>">
    <input type="hidden" name="max_price" class="max_price" value="<?php echo $max_price;?>">
    <input type="hidden" name="min_lot_area" class="min_lot_area" value="<?php echo $min_lot_size;?>">
    <input type="hidden" name="max_lot_area" class="max_lot_area" value="<?php echo $max_lot_size;?>">
    <input type="hidden" name="is_reset" class="is_reset" value="0">
    <input type="hidden" name="product-page" class="product-page" value="<?php echo $paged;?>">
  </div>
  <button id="configreset" class="tm-search-filter-reset-button">Clear all Filters</button>
  </form>
</div>
