<?php
/**
 * The file that contains the Daextrevo_Audio_Files_Management class.
 *
 * @package real-voice
 */

/**
 * This class should be to store the methods used to create and delete the audio files.
 */
class Daextrevo_Write_Css_File {

	/**
	 * The singleton instance of the class.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * An instance of the class.
	 *
	 * @var Daextrevo_Write_Css_File|null
	 */
	private $shared = null;

	/**
	 * Constructor.
	 */
	private function __construct() {

		// Assign an instance of the class.
		$this->shared = Daextrevo_Shared::get_instance();
	}

	/**
	 * Create a singleton instance of the class.
	 *
	 * @return self|null
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Generate the custom.css file based on the values of the options and write them down in the custom.css file.
	 *
	 * @return void
	 */
	public function write_custom_css() {

		// Turn on output buffering.
		ob_start();

		// Custom Player Background Color -----------------------------------------------------------------------------.
		$custom_player_background_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_background_color' );
		echo '#daextrevo-audio-player-container{background: ' .
			esc_attr( $custom_player_background_color ) . ' !important; }';

		// Custom Player Border Color ---------------------------------------------------------------------------------.
		$custom_player_border_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_border_color' );
		echo '#daextrevo-audio-player-container{border-color: ' .
			esc_attr( $custom_player_border_color ) . ' !important; }';

		// Custom Player Icons Color ----------------------------------------------------------------------------------.
		$custom_player_icons_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_icons_color' );
		echo '#daextrevo-audio-player-container svg path{stroke: ' .
			esc_attr( $custom_player_icons_color ) . ' !important; }';

		// Custom Player Slider Track Color ---------------------------------------------------------------------------.
		$custom_player_slider_track_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_slider_track_color' );
		echo '#daextrevo-audio-player-container input[type="range"]::-webkit-slider-runnable-track {background: ' . esc_attr( $custom_player_slider_track_color ) . ' !important;}';
		echo '#daextrevo-audio-player-container input[type="range"]::-moz-range-track {background: ' . esc_attr( $custom_player_slider_track_color ) . ' !important;}';

		// Custom Player Slider Color ---------------------------------------------------------------------------------.
		$custom_player_slider_thumb_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_slider_thumb_color' );
		echo '#daextrevo-audio-player-container input[type="range"]::before{background-color: ' .
			esc_attr( $custom_player_slider_thumb_color ) . ' !important; }';

		// Slider thumb color -----------------------------------------------------------------------------------------.
		echo '#daextrevo-audio-player-container input[type="range"]::-webkit-slider-thumb{ background-color: ' .
			esc_attr( $custom_player_slider_thumb_color ) . ' !important; }';
		echo '#daextrevo-audio-player-container input[type="range"]::-moz-range-thumb{ background-color: ' .
			esc_attr( $custom_player_slider_thumb_color ) . ' !important; }';

		// Custom Player Text Color -----------------------------------------------------------------------------------.
		$custom_player_text_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_text_color' );
		echo '#daextrevo-current-time, #daextrevo-duration, #daextrevo-spoken-text, #daextrevo-volume-output{color: ' .
			esc_attr( $custom_player_text_color ) . ' !important; }';

		// Custom Player Font Family ----------------------------------------------------------------------------------.
		$custom_player_font_family = get_option( $this->shared->get( 'slug' ) . '_custom_player_font_family' );
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- htmlspecialchars() with the ENT_COMPAT option has been used on purpose as an alternative to the built-in WordPress escaping function to allow single quotes for font families composed of multiple words. E.g. 'Open Sans', sans-serif
		echo '#daextrevo-current-time, #daextrevo-duration, #daextrevo-spoken-text, #daextrevo-volume-output{font-family: ' .
			htmlspecialchars(
				$custom_player_font_family,
				ENT_COMPAT
			) . ' !important; }';
		// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped

		// Custom Player Font Size ------------------------------------------------------------------------------------.
		$custom_player_font_size = get_option( $this->shared->get( 'slug' ) . '_custom_player_font_size' );
		echo '#daextrevo-current-time, #daextrevo-duration, #daextrevo-spoken-text, #daextrevo-volume-output{font-size: ' .
			esc_attr( $custom_player_font_size ) . 'px !important; }';

		// Custom Player Font Style -----------------------------------------------------------------------------------.
		$custom_player_font_style = get_option( $this->shared->get( 'slug' ) . '_custom_player_font_style' );
		echo '#current-time, #duration, #spoken-text, #volume-output{font-style: ' .
			esc_attr( $custom_player_font_style ) . ' !important; }';

		// Custom Player Font Weight ----------------------------------------------------------------------------------.
		$custom_player_font_weight = get_option( $this->shared->get( 'slug' ) . '_custom_player_font_weight' );
		echo '#daextrevo-current-time, #daextrevo-duration, #daextrevo-spoken-text, #daextrevo-volume-output{font-weight: ' .
			esc_attr( $custom_player_font_weight ) . ' !important; }';

		// Custom Player Line Height ----------------------------------------------------------------------------------.
		$custom_player_line_height = get_option( $this->shared->get( 'slug' ) . '_custom_player_line_height' );
		echo '#daextrevo-current-time, #daextrevo-duration, #daextrevo-spoken-text, #daextrevo-volume-output{line-height: ' .
			esc_attr( $custom_player_line_height ) . 'px !important; }';

		$custom_player_drop_shadow       = get_option( $this->shared->get( 'slug' ) . '_custom_player_drop_shadow' );
		$custom_player_drop_shadow_color = get_option( $this->shared->get( 'slug' ) . '_custom_player_drop_shadow_color' );

		// Custom Player Drop Shadow and Custom Player Drop Shadow Color ----------------------------------------------.
		if ( intval( $custom_player_drop_shadow, 10 ) === 1 ) {

			$rgb = $this->hex_to_rgb( $custom_player_drop_shadow_color );

			echo '#daextrevo-audio-player-container{box-shadow: 0 2px 4px -2px rgba(' . esc_attr( $rgb[0] ) . ', ' . esc_attr( $rgb[1] ) . ', ' . esc_attr( $rgb[2] ) . ', 0.06), 0 4px 8px -2px rgba(' . esc_attr( $rgb[0] ) . ', ' . esc_attr( $rgb[1] ) . ', ' . esc_attr( $rgb[2] ) . ', 0.1) !important;}';

		}

		// Responsive Breakpoint --------------------------------------------------------------------------------------.
		$responsive_breakpoint = get_option( $this->shared->get( 'slug' ) . '_responsive_breakpoint' );
		?>

		/* Make the .daextrevo-volume-section div hidden below a specific screen width */
		@media screen and (max-width: <?php echo esc_attr( $responsive_breakpoint ); ?>px) {

		.daextrevo-volume-section {
		display: none !important;
		}

		#daextrevo-audio-player-container {
		width: 100%;
		}

		#daextrevo-seek-slider {
		width: 100% !important;
		}

