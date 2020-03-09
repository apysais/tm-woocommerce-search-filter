<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TMWSF_CookieSearchEstate {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  public $cookie = 'search_estate';

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

	public function getPrefixSearch() {
		return $this->cookie;
	}

  public function get( $key ) {
		$cookie_key = $this->getPrefixSearch() . '_' . $key;
    return TMWSF_Session::get_instance()->get( $cookie_key );
  }//get method

  public function set( $value, $cookie_key ) {
		$cookie_key = $this->getPrefixSearch() . '_' . $cookie_key;
		TMWSF_Session::get_instance()->set( $value, $cookie_key );
  }//set method

  public function remove( $key ) {
    TMWSF_Session::get_instance()->remove($key);
  }//remove method

}
