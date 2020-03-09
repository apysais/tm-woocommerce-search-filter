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
    $prefix = 'tre_min_lot_area';
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
    $prefix = 'tre_max_lot_area';
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

  public function houseAndLAndCategory( $post_id, $category = TMWSF_HOUSELAND_CAT_SLUG ) {
    $ret = TMWSF_MinMaxRange::get_instance()->setByCategoryAttribute($post_id, $category, TMWSF_HOUSELAND_LOT_AREA_ATTIBUTE_SLUG);
		//tmwsf_pre($ret);exit();
		if ( $ret ) {
			$this->min([
				'extend_prefix' => '_'.$category,
				'value' => $ret['min'],
				'action' => 'u'
			]);
			$this->max([
				'extend_prefix' => '_'.$category,
				'value' => $ret['max'],
				'action' => 'u'
			]);
		}
	}

  public function lAndCategory( $post_id, $category = TMWSF_LAND_CAT_SLUG ) {
    $ret = TMWSF_MinMaxRange::get_instance()->setByCategoryAttribute($post_id, $category, TMWSF_HOUSELAND_LOT_AREA_ATTIBUTE_SLUG);
		// echo 'land';
		// tmwsf_pre($ret);exit();
		if ( $ret ) {
			$this->min([
				'extend_prefix' => '_'.$category,
				'value' => $ret['min'],
				'action' => 'u'
			]);
			$this->max([
				'extend_prefix' => '_'.$category,
				'value' => $ret['max'],
				'action' => 'u'
			]);
		}
	}

}
