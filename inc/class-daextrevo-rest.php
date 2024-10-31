<?php
/**
 * Here the REST API endpoint of the plugin are registered.
 *
 * @package real-voice
 */

/**
 * This class should be used to work with the REST API endpoints of the plugin.
 */
class Daextrevo_Rest {

	/**
	 * The singleton instance of the class.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * An instance of the shared class.
	 *
	 * @var Daextrevo_Shared|null
	 */
	private $shared = null;

	/**
	 * An instance of the audio files management class.
	 *
	 * @var Daextrevo_Audio_Files_Management|null
	 */
	private $audio_files_management = null;

	/**
	 * An instance of the class used to write the custom CSS file.
	 *
	 * @var Daextrevo_Write_Css_File|null
	 */
	private $write_css_file = null;

	/**
	 * Constructor.
	 */
	private function __construct() {

		// Assign an instance of the shared class.
		$this->shared = Daextrevo_Shared::get_instance();

		// Audio Files Management.
		$this->audio_files_management = Daextrevo_Audio_Files_Management::get_instance();

		// Write CSS File.
		$this->write_css_file = Daextrevo_Write_Css_File::get_instance();

		/**
		 * Add custom routes to the Rest API.
		 */
		add_action( 'rest_api_init', array( $this, 'rest_api_register_route' ) );
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
	 * Add custom routes to the Rest API.
	 *
	 * @return void
	 */
	public function rest_api_register_route() {

		// Add the POST 'real-voice/v1/create-audio-file/' endpoint to the Rest API.
		register_rest_route(
			'real-voice/v1',
			'/create-audio-file/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_real_voice_create_audio_file_callback' ),
				'permission_callback' => array( $this, 'rest_api_daext_real_voice_create_audio_file_callback_permission_check' ),
			)
		);

