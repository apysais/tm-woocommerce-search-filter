<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TMWSF_GetBuilders {
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

  public function __construct() {

  }

  public function get() {
    $data = [];

    $tax_vendors = get_terms([
      'taxonomy' => 'dc_vendor_shop',
  	  'hide_empty' => true,
  		'meta_key' => '_vendor_user_id'
    ]);

    if ( $tax_vendors ) {
      foreach ( $tax_vendors as $k => $v ) {
        $data[] = [
          'id' => $v->term_id,
          'name' => $v->name,
          'slug' => $v->slug,
          'count' => $v->count
        ];
      }
    }

    if ( !empty( $data ) ) {
      return $data;
    } else {
      return false;
    }

  }//get method

  public function getHtml() {
    $get_data = $this->get();

    $builders = -1;
  	if ( isset( $_POST['builders'] ) ) {
  		$builders = $_POST['builders'];
  	} elseif ( isset( $_GET['builders'] ) ) {
  		$builders = $_GET['builders'];
  	}
    require_once tmwsf_get_plugin_dir() . 'public/partials/dropdown-builder.php';
  }//getHtml

}
