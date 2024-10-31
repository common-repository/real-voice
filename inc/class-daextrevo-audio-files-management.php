<?php
/**
 * The file that contains the Daextrevo_Audio_Files_Management class.
 *
 * @package real-voice
 */

/**
 * This class should be to store the methods used to create and delete the audio files.
 */
class Daextrevo_Audio_Files_Management {

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
	 * An array with the audio file paths.
	 *
	 * @var array The audio file paths.
	 */
	private $audio_file_path_a = array();

	/**
	 * An array with the audio file URLs.
	 *
	 * @var array The audio file URLs.
	 */
	private $audio_file_url_a = array();

	/**
	 * Constructor.
	 */
	private function __construct() {

		// Assign an instance of the shared class.
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
	 * Synthesize the audio file for the provided post using Google "Text-to-Speech AI".
	 *
	 * @param int    $post_id The ID of the post for which the audio file will be generated.
	 * @param string $text The text to convert to speech.
	 * @param int    $key The key of the text part.
	 *
	 * @return Array with data about the generated audio file.
	 */
	public function generate_google_text_to_speech_api_audio_file( $post_id, $text, $key ) {

		// Get the API Key.
		$api_key = get_option( 'daextrevo_google_cloud_text_to_speech_api_key' );

		// Get the document type.
		$document_type = get_post_meta( $post_id, '_daextrevo_document_type', true ) === 'ssml' ? 'ssml' : 'text';

		if ( '' === $text ) {
			return false;
		}

		// Get the audio config values from the options.
		$audio_config_audio_encoding     = get_option( $this->shared->get( 'slug' ) . '_google_cloud_audio_config_audio_encoding' );
		$audio_config_speaking_rate      = get_option( $this->shared->get( 'slug' ) . '_google_cloud_audio_config_speaking_rate' );
		$audio_config_pitch              = get_option( $this->shared->get( 'slug' ) . '_google_cloud_audio_config_pitch' );
		$audio_config_volume_gain_db     = get_option( $this->shared->get( 'slug' ) . '_google_cloud_audio_config_volume_gain_db' );
		$audio_config_sample_rate_hertz  = get_option( $this->shared->get( 'slug' ) . '_google_cloud_audio_config_sample_rate_hertz' );
		$audio_config_effects_profile_id = get_option( $this->shared->get( 'slug' ) . '_google_cloud_audio_config_effects_profile_id' );
		$voice_language_code             = get_option( $this->shared->get( 'slug' ) . '_google_cloud_voice_language_code' );
		$voice_name                      = get_option( $this->shared->get( 'slug' ) . '_google_cloud_voice_name' );

		$params = array(
			'audioConfig' => array(
				'audioEncoding' => $audio_config_audio_encoding,
				'pitch'         => $audio_config_pitch,
				'speakingRate'  => $audio_config_speaking_rate,
				'volumeGainDb'  => $audio_config_volume_gain_db,
			),
			'input'       => array(),
			'voice'       => array(
				'languageCode' => $voice_language_code,
				'name'         => $voice_name,
			),
		);

		if ( strlen( trim( $audio_config_sample_rate_hertz ) ) > 0 ) {
			$params['audioConfig']['sampleRateHertz'] = $audio_config_sample_rate_hertz;
		}

		if ( is_array( $audio_config_effects_profile_id ) && count( $audio_config_effects_profile_id ) > 0 ) {
			$params['audioConfig']['effectsProfileId'] = $audio_config_effects_profile_id;
		}

		if ( 'text' === $document_type ) {
			$params['input']['text'] = $text;
		} else {
			$params['input']['ssml'] = $text;
		}

		// Send the request to Google "Text-to-Speech AI" API.
		$data_string    = wp_json_encode( $params );
		$speech_api_key = $api_key;
		$api_url        = 'https://texttospeech.googleapis.com/v1/text:synthesize?fields=audioContent&key=' . $speech_api_key;

		// Request headers.
		$headers = array(
			'Content-Type'   => 'application/json',
			'Content-Length' => strlen( $data_string ),
		);

		// HTTP request arguments.
		$args = array(
			'method'      => 'POST',
			'headers'     => $headers,
			'body'        => $data_string,
			'data_format' => 'body',
			'timeout'     => 60,
		);

		// Send the HTTP request.
		$response = wp_remote_request( $api_url, $args );

		if ( is_wp_error( $response ) ) {

			$result = array(
				'error'   => true,
				'message' => $response->get_error_message(),
			);

		} else {

			// Decode the response body.
			$response_body         = wp_remote_retrieve_body( $response );
			$response_body_decoded = json_decode( $response_body, true );

			// Get the speech data.
			$speech_data = isset( $response_body_decoded['audioContent'] ) ? $response_body_decoded['audioContent'] : null;

			if ( null === $speech_data ) {

				// Create an object with the data of the error.
				$result = array(
					'error'   => true,
					'message' => isset( $response_body_decoded['error']['message'] ) ? $response_body_decoded['error']['message'] : __( 'Unknown error', 'real-voice'),
				);

			} else {

				// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
				$result = $this->upload_file_and_save_meta( $post_id, base64_decode( $speech_data ), $key + 1 );

			}
		}

		// Save the request data in a db table for statistical purposes.
		$this->save_request_data( $text, $result );

		return $result;
	}

	/**
	 * Synthesize the audio file for the provided post using Azure Text to speech.
	 *
	 * @param int    $post_id The ID of the post for which the audio file will be generated.
	 * @param string $text The text to convert to speech.
	 * @param int    $key The key of the text part.
	 *
	 * @return Array with data about the generated audio file.
	 */
	public function generate_azure_text_to_speech_api_audio_file( $post_id, $text, $key ) {

		// Get the document type.
		$document_type = get_post_meta( $post_id, '_daextrevo_document_type', true ) === 'ssml' ? 'ssml' : 'text';

		$region                    = get_option( 'daextrevo_azure_region' );
		$user_agent                = get_option( 'daextrevo_azure_user_agent' );
		$x_microsoft_output_format = get_option( 'daextrevo_azure_x_microsoft_output_format' );
		$voice_short_name          = get_option( 'daextrevo_azure_voice_short_name' );

		// Always send a non-empty user agent string to avoid a "Bad Request" error.
		if ( strlen( trim( $user_agent ) ) === 0 ) {
			$user_agent = 'Default Agent';
		}

		try {

			/**
			 * Do not include the basic tags to create an SSML structure if the user enabled 'ssml' instead of 'text' in
			 * the dedicated option in the Azure section.
			 */
			if ( 'text' === $document_type ) {

				$cont = '<speak version="1.0" xmlns="http://www.w3.org/2001/10/synthesis" xml:lang="en-US">
	            <voice name="' . esc_attr( $voice_short_name ) . '">
	                
	                ' . $text . '
	                
	            </voice>
				</speak>';

			} else {

				$cont = $text;

			}

			$api_url = 'https://' . $region . '.tts.speech.microsoft.com/cognitiveservices/v1';
			$api_key = get_option( 'daextrevo_azure_speech_resource_key' );

			// Request headers.
			$headers = array(
				'Ocp-Apim-Subscription-Key' => $api_key,
				'Content-Type'              => 'application/ssml+xml',
				'Host'                      => $region . '.tts.speech.microsoft.com',
				'Content-Length'            => strlen( $cont ),
				'User-Agent'                => $user_agent,
				'X-Microsoft-OutputFormat'  => $x_microsoft_output_format,
			);

			// HTTP request arguments.
			$args = array(
				'method'      => 'POST',
				'headers'     => $headers,
				'body'        => $cont,
				'data_format' => 'body',
				'timeout'     => 60,
			);

			// Send the HTTP request.
			$response = wp_remote_request( $api_url, $args );

			// Check for errors.
			if ( is_wp_error( $response ) ) {

				$result = array(
					'error'   => true,
					'message' => $response->get_error_message(),
				);

			} elseif ( 200 !== $response['response']['code'] ) {

				$result = array(
					'error'   => true,
					'message' => $response['response']['message'],
				);

			} else {

				// The API response (if needed).
				$audio_data = wp_remote_retrieve_body( $response );

				$result = $this->upload_file_and_save_meta( $post_id, $audio_data, $key + 1 );
			}
		} catch ( AwsException $e ) {

			$result = 'Error: ' . $e->getMessage();

		}

		// Save the request data in a db table for statistical purposes.
		$this->save_request_data( $text, $result );

		return $result;
	}

	/**
	 * Returns the audio file status associated with a specific post.
	 *
	 * The status can be:
	 *
	 * 0: The audio file does not exist
	 * 1: The audio file exists but the content has changed
	 * 2: The audio file exists and the content has not changed
	 *
	 * @param int $post_id The ID of the post for which the audio file status will be retrieved.
	 *
	 * @return int The status of the audio file.
	 */
	public function get_audio_file_status( $post_id ) {

		// Get the file path of the audio file.
		$file_path_a = get_post_meta( $post_id, '_daextrevo_audio_file_path', true );

		// Check if the audio file parts exist in the stored paths.
		if ( $this->file_paths_exist( $file_path_a ) ) {

			$text              = $this->get_text_to_speech_content( $post_id );
			$content_hash      = hash( 'sha512', implode( '', $text ) );
			$content_hash_meta = get_post_meta( $post_id, '_daextrevo_content_hash', true );

			/**
			 * Check if the content of the post has changed by checking the current hash of the content against the hash
			 * stored in the post meta.
			 */
			if ( $content_hash_meta === $content_hash ) {

				// The audio file exists and the content has not changed.
				return 2;

			} else {

				// The audio file exists but the content has changed.
				return 1;

			}
		} else {
			return 0;
		}
	}

	/**
	 * Based on the provided $post_id, returns an array with the data about the audio file. If the audio file does not
	 * exist, it returns false.
	 *
	 * @param int $post_id The ID of the post for which the audio file data will be retrieved.
	 *
	 * @return array|false
	 */
	public function get_audio_file( $post_id ) {

		// Get the file path of the audio file.
		$file_path = get_post_meta( $post_id, '_daextrevo_audio_file_path', true );

		// Get the file URL of the audio file.
		$file_url = get_post_meta( $post_id, '_daextrevo_audio_file_url', true );

		// Check if the audio file parts exist in the stored paths. If they all exists return data about the audio file.
		if ( $this->file_paths_exist( $file_path ) ) {

			// Replace the backslashes with slashes to avoid problems with windows paths that have backslashes.
			$file_path = str_replace( '\\', '/', $file_path );

			$time = get_post_meta( $post_id, '_daextrevo_audio_file_creation_date', true );

			return array(
				'status'                   => 'success',
				'audio_file_path'          => $file_path,
				'audio_file_url'           => $file_url,
				'audio_file_creation_date' => $time,
			);

		}

		return false;
	}

	/**
	 * Synthesize the audio file based on the provided $post_id and $service.
	 *
	 * The $service can be:
	 * - google-text-to-speech-ai
	 * - azure-text-to-speech
	 *
	 * An array with the data about the generated audio file is returned.
	 *
	 * @param int $post_id The ID of the post for which the audio file will be generated.
	 *
	 * @return array|string
	 */
	public function generate_audio_file( $post_id ) {

		$service           = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );
		$audio_file_status = $this->get_audio_file_status( $post_id );

		if ( 0 === $audio_file_status || 1 === $audio_file_status ) {

			// Delete the audio files.
			$this->delete_audio_files( $post_id );

			// Text to be converted to speech.
			$text = $this->get_text_to_speech_content( $post_id );

			/**
			 * Verify if more than 1000 requests have been made in the last 24 hours.
			 *
			 * This is a hardcoded limit used to avoid unexpected charges (from the TTS cloud service) in case of:
			 *
			 * - User error that generates a high number of requests.
			 * - Bugs in installed plugins or themes that generate a high number of requests.
			 * - Bugs in this plugin that generates a high number of requests.
			 */
			global $wpdb;
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$requests_made                     = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}daextrevo_request WHERE request_date > DATE_SUB(NOW(), INTERVAL 1 DAY)" );
			$request_made_after_tts_conversion = intval( $requests_made, 10 ) + count( $text );
			if ( $request_made_after_tts_conversion > 1000 ) {
				$result = array(
					'error'   => true,
					'message' => 'The limit of 1000 API requests per day has been reached. This hardcoded limit is a security measure the plugin applies to avoid unexpected charges (due to user or programmatic errors) from the TTS service.',
				);
				return $result;
			}

			foreach ( $text as $key => $text_part ) {

				/**
				 * Limit max characters per request to 5000. Note that this limit matches the highest chunk size limit
				 * set by the get_chunk_size_limit() method available in this class.
				 *
				 * This is a hardcoded limit used to avoid unexpected charges (from the TTS cloud service) in case of:
				 *
				 * - User error that generates requests with a high number of characters.
				 * - Bugs in installed plugins or themes that generates requests with a high number of characters.
				 * - Bugs in the plugin that generates requests with a high number of characters.
				 */
				if ( strlen( $text_part ) > 5000 ) {
					$result = array(
						'error'   => true,
						'message' => 'The maximum number of characters per request has been reached.',
					);
					return $result;
				}
			}

			// Iterate over the $text array and send the request to the API for each part.
			foreach ( $text as $key => $text_part ) {

				switch ( $service ) {

					case 'google-text-to-speech-ai':
						$result = $this->generate_google_text_to_speech_api_audio_file( $post_id, $text_part, $key );
						break;

					case 'azure-text-to-speech':
						$result = $this->generate_azure_text_to_speech_api_audio_file( $post_id, $text_part, $key );
						break;

				}

				$results[] = $result;

			}

			/**
			 * Check if all the audio files were generated successfully. If not, return the first error found.
			 */
			foreach ( $results as $temp_result ) {
				if ( isset( $result['error'] ) ) {
					$result_error = $temp_result;
					break;
				}
			}

			/**
			 * If an error occurred during the generation of the audio files, return the first error message. Otherwise,
			 * return the data about the generated audio file.
			 */
			if ( isset( $result_error ) &&
				isset( $result_error['error'] ) &&
				isset( $result_error['message'] ) ) {

				$result = array(
					'error'   => $result_error['error'],
					'message' => $result_error['message'],
				);

			} else {

				$result = array(
					'status'                   => 'success',
					'audio_file_path'          => $this->audio_file_path_a,
					'audio_file_url'           => $this->audio_file_url_a,
					'audio_file_creation_date' => time(),
				);

			}
		} else {

			// Use existing audio file.
			$result = $this->get_audio_file( $post_id );

		}