		// Add the POST 'real-voice/v1/delete-audio-file/' endpoint to the Rest API.
		register_rest_route(
			'real-voice/v1',
			'/delete-audio-file/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_real_voice_delete_audio_file_callback' ),
				'permission_callback' => array( $this, 'rest_api_daext_real_voice_delete_audio_file_callback_permission_check' ),
			)
		);

		// Add the GET 'real-voice/v1/options/' endpoint to the Rest API.
		register_rest_route(
			'real-voice/v1',
			'/read-options/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_real_voice_pro_read_options_callback' ),
				'permission_callback' => array( $this, 'rest_api_real_voice_pro_read_options_callback_permission_check' ),
			)
		);

		// Add the POST 'real-voice/v1/options/' endpoint to the Rest API.
		register_rest_route(
			'real-voice/v1',
			'/options',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_real_voice_pro_update_options_callback' ),
				'permission_callback' => array( $this, 'rest_api_real_voice_pro_update_options_callback_permission_check' ),
			)
		);

		// Add the GET 'real-voice/v1/requests/' endpoint to the Rest API.
		register_rest_route(
			'real-voice/v1',
			'/requests/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_real_voice_pro_read_requests_callback' ),
				'permission_callback' => array( $this, 'rest_api_real_voice_pro_read_requests_callback_permission_check' ),
			)
		);
	}

	/**
	 * Callback for the POST 'real-voice/v1/audio/' endpoint of the Rest API.
	 *
	 *  This method is in the following contexts:
	 *
	 *  - To create a new audio file in the post editor.
	 *
	 * @param object $request The REST API request parameters.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_daext_real_voice_create_audio_file_callback( $request ) {

		// Get and sanitize data --------------------------------------------------------------------------------------.
		$post_id = intval( $request->get_param( 'id' ), 10 );

		// Generate the audio file.
		$result = $this->audio_files_management->generate_audio_file( $post_id );

		// Generate the response.
		return new WP_REST_Response( $result );
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_daext_real_voice_create_audio_file_callback_permission_check() {

		if ( ! current_user_can( get_option( 'daextrevo_editor_tools_capability' ) ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to generate a new audio file.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'real-voice/v1/delete-audio-file/' endpoint of the Rest API.
	 *
	 *   This method is in the following contexts:
	 *
	 *   - To delete an audio file when the "Delete File" button available in the "Audio File" post sidebar is clicked.
	 *
	 * @param object $request Object with the request data.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_daext_real_voice_delete_audio_file_callback( $request ) {

		// Get and sanitize data --------------------------------------------------------------------------------------.
		$post_id = intval( $request->get_param( 'id' ), 10 );

		// Delete the audio file.
		$result = $this->audio_files_management->delete_audio_files( $post_id );

		// Generate the response.
		return new WP_REST_Response( $result );
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_daext_real_voice_delete_audio_file_callback_permission_check() {

		if ( ! current_user_can( get_option( 'daextrevo_editor_tools_capability' ) ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to delete an new audio file.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the GET 'real-voice/v1/options' endpoint of the Rest API.
	 *
	 *   This method is in the following contexts:
	 *
	 *  - To retrieve the plugin options in the "Options" menu.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_real_voice_pro_read_options_callback() {

		// Generate the response.
		$response = array();
		foreach ( $this->shared->get( 'options' ) as $key => $value ) {
			$response[ $key ] = get_option( $key );
		}

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_real_voice_pro_read_options_callback_permission_check() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error(
				'rest_read_error',
				'Sorry, you are not allowed to view the Real Voice options.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'real-voice/v1/options' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 *  - To update the plugin options in the "Options" menu.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_REST_Response
	 */
	public function rest_api_real_voice_pro_update_options_callback( $request ) {

		$options = array();

		// Get and sanitize data --------------------------------------------------------------------------------------.

		// Text-to-Speech - Tab ---------------------------------------------------------------------------------------.

		// General - Section ------------------------------------------------------------------------------------------.
		$options['daextrevo_text_to_speech_converter'] = $request->get_param( 'daextrevo_text_to_speech_converter' ) !== null ? sanitize_key( $request->get_param( 'daextrevo_text_to_speech_converter' ) ) : null;

		// SpeechSynthesis - Section ----------------------------------------------------------------------------------.
		$options['daextrevo_speech_synthesis_lang']   = $request->get_param( 'daextrevo_speech_synthesis_lang' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_speech_synthesis_lang' ) ) : null;
		$options['daextrevo_speech_synthesis_pitch']  = $request->get_param( 'daextrevo_speech_synthesis_pitch' ) !== null ? floatval( $request->get_param( 'daextrevo_speech_synthesis_pitch' ) ) : null;
		$options['daextrevo_speech_synthesis_rate']   = $request->get_param( 'daextrevo_speech_synthesis_rate' ) !== null ? floatval( $request->get_param( 'daextrevo_speech_synthesis_rate' ) ) : null;
		$options['daextrevo_speech_synthesis_volume'] = $request->get_param( 'daextrevo_speech_synthesis_volume' ) !== null ? floatval( $request->get_param( 'daextrevo_speech_synthesis_volume' ) ) : null;

		// Google Cloud Text-to-Speech AI - Section -------------------------------------------------------------------.
		$options['daextrevo_google_cloud_text_to_speech_api_key']          = $request->get_param( 'daextrevo_google_cloud_text_to_speech_api_key' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_google_cloud_text_to_speech_api_key' ) ) : null;
		$options['daextrevo_google_cloud_audio_config_audio_encoding']     = $request->get_param( 'daextrevo_google_cloud_audio_config_audio_encoding' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_google_cloud_audio_config_audio_encoding' ) ) : null;
		$options['daextrevo_google_cloud_audio_config_speaking_rate']      = $request->get_param( 'daextrevo_google_cloud_audio_config_speaking_rate' ) !== null ? floatval( $request->get_param( 'daextrevo_google_cloud_audio_config_speaking_rate' ) ) : null;
		$options['daextrevo_google_cloud_audio_config_pitch']              = $request->get_param( 'daextrevo_google_cloud_audio_config_pitch' ) !== null ? floatval( $request->get_param( 'daextrevo_google_cloud_audio_config_pitch' ) ) : null;
		$options['daextrevo_google_cloud_audio_config_volume_gain_db']     = $request->get_param( 'daextrevo_google_cloud_audio_config_volume_gain_db' ) !== null ? floatval( $request->get_param( 'daextrevo_google_cloud_audio_config_volume_gain_db' ) ) : null;
		$options['daextrevo_google_cloud_audio_config_sample_rate_hertz']  = $request->get_param( 'daextrevo_google_cloud_audio_config_sample_rate_hertz' ) !== null ? intval( $request->get_param( 'daextrevo_google_cloud_audio_config_sample_rate_hertz' ), 10 ) : null;
		$options['daextrevo_google_cloud_audio_config_effects_profile_id'] = $request->get_param( 'daextrevo_google_cloud_audio_config_effects_profile_id' ) !== null && is_array( $request->get_param( 'daextrevo_google_cloud_audio_config_effects_profile_id' ) ) ? array_map( 'sanitize_key', $request->get_param( 'daextrevo_google_cloud_audio_config_effects_profile_id' ) ) : null;
		$options['daextrevo_google_cloud_voice_language_code']             = $request->get_param( 'daextrevo_google_cloud_voice_language_code' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_google_cloud_voice_language_code' ) ) : null;
		$options['daextrevo_google_cloud_voice_name']                      = $request->get_param( 'daextrevo_google_cloud_voice_name' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_google_cloud_voice_name' ) ) : null;

		// Azure Text-to-Speech.
		$options['daextrevo_azure_speech_resource_key']       = $request->get_param( 'daextrevo_azure_speech_resource_key' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_azure_speech_resource_key' ) ) : null;
		$options['daextrevo_azure_region']                    = $request->get_param( 'daextrevo_azure_region' ) !== null ? sanitize_key( $request->get_param( 'daextrevo_azure_region' ) ) : null;
		$options['daextrevo_azure_user_agent']                = $request->get_param( 'daextrevo_azure_user_agent' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_azure_user_agent' ) ) : null;
		$options['daextrevo_azure_x_microsoft_output_format'] = $request->get_param( 'daextrevo_azure_x_microsoft_output_format' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_azure_x_microsoft_output_format' ) ) : null;
		$options['daextrevo_azure_voice_short_name']          = $request->get_param( 'daextrevo_azure_voice_short_name' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_azure_voice_short_name' ) ) : null;

		// Style - Tab ------------------------------------------------------------------------------------------------.

		// Audio Player - Section -------------------------------------------------------------------------------------.
		$options['daextrevo_custom_player_background_color']   = $request->get_param( 'daextrevo_custom_player_background_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_background_color' ) ) : null;
		$options['daextrevo_custom_player_border_color']       = $request->get_param( 'daextrevo_custom_player_border_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_border_color' ) ) : null;
		$options['daextrevo_custom_player_icons_color']        = $request->get_param( 'daextrevo_custom_player_icons_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_icons_color' ) ) : null;
		$options['daextrevo_custom_player_slider_thumb_color'] = $request->get_param( 'daextrevo_custom_player_slider_thumb_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_slider_thumb_color' ) ) : null;
		$options['daextrevo_custom_player_slider_track_color'] = $request->get_param( 'daextrevo_custom_player_slider_track_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_slider_track_color' ) ) : null;
		$options['daextrevo_custom_player_text_color']         = $request->get_param( 'daextrevo_custom_player_text_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_text_color' ) ) : null;
		$options['daextrevo_custom_player_font_family']        = $request->get_param( 'daextrevo_custom_player_font_family' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_font_family' ) ) : null;
		$options['daextrevo_custom_player_font_size']          = $request->get_param( 'daextrevo_custom_player_font_size' ) !== null ? intval( $request->get_param( 'daextrevo_custom_player_font_size' ), 10 ) : null;
		$options['daextrevo_custom_player_font_style']         = $request->get_param( 'daextrevo_custom_player_font_style' ) !== null ? sanitize_key( $request->get_param( 'daextrevo_custom_player_font_style' ) ) : null;
		$options['daextrevo_custom_player_font_weight']        = $request->get_param( 'daextrevo_custom_player_font_weight' ) !== null ? intval( $request->get_param( 'daextrevo_custom_player_font_weight' ), 10 ) : null;
		$options['daextrevo_custom_player_line_height']        = $request->get_param( 'daextrevo_custom_player_line_height' ) !== null ? intval( $request->get_param( 'daextrevo_custom_player_line_height' ), 10 ) : null;
		$options['daextrevo_custom_player_drop_shadow']        = $request->get_param( 'daextrevo_custom_player_drop_shadow' ) !== null ? intval( $request->get_param( 'daextrevo_custom_player_drop_shadow' ), 10 ) : null;
		$options['daextrevo_custom_player_drop_shadow_color']  = $request->get_param( 'daextrevo_custom_player_drop_shadow_color' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_custom_player_drop_shadow_color' ) ) : null;
		$options['daextrevo_google_font_url']                  = $request->get_param( 'daextrevo_google_font_url' ) !== null ? esc_url_raw( $request->get_param( 'daextrevo_google_font_url' ) ) : null;

		// Misc - Tab -------------------------------------------------------------------------------------------------.

		// Audio Player Location - Section ----------------------------------------------------------------------------.
		$options['daextrevo_post_types'] = $request->get_param( 'daextrevo_post_types' ) !== null ? array_map( 'sanitize_text_field', $request->get_param( 'daextrevo_post_types' ) ) : null;

		// Front-end Layout - Section ---------------------------------------------------------------------------------.
		$options['daextrevo_text_before']             = $request->get_param( 'daextrevo_text_before' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_text_before' ) ) : null;
		$options['daextrevo_text_after']              = $request->get_param( 'daextrevo_text_after' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_text_after' ) ) : null;
		$options['daextrevo_responsive_breakpoint']   = $request->get_param( 'daextrevo_responsive_breakpoint' ) !== null ? intval( $request->get_param( 'daextrevo_responsive_breakpoint' ), 10 ) : null;
		$options['daextrevo_responsive_breakpoint_2'] = $request->get_param( 'daextrevo_responsive_breakpoint_2' ) !== null ? intval( $request->get_param( 'daextrevo_responsive_breakpoint_2' ), 10 ) : null;

		// Audio Content - Section ------------------------------------------------------------------------------------.
		$options['daextrevo_speech_text_before'] = $request->get_param( 'daextrevo_speech_text_before' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_speech_text_before' ) ) : null;
		$options['daextrevo_speech_text_after']  = $request->get_param( 'daextrevo_speech_text_after' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_speech_text_after' ) ) : null;
		$options['daextrevo_read_title']         = $request->get_param( 'daextrevo_read_title' ) !== null ? intval( $request->get_param( 'daextrevo_read_title' ), 10 ) : null;

		// Advanced - Tab ---------------------------------------------------------------------------------------------.

		// General - Section ------------------------------------------------------------------------------------------.
		$options['daextrevo_development_mode']                        = $request->get_param( 'daextrevo_development_mode' ) !== null ? intval( $request->get_param( 'daextrevo_development_mode' ), 10 ) : null;
		$options['daextrevo_post_types_ui']                           = $request->get_param( 'daextrevo_post_types_ui' ) !== null ? array_map( 'sanitize_text_field', $request->get_param( 'daextrevo_post_types_ui' ) ) : null;

		// Capabilities - Section -------------------------------------------------------------------------------------.
		$options['daextrevo_api_log_menu_capability']     = $request->get_param( 'daextrevo_api_log_menu_capability' ) !== null ? sanitize_key( $request->get_param( 'daextrevo_api_log_menu_capability' ) ) : null;
		$options['daextrevo_maintenance_menu_capability'] = $request->get_param( 'daextrevo_maintenance_menu_capability' ) !== null ? sanitize_key( $request->get_param( 'daextrevo_maintenance_menu_capability' ) ) : null;
		$options['daextrevo_editor_tools_capability']     = $request->get_param( 'daextrevo_editor_tools_capability' ) !== null ? sanitize_key( $request->get_param( 'daextrevo_editor_tools_capability' ) ) : null;

		// Segmented TTS Processing - Section -------------------------------------------------------------------------.
		$options['daextrevo_primary_chunk_separator']   = $request->get_param( 'daextrevo_primary_chunk_separator' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_primary_chunk_separator' ) ) : null;
		$options['daextrevo_secondary_chunk_separator'] = $request->get_param( 'daextrevo_secondary_chunk_separator' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_secondary_chunk_separator' ) ) : null;
		$options['daextrevo_tertiary_chunk_separator']  = $request->get_param( 'daextrevo_tertiary_chunk_separator' ) !== null ? sanitize_text_field( $request->get_param( 'daextrevo_tertiary_chunk_separator' ) ) : null;

		// Update the options -----------------------------------------------------------------------------------------.
		foreach ( $options as $key => $option ) {
			if ( null !== $option ) {
				update_option( $key, $option );
			}
		}

		/*
		 * Write the custom-[blog_id].css file or die if the file can't be created or modified.
		 */
		if ( $this->write_css_file->write_custom_css() === false ) {
			die( "The plugin can't write files in the upload directory." );
		}

		return new WP_REST_Response( 'Data successfully added.', '200' );
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_real_voice_pro_update_options_callback_permission_check() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to update the Real Voice options.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**Callback for the GET 'real-voice/v1/requests' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Statistics" menu to retrieve the data of the HTTP requests performed to the Text to Speech API
	 * services.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_real_voice_pro_read_requests_callback( $request ) {

		// Attempt to increase the memory limit.
		wp_raise_memory_limit();

		$data_update_required = intval( $request->get_param( 'data_update_required' ), 10 );

		if ( 0 === $data_update_required ) {

			// Use the provided form data.
			$converter      = intval( $request->get_param( 'converter' ), 10 );
			$search_string  = sanitize_text_field( $request->get_param( 'search_string' ) );
			$sorting_column = sanitize_text_field( $request->get_param( 'sorting_column' ) );
			$sorting_order  = sanitize_text_field( $request->get_param( 'sorting_order' ) );
			$initial_date   = sanitize_text_field( $request->get_param( 'initial_date' ) );
			$final_date     = sanitize_text_field( $request->get_param( 'final_date' ) );

		} else {

			// Set the default values of the form data.
			$converter      = 0;
			$search_string  = '';
			$sorting_column = 'request_id';
			$sorting_order  = 'desc';
			$initial_date   = $this->shared->get_initial_date();
			$final_date     = $this->shared->get_final_date();

		}

		// Create the query for the converter -------------------------------------------------------.
		global $wpdb;
		$filter = '';
		switch ( $converter ) {

			// All.
			case 0:
				$filter = '';
				break;

			// Google Text-to-Speech API.
			case 1:
				$filter = "WHERE converter = 'google-text-to-speech-ai'";
				break;

			// Azure Text to Speech.
			case 2:
				$filter = "WHERE converter = 'azure-text-to-speech'";
				break;

		}

		// Create the WHERE part of the string based on the $search_string value.
		if ( '' !== $search_string ) {
			if ( strlen( $filter ) === 0 ) {
				$filter .= $wpdb->prepare( 'WHERE (request_id LIKE %s)', '%' . $search_string . '%' );
			} else {
				$filter .= $wpdb->prepare( ' AND (request_id LIKE %s)', '%' . $search_string . '%' );
			}
		}

		// Remove the time part from $initial_date and $final_date.
		$initial_date = substr( $initial_date, 0, 10 );
		$final_date   = substr( $final_date, 0, 10 );

		// Create the date part of the query using $initial_date and $final_date.
		if ( null !== $initial_date && null !== $final_date ) {
			if ( strlen( $filter ) === 0 ) {
				$filter .= $wpdb->prepare( 'WHERE request_date BETWEEN %s AND %s', $initial_date . ' 00:00:00', $final_date . ' 23:59:59' );
			} else {
				$filter .= $wpdb->prepare( ' AND request_date BETWEEN %s AND %s', $initial_date . ' 00:00:00', $final_date . ' 23:59:59' );
			}
		}

		// Create the ORDER BY part of the query based on the $sorting_column and $sorting_order values.
		if ( '' !== $sorting_column ) {
			$filter .= ' ORDER BY ' . sanitize_key( $sorting_column );
		} else {
			$filter .= ' ORDER BY request_id';
		}

		if ( 'desc' === $sorting_order ) {
			$filter .= ' DESC';
		} else {
			$filter .= ' ASC';
		}

		// Limit the maximum number of results to the value of the limit_displayed_feedback option.
		$filter .= ' LIMIT 10000';

		// Get the data from the "_request" db table using $wpdb and put them in the $response array.

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- $filter is prepared.
		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$requests = $wpdb->get_results(
			"
			SELECT *
			FROM {$wpdb->prefix}daextrevo_request $filter"
		);
		// phpcs:enable

		// Calculate $total_requests ------------------------------------------------------------.
		$total_requests = count( $requests );

		// Calculate $total_characters ----------------------------------------------------------.
		$total_characters = 0;
		foreach ( $requests as $request ) {
			$total_characters += $request->characters;
		}

		// Calculate the average amount of requests per day.
		$days_difference  = $this->shared->calculate_days_difference( $initial_date, $final_date );
		$requests_per_day = round( $total_requests / ( $days_difference + 1 ), 1 );

		// Prepare the date for table and store them in the $prepared_requests array -----------------.
		$prepared_requests = array();
		foreach ( $requests as $key => $request ) {
			$prepared_requests[] = array(
				'request_id'    => $request->request_id,
				'converter'     => $this->shared->get_service_name_from_slug( $request->converter ),
				'request_date'  => wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $request->request_date ) ) . ' UTC',
				'characters'    => $request->characters,
				'error'         => $request->error,
				'error_message' => $request->error_message,
			);
		}

		/**
		 * Prepare the response with the data for the various sections of the
		 * dashboard.
		 */
		$response = array(
			'statistics' => array(
				'total_requests'   => $total_requests,
				'total_characters' => $total_characters,
				'requests_per_day' => $requests_per_day,
			),
			'table'      => $prepared_requests,
		);

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_real_voice_pro_read_requests_callback_permission_check() {

		if ( ! current_user_can( get_option( $this->shared->get( 'slug' ) . '_api_log_menu_capability' ) ) ) {
			return new WP_Error(
				'rest_read_error',
				'Sorry, you are not allowed to view the Real Voice requests.',
				array( 'status' => 403 )
			);
		}

		return true;
	}
}
