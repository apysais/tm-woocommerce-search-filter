<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TMWSF_MinMaxRange {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

  public function __construct(){}

  public function storeByAttribute( $args = [] ) {
    $productsResults = [];
    $min_max_data = false;

    $category = false;
    if ( isset( $args['category'] ) ) {
      $category = $args['category'];
    }

    $get_attribute = false;
    if ( isset( $args['attribute'] ) ) {
      $get_attribute = $args['attribute'];
    }
    if ( $category && $get_attribute ) {
      $products = wc_get_products( array(
          'status'        => 'publish',
          'limit'         => -1,
          'stock_status'  => 'instock',
          'category'      => [$category],
      ) );

      if ( sizeof( $products ) > 0 ) {
        $attributes_arr = [];

        foreach ( $products as $product ) {
            $attributes = $product->get_attribute($get_attribute);
            if ( $attributes ) {
              $attributes_arr[] = $attributes;
            }
        }

        $lot_array_unique = array_unique($attributes_arr);

        $min_max_data = [
          'min' => min( $lot_array_unique ),
          'max' => max( $lot_array_unique ),
        ];
      }
    }

    return $min_max_data;
  }

  public function setByCategoryAttribute( $post_id, $category, $attribute ) {
    $terms = get_the_terms( $post_id, 'product_cat' );
    $prod_cat = [];
    $min_max_data = false;
    foreach ( $terms as $term ) {
        $prod_cat[] = $term->slug;
    }

		if ( in_array($category, $prod_cat) ) {
      $min_max_data = $this->storeByAttribute([
        'category' => $category,
        'attribute' => $attribute
      ]);
    }
    return $min_max_data;
  }

}
