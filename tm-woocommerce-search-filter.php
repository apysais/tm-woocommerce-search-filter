<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tornmarketing.com.au/
 * @since             1.0.0
 * @package           Tm_Woocommerce_Search_Filter
 *
 * @wordpress-plugin
 * Plugin Name:       TM Woocommerce Search Filter
 * Plugin URI:        https://tornmarketing.com.au/
 * Description:       Torn Marketing Woocommerce Search Filter UI
 * Version:           1.0.0
 * Author:            Torn Marketing
 * Author URI:        https://tornmarketing.com.au/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tm-woocommerce-search-filter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TM_WOOCOMMERCE_SEARCH_FILTER_VERSION', '1.0.7' );
define( 'TMWSF_INIT_SHORTCODE', false);
define( 'TMWSF_HOUSELAND_CAT_SLUG', 'house-and-land');
define( 'TMWSF_HOUSELAND_LOTAREA_ATTIBUTE_SLUG', 'pa_lot-area');

function tmwsf_called_shortcode( $set = false ) {
	global $tm_search_ui_instance;
	$tm_search_ui_instance = $set;
}

/**
 * For autoloading classes
 */
spl_autoload_register( 'tmwsf_directory_autoload_class' );

function tmwsf_directory_autoload_class( $class_name ) {
	if ( false !== strpos( $class_name, 'TMWSF' ) ) {
		$include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;
		$admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
		$class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';

		if( file_exists( $include_classes_dir . $class_file ) ) {
			require_once $include_classes_dir . $class_file;
		}

		if( file_exists( $admin_classes_dir . $class_file ) ) {
			require_once $admin_classes_dir . $class_file;
		}

	}
}

/**
 * Get the plugin details.
 */
function tmwsf_get_plugin_details() {

/**
 * Check if get_plugins() function exists. This is required on the front end of the
 *  site, since it is in a file that is normally only loaded in the admin.
 */
 if ( ! function_exists( 'get_plugins' ) ) {
	 require_once ABSPATH . 'wp-admin/includes/plugin.php';
 }

 $ret = get_plugins();
 return $ret['tm-woocommerce-search-filter/tm-woocommerce-search-filter.php'];

}

/**
 * Get the text domain of the plugin.
 */
function tmwsf_get_text_domain() {
 $ret = tmwsf_get_plugin_details();
 return $ret['TextDomain'];
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tm-woocommerce-search-filter-activator.php
 */
function activate_tm_woocommerce_search_filter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tm-woocommerce-search-filter-activator.php';
	Tm_Woocommerce_Search_Filter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tm-woocommerce-search-filter-deactivator.php
 */
function deactivate_tm_woocommerce_search_filter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tm-woocommerce-search-filter-deactivator.php';
	Tm_Woocommerce_Search_Filter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tm_woocommerce_search_filter' );
register_deactivation_hook( __FILE__, 'deactivate_tm_woocommerce_search_filter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tm-woocommerce-search-filter.php';

require plugin_dir_path( __FILE__ ) . 'shortcode.php';
require plugin_dir_path( __FILE__ ) . 'public-ajax.php';
require plugin_dir_path( __FILE__ ) . 'functions.php';

/**
 * Get the plugin directory path.
 */
function tmwsf_get_plugin_dir() {
 return plugin_dir_path( __FILE__ );
}

/**
 * Get the plugin url path.
 */
function tmwsf_get_plugin_dir_url() {
 return plugin_dir_url( __FILE__ );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tm_woocommerce_search_filter() {

	$plugin = new Tm_Woocommerce_Search_Filter();
	$plugin->run();

}
//run_tm_woocommerce_search_filter();
add_action( 'plugins_loaded', 'run_tm_woocommerce_search_filter' );

function tmwsf_set_range( $post_id, $post, $update ) {
	if ( $parent_id = wp_is_post_revision( $post_id ) )
			$post_id = $parent_id;

	if ( isset( $_POST['post_type'] ) && $_POST['post_type'] == 'product' ) {
		// get data and set any variables here

		// get price range
		// house and land category
		TMWSF_StoreMinMaxPrice::get_instance()->houseAndLAndCategory( $post_id );

		// get the lot area range
		//  house and land
		TMWSF_StoreMinMaxLotArea::get_instance()->houseAndLAndCategory( $post_id );

		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'tmwsf_set_range', 10, 3 );

		// do your thing here, which calls save_post again
		//wp_update_post( array( 'ID' => $post_id, 'post_status' => 'private' ) );

		// re-hook this function
		add_action( 'save_post', 'tmwsf_set_range', 10, 3 );
	}
}
add_action( 'save_post', 'tmwsf_set_range', 10, 3 );