		#daextrevo-spoken-text{
		width: 100% !important;
		}

		}

		<?php

		// Responsive Breakpoint --------------------------------------------------------------------------------------.
		$responsive_breakpoint_2 = get_option( $this->shared->get( 'slug' ) . '_responsive_breakpoint_2' );
		?>

		/* Make the .daextrevo-volume-section div hidden below a specific screen width */
		@media screen and (max-width: <?php echo esc_attr( $responsive_breakpoint_2 ); ?>px) {

		#daextrevo-audio-player-container #daextrevo-seek-slider{
		display: none !important;
		}

		#daextrevo-audio-player-container #daextrevo-duration{
		display: none !important;
		}

		.daextrevo-volume-section {
		display: none !important;
		}

		#daextrevo-audio-player-container {
		width: 100%;
		}

		#daextrevo-seek-slider {
		width: 100% !important;
		}

		#daextrevo-spoken-text{
		width: 100% !important;
		}

		}

		<?php

		$custom_css_string = ob_get_clean();

		// Get the upload directory path and the file path.
		$upload_dir_path  = $this->shared->get( 'plugin_upload_path' );
		$upload_file_path = $this->shared->get( 'plugin_upload_path' ) . 'custom-' . get_current_blog_id() . '.css';

		global $wp_filesystem;
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();

		// If the plugin upload directory doesn't exist create it.
		if ( ! $wp_filesystem->is_dir( $upload_dir_path ) ) {
			$wp_filesystem->mkdir( $upload_dir_path );
		}

		// Write the custom css file.
		$wp_filesystem->put_contents( $upload_file_path, $custom_css_string );
	}

	/**
	 * Convert a hex to an array with the rgb values.
	 *
	 * @param string $hex_color The color in hex format.
	 * @return array
	 */
	public function hex_to_rgb( $hex_color ) {

		list($r, $g, $b) = sscanf( $hex_color, '#%02x%02x%02x' );
		return array( $r, $g, $b );
	}
}
