<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TMWSF_Session {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

	public $cookie = 'tre_cookie';

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

	public function getPrefix() {
		return $this->cookie;
	}

	public function get( $key ) {
		$cookie_key = $this->getPrefix() . $key;
		if( isset( $_SESSION[$cookie_key] ) ) {
			return $_SESSION[$cookie_key];
		} else {
			return false;
		}
	}//get method

	public function set( $value, $key = '' ) {
		$cookie_key = $this->getPrefix();
		if ( $key != '' ) {
			$cookie_key = $this->getPrefix() . $key;
		}
		$_SESSION[$cookie_key] = $value;
	}//set method

	public function remove( $key ) {
		$get = $this->get( $key );
		if ( $get ) {
			unset( $_SESSION[$get] );
		}
		return false;
	}//remove method

}