		$result['audio_file_status'] = $audio_file_status;

		return $result;
	}

	/**
	 * This method does this:
	 *
	 * - Saves the audio file on the server
	 * - Saves the audio file path and creation date in post meta
	 *
	 * @param int    $post_id The ID of the post for which the audio file should be uploaded and the post meta should be
	 *    updated.
	 * @param string $audio_stream The audio stream.
	 * @param int    $part_number The part number of the audio file.
	 *
	 * @return array
	 */
	public function upload_file_and_save_meta( $post_id, $audio_stream, $part_number ) {

		// Get the path where the file should be uploaded.
		$upload_dir = wp_upload_dir();

		// If this is part 1 set to empty the file path and the file URL.
		if ( 1 === $part_number ) {
			delete_post_meta( $post_id, '_daextrevo_audio_file_path' );
			delete_post_meta( $post_id, '_daextrevo_audio_file_url' );
		}

		// Generate a time-based identifier to make the file name unique and avoid caching of the new audio files.
		$time_based_id = uniqid();

		// Generate the file path and the file URL.
		$file_path = $upload_dir['path'] . '/' . $post_id . '-' . $part_number . '-' . $time_based_id . '.mp3';
		$file_url  = $upload_dir['url'] . '/' . $post_id . '-' . $part_number . '-' . $time_based_id . '.mp3';

		/**
		 * Add the file path to the meta fields to the existing data in the meta fields. Note that the file
		 * paths are saved in the meta field as a serialized data.
		 */
		$audio_file_paths = get_post_meta( $post_id, '_daextrevo_audio_file_path', true );
		if ( ! is_array( $audio_file_paths ) ) {
			$audio_file_paths = array();
		}

		// Replace the backslashes with slashes to avoid problems with Windows paths that have backslashes.
		$file_path = str_replace( '\\', '/', $file_path );

		$audio_file_paths[] = $file_path;
		update_post_meta( $post_id, '_daextrevo_audio_file_path', $audio_file_paths );

		// Do the same for the file URLs.
		$audio_file_urls = get_post_meta( $post_id, '_daextrevo_audio_file_url', true );
		if ( ! is_array( $audio_file_urls ) ) {
			$audio_file_urls = array();
		}
		$audio_file_urls[] = $file_url;
		update_post_meta( $post_id, '_daextrevo_audio_file_url', $audio_file_urls );

		// Save the audio data as an MP3 file on the server.
		global $wp_filesystem;
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
		$wp_filesystem->put_contents( $file_path, $audio_stream );

		$time = time();

		// Save the file generation date in a post meta.
		update_post_meta( $post_id, '_daextrevo_audio_file_creation_date', $time );

		// Save the hash used to identify the content associated with the generated audio file.
		$text = $this->get_text_to_speech_content( $post_id );
		$hash = hash( 'sha512', implode( '', $text ) );
		update_post_meta( $post_id, '_daextrevo_content_hash', $hash );

		$result = array(
			'status'                   => 'success',
			'audio_file_path'          => $file_path,
			'audio_file_url'           => $file_url,
			'audio_file_creation_date' => $time,
		);

		$this->audio_file_path_a[] = $file_path;
		$this->audio_file_url_a[]  = $file_url;

		return $result;
	}

	/**
	 * Save the data of a request in the database for statistical purposes.
	 *
	 * @param string $text The text that has been sent to the request.
	 * @param array  $result The result of the request.
	 *
	 * @return bool|int|mysqli_result|resource|null
	 */
	public function save_request_data( $text, $result ) {

		// Get the current date.
		$request_date = current_time( 'mysql', 1 );

		// Get the converter from the options.
		$converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );

		// Get the number of characters of the text.
		$characters = strlen( trim( $text ) );

		// Get the status of the request.
		$error = isset( $result['error'] ) ? 1 : 0;

		// get the error message if available.
		$error_message = isset( $result['error'] ) ? substr( $result['message'], 0, 1024 ) : '';

		global $wpdb;

		// Save the calculated data and the post data in the archive database table.
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$query_result = $wpdb->query(
			$wpdb->prepare(
				"INSERT INTO {$wpdb->prefix}daextrevo_request SET 
                    request_date = %s,
                    converter = %s,
                    characters = %s,
                    error = %d,
                    error_message = %s",
				$request_date,
				$converter,
				$characters,
				$error,
				$error_message
			)
		);

		return $query_result;
	}

	/**
	 * Delete the audio file of the post with the specified ID.
	 *
	 * @param int $post_id The ID of the post for which the audio file should be deleted.
	 *
	 * @return Array with the status of the deletion operation and a message
	 */
	public function delete_audio_files( $post_id ) {

		$status             = array();
		$message            = array();
		$delete_files_count = 0;

		// Get the file path from the existing metadata.
		$file_path_a = get_post_meta( $post_id, '_daextrevo_audio_file_path', true );

		// Iterate over the $file_path array and delete the files.
		if ( is_array( $file_path_a ) ) {

			foreach ( $file_path_a as $file_path ) {

				// Delete the audio file.
				if ( file_exists( $file_path ) ) {

					wp_delete_file( $file_path );

					// Check if the file was deleted.
					if ( ! file_exists( $file_path ) ) {
						++$delete_files_count;
					}
				}
			}

			/**
			 * Check if all the files were deleted. Note that the plugin uses multiple files make but with the message make
			 * it appear to the user as if it was a single file.
			 */
			if ( count( $file_path_a ) === $delete_files_count ) {

				$status[]  = 'success';
				$message[] = 'Audio file deleted successfully.';

			} else {

				$status[]  = 'error';
				$message[] = 'Failed to delete the audio file.';

			}
		}

		// Delete the post meta.
		delete_post_meta( $post_id, '_daextrevo_audio_file_path' );
		delete_post_meta( $post_id, '_daextrevo_audio_file_url' );
		delete_post_meta( $post_id, '_daextrevo_audio_file_creation_date' );
		delete_post_meta( $post_id, '_daextrevo_content_hash' );

		$result = array(
			'status'  => $status,
			'message' => $message,
		);

		return $result;
	}

	/**
	 * Get the textual content of the post that should be synthesized as an audio file.
	 *
	 * @param int $post_id The ID of the post for which the textual content for the text-to-speech should be retrieved.
	 *
	 * @return mixed|null
	 */
	public function get_text_to_speech_content( $post_id ) {

		$speech_text_before       = get_option( $this->shared->get( 'slug' ) . '_speech_text_before' );
		$speech_text_after        = get_option( $this->shared->get( 'slug' ) . '_speech_text_after' );
		$text_to_speech_converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );

		// Get the content of the post.
		$content = get_the_content( null, false, $post_id );

		// If the text/ssml meta value is not empty use it instead of the post content.
		$text_to_speech = get_post_meta( $post_id, '_daextrevo_text_to_speech', true );
		if ( trim( $text_to_speech ) !== '' ) {

			// Get the content from the meta value.
			$content = $text_to_speech;

		} else {

			// Get the content of the post.
			$content = apply_filters( 'daextrevo_content_before_cleaning', $content );
			$content = $this->clean_text( $content );
			$content = apply_filters( 'daextrevo', $content );

		}

		$content = $speech_text_before . $content . $speech_text_after;

		// Add the title to the content if the option is enabled.
		if ( intval( get_option( $this->shared->get( 'slug' ) . '_read_title' ), 10 ) === 1 ) {
			$title   = get_the_title( $post_id );
			$content = $title . $content;
		}

		// Get the document type.
		$document_type = get_post_meta( $post_id, '_daextrevo_document_type', true ) === 'ssml' ? 'ssml' : 'text';

		// If the text-to-speech converter is not the "SpeechSynthesis API" apply chunking to the content.
		if ( 'speechsyntesis-api' !== $text_to_speech_converter &&
			'text' === $document_type ) {

			return $this->chunk_text( $content );

		} else {

			return array( $content );

		}
	}

	/**
	 * Get the automatic chunk size limit based on TTS service limits.
	 *
	 * @return int The chunk size limit.
	 */
	private function get_chunk_size_limit() {

		// Get the selected TTS converter from the plugin option.
		$service = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );

		switch ( $service ) {

			case 'google-text-to-speech-ai':
				/**
				 * With Google TTS. The limit is 5000. However, since it's in bytes, we need to consider that the text is encoded in
				 * UTF-8, which means that a character can have up to 4 bytes. So, the limit is 5000 / 4 = 1250.
				 *
				 * Ref: https://cloud.google.com/text-to-speech/quotas
				 */
				$chunk_size_limit = 1250;
				break;

			case 'azure-text-to-speech':
				/**
				 * For Azure the character limit is not specified. The limit is discretionary set to "5000" characters.
				 *
				 * Ref: https://learn.microsoft.com/en-us/azure/ai-services/speech-service/speech-services-quotas-and-limits
				 */

				$chunk_size_limit = 5000;
				break;

		}

		return $chunk_size_limit;
	}

	/**
	 * Chunk the text in parts based on the plugin options available in the "Segmented TTS Processing" section.
	 *
	 * Note that chunking is only applied to textual content and not to SSML content.
	 *
	 * Details:
	 *
	 *  I want to create method that gives a text string as input it returns an array with the text parts chunked based
	 *  on the following parameters:
	 *
	 *  - chunk_size_limit: The maximum number of characters that a chunk can have.
	 *  - primaray_chunk_separator: The primary separator that will be used to split the text in chunks.
	 *  - secondary_chunk_separator: The secondary separator that will be used to split the text in chunks.
	 *
	 *  Note that:
	 *
	 *  - If a separator is not found in the text the chunk will be created based on the chunk_size_limit.
	 *  - The separators should be found as the last sepator in the chunk.
	 *
	 * @param string $text The text to be chunked.
	 *
	 * @return array The chunked text parts in an array.
	 */
	private function chunk_text( $text ) {

		$chunk_size_limit          = $this->get_chunk_size_limit();
		$primary_chunk_separator   = get_option( $this->shared->get( 'slug' ) . '_primary_chunk_separator' );
		$secondary_chunk_separator = get_option( $this->shared->get( 'slug' ) . '_secondary_chunk_separator' );
		$tertiary_chunk_separator  = get_option( $this->shared->get( 'slug' ) . '_tertiary_chunk_separator' );

		// Initialize variables.
		$chunks = array();
		$offset = 0;

		// Make a do while that the $chunk_text_separator position is higher than the $text length.
		do {

			// Get a substring of the text.
			$chunk = substr( $text, $offset, $chunk_size_limit );

			/**
			 * If this is the last chunk, save it and break the loop. This is used to not chunk text when the considered
			 * chunk is the last one.
			 */
			if ( strlen( $text ) <= $offset + $chunk_size_limit ) {
				$chunks[] = $chunk;
				break;
			}

			/**
			 * Verify which is the last primary separator in the chunk. If there is no primary separator verify which is the
			 * last secondary separator in the chunk.
			 */
			$last_primary_separator_position   = strrpos( $chunk, $primary_chunk_separator );
			$last_secondary_separator_position = strrpos( $chunk, $secondary_chunk_separator );
			$last_tertiary_separator_position  = strrpos( $chunk, $tertiary_chunk_separator );

			/**
			 * If there is a primary separator save its position in the $chunk_separator_position variable, if not save the
			 * secondary separator position, if not save the tertiary separator position. If there is no separator in
			 * the chunk, save the chunk size as the separator position.
			 */
			if ( false !== $last_primary_separator_position ) {
				$chunk_separator_position = $last_primary_separator_position + 1;
			} elseif ( false !== $last_secondary_separator_position ) {
				$chunk_separator_position = $last_secondary_separator_position + 1;
			} elseif ( false !== $last_tertiary_separator_position ) {
				$chunk_separator_position = $last_tertiary_separator_position + 1;
			} else {
				$chunk_separator_position = $chunk_size_limit;
			}

			$offset = $offset + $chunk_separator_position;

			// Get the chunk based on the separator position.
			$chunks[] = substr( $chunk, 0, $chunk_separator_position );

		} while ( $offset <= strlen( $text ) );

		return $chunks;
	}

	/**
	 * This function is used to clean the textual content that should be synthesized as an audio file.
	 *
	 *  It removes all the html tags, shortcodes and other characters that are not speakable.
	 *
	 *  This text cleaning function is inspired by the function included in this plugin:
	 *
	 * https://wordpress.org/plugins/responsivevoice-text-to-speech/
	 *
	 * @param string $text The text to be cleaned.
	 *
	 * @return array|string|string[]|null
	 */
	public function clean_text( $text ) {
		$quotation_marks = array(
			"'"       => "\'",
			'"'       => '\"',
			'&#8216;' => "\'",
			'&#8217;' => "\'",
			'&rsquo;' => "\'",
			'&lsquo;' => "\'",
			'&#8218;' => '',
			'&#8220;' => '\"',
			'&#8221;' => '\"',
			'&#8222;' => '\"',
			'&ldquo;' => '\"',
			'&rdquo;' => '\"',
			'&quot;'  => '\"',
		);

		$other_marks = array(
			'&auml;'  => 'ä',
			'&Auml;'  => 'Ä',
			'&ouml;'  => 'ö',
			'&Ouml;'  => 'Ö',
			'&uuml;'  => 'ü',
			'&Uuml;'  => 'Ü',
			'&szlig;' => 'ß',
			'&euro;'  => '€',
			'&copy;'  => '©',
			'&trade;' => '™',
			'&reg;'   => '®',
			'&nbsp;'  => '',
			'&mdash;' => '—',
			'&amp;'   => '&',
			'&gt;'    => 'greater than',
			'&lt;'    => 'less than',
			'&#8211;' => '-',
			'&#8212;' => '—',
		);

		$text = strip_shortcodes( $text );
		$text = wp_strip_all_tags( $text, true );

		$text = str_replace( array_keys( $quotation_marks ), array_values( $quotation_marks ), $text );
		$text = str_replace( array_keys( $other_marks ), array_values( $other_marks ), $text );

		/**
		 * CF 16-Oct-19: We want to make sure no quotes are over-escaped (if somebody writes \" it will get substituted as \\",
		 * which will escape the slash instead of the quotation mark. We don't merge them in one regex because neither mark
		 * can _always_ be substituted with the other without changing the meaning of the sentence for the TTS engine.
		 * Note: backspaces need to be doubled. The first regex (\\\\{2,}") means: match two or more \ followed by "
		 */
		$text = preg_replace( '/\\\\{2,}"/', '\"', $text );
		$text = preg_replace( "/\\\\{2,}'/", "\'", $text );

		$text = preg_replace( '/\s+/', ' ', trim( $text ) ); // Get rid of /n and /s in the string.

		return $text;
	}

	/**
	 * Check if all the file path in the $file_path array exist. If they exist return true.
	 *
	 * @param array $file_path_a An array with the file paths.
	 *
	 * @return bool
	 */
	private function file_paths_exist( $file_path_a ) {

		// Check if all the file path in the $file_path_a array exist. If they exist set the $file_parts_exist to true.
		$file_parts_exist = true;
		if ( is_array( $file_path_a ) ) {
			foreach ( $file_path_a as $file_path ) {
				if ( ! file_exists( $file_path ) ) {
					$file_parts_exist = false;
					break;
				}
			}
		} else {
			$file_parts_exist = false;
		}

		return $file_parts_exist;
	}
}
