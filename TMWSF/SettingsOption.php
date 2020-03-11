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
				#tm-search-filter-main .search-filter .ui-slider-horizontal .ui-slider-range{
					background:<?php echo $this->slider_range_color(); ?>;
				}
				#tm-search-filter-main .search-filter .ui-slider-handle{
					background:<?php echo $this->slider_range_color(); ?>;
				}
				#tm-search-filter-main label.radio-label{
					background:<?php echo $this->radio_button_label_background(); ?>;
					color:<?php echo $this->radio_button_label_color(); ?>;
					border: 1px solid <?php echo $this->radio_button_label_border(); ?>;
				}
				#tm-search-filter-main label.radio-label.is-chosen {
					background:<?php echo $this->radio_button_color_label_chosen_background(); ?>;
					color:<?php echo $this->radio_button_color_label_font_chosen(); ?>;
					border: 1px solid <?php echo $this->radio_button_color_label_chosen_border(); ?>;
				}
				#tm-search-filter-main label.radio-label:hover{
					background:<?php echo $this->radio_button_label_color_hover_background(); ?>;
					color:<?php echo $this->radio_button_label_hover_font_color(); ?>;
					border: 1px solid <?php echo $this->radio_button_color_label_hover_border(); ?>;
				}
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

	public function preload_ajax_image() {
		return get_field('preload_ajax_image', 'option');
	}

}
