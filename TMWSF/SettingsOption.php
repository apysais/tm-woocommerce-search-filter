<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TMWSF_SettingsOption{
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
		add_action('wp_head', [$this, 'display_as_style'], 1000);
  }

	public function display_as_style() {
		?>
			<style>
				.search-options-val{}
			</style>
		<?php
	}

	public function slider_range_color() {
		return get_field('slider_range_color', 'option');
	}

	public function radio_button_label_background() {
		return get_field('radio_button_label_background', 'option');
	}

	public function radio_button_label_color() {
		return get_field('radio_button_label_color', 'option');
	}

	public function radio_button_label_border() {
		return get_field('radio_button_label_border', 'option');
	}

	public function radio_button_label_color_hover_background() {
		return get_field('radio_button_label_color_hover_background', 'option');
	}

	public function radio_button_label_hover_font_color() {
		return get_field('radio_button_label_hover_font_color', 'option');
	}

	public function radio_button_color_label_hover_border() {
		return get_field('radio_button_color_label_hover_border', 'option');
	}

	public function radio_button_color_label_chosen_background() {
		return get_field('radio_button_color_label_chosen_background', 'option');
	}

	public function radio_button_color_label_font_chosen() {
		return get_field('radio_button_color_label_font_chosen', 'option');
	}

	public function radio_button_color_label_chosen_border() {
		return get_field('radio_button_color_label_chosen_border', 'option');
	}

}
