<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TMWSF_StoreMinMaxLotArea {
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

  /**
   * Min.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type int $post_id the product id, required.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function min( $args = [] ) {
    // Key prefix in _post_meta table.
    $prefix = 'tre_min_lot_fontage';
		$defaults = array(
			'action'  => 'r',
			'value'   => '',
			'prefix'  => $prefix,
			'extend_prefix'  => '',
			'default' => ''
		);

		$args = wp_parse_args( $args, $defaults );

		switch( $args['action'] ) {
			case 'd':
				delete_option( $args['prefix'] . $args['extend_prefix'] );
				break;
			case 'u':
				update_option( $args['prefix'] . $args['extend_prefix'], $args['value'] );
				break;
			case 'r':
				return get_option( $args['prefix'] . $args['extend_prefix'], $args['default'] );
				break;
		}
  }

  /**
   * Max.
   *
   * @param array $args {
   *		Array of arguments.
   *		@type int $post_id the product id, required.
   *		@type bool $single this will return string if true else array if false. default is false.
   *			- applicable only on read or get_post_meta.
   *		@type string $action CRUD action, default is read.
   *			accepted values: r (read), u (update), d (delete)
   *		@type string $prefix the prefix meta key.
   * }
   * @return mixed Will be an array if $action is read, and bool | id if $action is update or delete.
   */
  public function max( $args = [] ) {
    // Key prefix in _post_meta table.
    $prefix = 'tre_max_lot_fontage';
    $defaults = array(
      'action'  => 'r',
      'value'   => '',
      'prefix'  => $prefix,
      'extend_prefix'  => '',
			'default' => ''
    );

    $args = wp_parse_args( $args, $defaults );

    switch( $args['action'] ) {
      case 'd':
        delete_option( $args['prefix'] . $args['extend_prefix'] );
        break;
      case 'u':
        update_option( $args['prefix'] . $args['extend_prefix'], $args['value'] );
        break;
      case 'r':
        return get_option( $args['prefix'] . $args['extend_prefix'], $args['default'] );
        break;
    }
  }

  public function store( $args = [] ) {
    $productsResults = [];

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
          'min_lot_fontage' => min( $lot_array_unique ),
          'max_lot_fontage' => max( $lot_array_unique ),
        ];
        $this->min([
          'extend_prefix' => '_'.$category,
          'value' => $min_max_data['min_lot_fontage'],
          'action' => 'u'
        ]);
        $this->max([
          'extend_prefix' => '_'.$category,
          'value' => $min_max_data['max_lot_fontage'],
          'action' => 'u'
        ]);
      }
    }

    return $min_max_data;
  }

  public function lAndCategory( $post_id, $category = TMWSF_LAND_CAT_SLUG ) {
    $terms = get_the_terms( $post_id, 'product_cat' );
    $prod_cat = [];
    $min_max_data = false;
    foreach ( $terms as $term ) {
        $prod_cat[] = $term->slug;
    }
		if ( in_array($category, $prod_cat) ) {
      $min_max_data = $this->store([
        'category' => $category
      ]);
    }
    return $min_max_data;
	}

}
