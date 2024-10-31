<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package real-voice
 */

/**
 * This class should be used to work with the public side of WordPress.
 */
class Daextrevo_Public {

	/**
	 * The instance of this class.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * An instance of the plugin info.
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
	 * Constructor.
	 */
	private function __construct() {

		// Assign an instance of the plugin info.
		$this->shared = Daextrevo_Shared::get_instance();

		// Audio Files Management.
		$this->audio_files_management = Daextrevo_Audio_Files_Management::get_instance();

		// Add the feedback form at the end of the post content.
		add_filter( 'the_content', array( $this, 'add_player_html' ) );

		// Load public CSS.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Load public JS.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Create an instance of this class.
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
	 * Enqueue CSS styles.
	 *
	 * @return void
	 */
	public function enqueue_styles() {

		// Adds the Google Fonts if they are defined in the "Google Font URL" option.
		if ( strlen( trim( get_option( $this->shared->get( 'slug' ) . '_google_font_url' ) ) ) > 0 ) {

			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-google-font',
				esc_url( get_option( $this->shared->get( 'slug' ) . '_google_font_url' ) ),
				false,
				$this->shared->get( 'ver' )
			);

		}

		/**
		 * Enqueue speech-synthesis-player.js only if the text to speech converter is equal to speechsyntesis-api.
		 */
		$text_to_speech_converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );
		if ( 'speechsyntesis-api' === $text_to_speech_converter ) {

			if ( intval( get_option( $this->shared->get( 'slug' ) . '_development_mode' ), 10 ) === 0 ) {

				wp_enqueue_style(
					$this->shared->get( 'slug' ) . '-speech-synthesis-player',
					$this->shared->get( 'url' ) . 'public/assets/css/speech-synthesis-player.css',
					array(),
					$this->shared->get( 'ver' )
				);

			} else {

				wp_enqueue_style(
					$this->shared->get( 'slug' ) . '-speech-synthesis-player',
					$this->shared->get( 'url' ) . 'public/assets/css/dev/speech-synthesis-player.css',
					array(),
					$this->shared->get( 'ver' )
				);

			}
		}

		/**
		 * Enqueue audio-file-player.js only if the text to speech converter is different from speechsyntesis-api.
		 */
		$text_to_speech_converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );
		if ( 'speechsyntesis-api' !== $text_to_speech_converter ) {

			if ( intval( get_option( $this->shared->get( 'slug' ) . '_development_mode' ), 10 ) === 0 ) {

				wp_enqueue_style(
					$this->shared->get( 'slug' ) . '-audio-file-player',
					$this->shared->get( 'url' ) . 'public/assets/css/audio-file-player.css',
					array(),
					$this->shared->get( 'ver' )
				);

			} else {

				wp_enqueue_style(
					$this->shared->get( 'slug' ) . '-audio-file-player',
					$this->shared->get( 'url' ) . 'public/assets/css/dev/audio-file-player.css',
					array(),
					$this->shared->get( 'ver' )
				);

			}
		}

		// Enqueue the custom CSS file that includes the customization applied by the user via the options.
		$upload_dir_data = wp_upload_dir();
		wp_enqueue_style(
			$this->shared->get( 'slug' ) . '-custom',
			$upload_dir_data['baseurl'] . '/daextrevo_uploads/custom-' . get_current_blog_id() . '.css',
			array(),
			$this->shared->get( 'ver' )
		);
	}


	/**
	 * Enqueue the JavaScript files.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		/**
		 * Enqueue speech-synthesis-player.js only if the text to speech converter is equal to speechsyntesis-api.
		 */
		$text_to_speech_converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );
		if ( 'speechsyntesis-api' === $text_to_speech_converter ) {

			if ( intval( get_option( $this->shared->get( 'slug' ) . '_development_mode' ), 10 ) === 0 ) {

				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-speech-synthesis-player',
					$this->shared->get( 'url' ) . 'public/assets/js/speech-synthesis-player.js',
					array(),
					$this->shared->get( 'ver' ),
					true
				);

			} else {

				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-speech-synthesis-player',
					$this->shared->get( 'url' ) . 'public/assets/js/dev/speech-synthesis-player.js',
					array(),
					$this->shared->get( 'ver' ),
					true
				);

			}
		}

		/**
		 * Enqueue audio-file-player.js only if the text to speech converter is different from speechsyntesis-api.
		 */
		$text_to_speech_converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );
		if ( 'speechsyntesis-api' !== $text_to_speech_converter ) {

			if ( intval( get_option( $this->shared->get( 'slug' ) . '_development_mode' ), 10 ) === 0 ) {

				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-audio-file-player',
					$this->shared->get( 'url' ) . 'public/assets/js/audio-file-player.js',
					array(),
					$this->shared->get( 'ver' ),
					true
				);

			} else {

				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-audio-file-player',
					$this->shared->get( 'url' ) . 'public/assets/js/dev/audio-file-player.js',
					array(),
					$this->shared->get( 'ver' ),
					true
				);

				// Enqueue the audio-buffer-to-wav library.
				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-audio-buffer-to-wav-lib',
					$this->shared->get( 'url' ) . 'public/assets/js/dev/audiobuffer-to-wav/index.js',
					array(),
					$this->shared->get( 'ver' ),
					true
				);

				// Enqueue the file used to concatenate the audio files.
				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-concatenate',
					$this->shared->get( 'url' ) . 'public/assets/js/dev/concatenate.js',
					array(
						$this->shared->get( 'slug' ) . '-audio-file-player',
						$this->shared->get( 'slug' ) . '-audio-buffer-to-wav-lib',
					),
					$this->shared->get( 'ver' ),
					true
				);

			}
		}

		// Store the JavaScript parameters in the window.DAEXTREVO_PARAMETERS object.
		wp_add_inline_script(
			$this->shared->get( 'slug' ) . '-speech-synthesis-player',
			'window.DAEXTREVO_PHPDATA = ' . wp_json_encode(
				array(
					'speechSynthesisLang'   => get_option( $this->shared->get( 'slug' ) . '_speech_synthesis_lang' ),
					'speechSynthesisPitch'  => get_option( $this->shared->get( 'slug' ) . '_speech_synthesis_pitch' ),
					'speechSynthesisRate'   => get_option( $this->shared->get( 'slug' ) . '_speech_synthesis_rate' ),
					'speechSynthesisVolume' => get_option( $this->shared->get( 'slug' ) . '_speech_synthesis_volume' ),
				)
			),
			'before'
		);

		/**
		 * Get the value of the meta '_daextrevo_audio_file_path' and prepare it for the JavaScript considering that
		 * it's an array of strings.
		 */
		$audio_file_path = get_post_meta( get_the_ID(), '_daextrevo_audio_file_path', true );
		$audio_file_url  = get_post_meta( get_the_ID(), '_daextrevo_audio_file_url', true );

		// Store the JavaScript parameters in the window.DAEXTREVO_PARAMETERS object.
		wp_add_inline_script(
			$this->shared->get( 'slug' ) . '-audio-file-player',
			'window.DAEXTREVO_PHPDATA = ' . wp_json_encode(
				array(
					'audioFilePath' => $audio_file_path,
					'audioFileUrl'  => $audio_file_url,
				)
			),
			'before'
		);
	}

	/**
	 * Add the HTML of the audio player at the beginning of the post.
	 *
	 * @param string $content The content of the post.
	 *
	 * @return string
	 */
	public function add_player_html( $content ) {

		// turn on player_html buffering.
		ob_start();

		// Get the list of post types where the form should be applied.
		$post_types_a = maybe_unserialize( get_option( $this->shared->get( 'slug' ) . '_post_types' ) );

		// Verify the post type.
		if ( ! is_array( $post_types_a ) || ! in_array( get_post_type(), $post_types_a, true ) ) {

			return $content;

		}

		$player_container = $this->get_element_html();

		return $player_container . $content;
	}

	/**
	 * Get the HTML of the audio player displayed on the front end based on the provided $result and $mime_type.
	 *
	 * Note that based on the "Player Type" option the plugin can display either the browser audio player or a custom
	 * audio player.
	 *
	 * @param Array $result An array with the data of the audio file.
	 *
	 * @return false|string
	 */
	public function get_audio_player_html( $result ) {

		if ( isset( $result['status'] ) && 'success' === $result['status'] ) {

			// Get the SVG icons used in the player as an array.
			$player_svg = $this->get_player_svg_data();

			// Turn on output buffering.
			ob_start();

			?>
			<div id="daextrevo-audio-player-wrapper">
				<div id="daextrevo-audio-player-container">
					<audio src="" preload="metadata"></audio>
					<button id="daextrevo-play-icon">
						<div id="daextrevo-play-circle"><?php echo wp_kses( $player_svg['icons']['play_circle'], $player_svg['allowed_html'] ); ?></div>
						<div id="daextrevo-pause-circle" class="daextrevo-display-none"><?php echo wp_kses( $player_svg['icons']['pause_circle'], $player_svg['allowed_html'] ); ?></div>
					</button>
					<span id="daextrevo-current-time" class="daextrevo-time">0:00</span>
					<input type="range" id="daextrevo-seek-slider" max="100" value="0">
					<span id="daextrevo-duration" class="daextrevo-time">0:00</span>
					<div class="daextrevo-volume-section">
						<button id="daextrevo-mute-icon">
							<div id="daextrevo-volume-max"><?php echo wp_kses( $player_svg['icons']['volume_max'], $player_svg['allowed_html'] ); ?></div>
							<div id="daextrevo-volume-x" class="daextrevo-display-none"><?php echo wp_kses( $player_svg['icons']['volume_x'], $player_svg['allowed_html'] ); ?></div>
						</button>
						<input type="range" id="daextrevo-volume-slider" max="100" value="100">
						<output id="daextrevo-volume-output">100</output>
					</div>
				</div>
			</div>

			<?php

			$output = ob_get_clean();

		} else {
			$output = '';
		}

		return $output;
	}

	/**
	 * Get the HTML of the player used in the front-end to listen to the audio version of the post generated with the
	 * "SpeechSynthesis (Web Speech API)".
	 *
	 * @param int $post_id The post ID for which the player HTML should be generated.
	 *
	 * @return string
	 */
	public function get_speech_synthesis_player_html( $post_id ) {

		// Generate the text to speech content from the post content.
		$content = $this->audio_files_management->get_text_to_speech_content( $post_id );

		// Put the content to speech in a JavaScript variable.
		$script = '<script>var daextrevo_content = ' . wp_json_encode( $content[0] ) . ';</script>';

		// Get the SVG icons used in the player as an array.
		$player_svg = $this->get_player_svg_data();

		// Turn on output buffering.
		ob_start();

		?>

		<div id="daextrevo-audio-player-wrapper">
			<div id="daextrevo-audio-player-container">
				<button id="daextrevo-play-icon">
					<div id="daextrevo-play-circle"><?php echo wp_kses( $player_svg['icons']['play_circle'], $player_svg['allowed_html'] ); ?></div>
					<div id="daextrevo-pause-circle" class="daextrevo-display-none"><?php echo wp_kses( $player_svg['icons']['pause_circle'], $player_svg['allowed_html'] ); ?></div>
				</button>
				<span id="daextrevo-current-time" class="daextrevo-time">0:00</span>
			</div>
		</div>
		

		<?php

		$player = ob_get_clean();

		$output = $script . $player;

		return $output;
	}

	/**
	 * Get the SVG and the sanitization function used for the icons of both the audio player and the speech synthesis
	 *  player.
	 *
	 * @return array
	 */
	private function get_player_svg_data() {

		$data = array();

		$data['icons']['play_circle'] = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.5 8.96533C9.5 8.48805 9.5 8.24941 9.59974 8.11618C9.68666 8.00007 9.81971 7.92744 9.96438 7.9171C10.1304 7.90525 10.3311 8.03429 10.7326 8.29239L15.4532 11.3271C15.8016 11.551 15.9758 11.663 16.0359 11.8054C16.0885 11.9298 16.0885 12.0702 16.0359 12.1946C15.9758 12.337 15.8016 12.449 15.4532 12.6729L10.7326 15.7076C10.3311 15.9657 10.1304 16.0948 9.96438 16.0829C9.81971 16.0726 9.68666 15.9999 9.59974 15.8838C9.5 15.7506 9.5 15.512 9.5 15.0347V8.96533Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';

		$data['icons']['pause_circle'] = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.5 15V9M14.5 15V9M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                ';

		$data['icons']['volume_max'] = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.7479 4.99993C21.1652 6.97016 22 9.38756 22 11.9999C22 14.6123 21.1652 17.0297 19.7479 18.9999M15.7453 7.99993C16.5362 9.13376 17 10.5127 17 11.9999C17 13.4872 16.5362 14.8661 15.7453 15.9999M9.63432 4.36561L6.46863 7.5313C6.29568 7.70425 6.2092 7.79073 6.10828 7.85257C6.01881 7.9074 5.92127 7.9478 5.81923 7.9723C5.70414 7.99993 5.58185 7.99993 5.33726 7.99993H3.6C3.03995 7.99993 2.75992 7.99993 2.54601 8.10892C2.35785 8.20479 2.20487 8.35777 2.10899 8.54594C2 8.75985 2 9.03987 2 9.59993V14.3999C2 14.96 2 15.24 2.10899 15.4539C2.20487 15.6421 2.35785 15.7951 2.54601 15.8909C2.75992 15.9999 3.03995 15.9999 3.6 15.9999H5.33726C5.58185 15.9999 5.70414 15.9999 5.81923 16.0276C5.92127 16.0521 6.01881 16.0925 6.10828 16.1473C6.2092 16.2091 6.29568 16.2956 6.46863 16.4686L9.63431 19.6342C10.0627 20.0626 10.2769 20.2768 10.4608 20.2913C10.6203 20.3038 10.7763 20.2392 10.8802 20.1175C11 19.9773 11 19.6744 11 19.0686V4.9313C11 4.32548 11 4.02257 10.8802 3.88231C10.7763 3.76061 10.6203 3.69602 10.4608 3.70858C10.2769 3.72305 10.0627 3.93724 9.63432 4.36561Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';

		$data['icons']['volume_min'] = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.2451 7.99993C19.036 9.13376 19.4998 10.5127 19.4998 11.9999C19.4998 13.4872 19.036 14.8661 18.2451 15.9999M12.1343 4.36561L8.96863 7.5313C8.79568 7.70425 8.7092 7.79073 8.60828 7.85257C8.51881 7.9074 8.42127 7.9478 8.31923 7.9723C8.20414 7.99993 8.08185 7.99993 7.83726 7.99993H6.1C5.53995 7.99993 5.25992 7.99993 5.04601 8.10892C4.85785 8.20479 4.70487 8.35777 4.60899 8.54594C4.5 8.75985 4.5 9.03987 4.5 9.59993V14.3999C4.5 14.96 4.5 15.24 4.60899 15.4539C4.70487 15.6421 4.85785 15.7951 5.04601 15.8909C5.25992 15.9999 5.53995 15.9999 6.1 15.9999H7.83726C8.08185 15.9999 8.20414 15.9999 8.31923 16.0276C8.42127 16.0521 8.51881 16.0925 8.60828 16.1473C8.7092 16.2091 8.79568 16.2956 8.96863 16.4686L12.1343 19.6342C12.5627 20.0626 12.7769 20.2768 12.9608 20.2913C13.1203 20.3038 13.2763 20.2392 13.3802 20.1175C13.5 19.9773 13.5 19.6744 13.5 19.0686V4.9313C13.5 4.32548 13.5 4.02257 13.3802 3.88231C13.2763 3.76061 13.1203 3.69602 12.9608 3.70858C12.7769 3.72305 12.5627 3.93724 12.1343 4.36561Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';

		$data['icons']['volume_x'] = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 8.99993L16 14.9999M16 8.99993L22 14.9999M9.63432 4.36561L6.46863 7.5313C6.29568 7.70425 6.2092 7.79073 6.10828 7.85257C6.01881 7.9074 5.92127 7.9478 5.81923 7.9723C5.70414 7.99993 5.58185 7.99993 5.33726 7.99993H3.6C3.03995 7.99993 2.75992 7.99993 2.54601 8.10892C2.35785 8.20479 2.20487 8.35777 2.10899 8.54594C2 8.75985 2 9.03987 2 9.59993V14.3999C2 14.96 2 15.24 2.10899 15.4539C2.20487 15.6421 2.35785 15.7951 2.54601 15.8909C2.75992 15.9999 3.03995 15.9999 3.6 15.9999H5.33726C5.58185 15.9999 5.70414 15.9999 5.81923 16.0276C5.92127 16.0521 6.01881 16.0925 6.10828 16.1473C6.2092 16.2091 6.29568 16.2956 6.46863 16.4686L9.63431 19.6342C10.0627 20.0626 10.2769 20.2768 10.4608 20.2913C10.6203 20.3038 10.7763 20.2392 10.8802 20.1175C11 19.9773 11 19.6744 11 19.0686V4.9313C11 4.32548 11 4.02257 10.8802 3.88231C10.7763 3.76061 10.6203 3.69602 10.4608 3.70858C10.2769 3.72305 10.0627 3.93724 9.63432 4.36561Z"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';

		$data['allowed_html'] = array(
			'svg'  => array(
				'width'   => array(),
				'height'  => array(),
				'viewBox' => array(),
				'fill'    => array(),
				'xmlns'   => array(),
			),
			'path' => array(
				'd'               => array(),
				'stroke'          => array(),
				'stroke-width'    => array(),
				'stroke-linecap'  => array(),
				'stroke-linejoin' => array(),
			),
		);

		return $data;
	}

	/**
	 * Get the HTML of the element displayed in the front-end.
	 *
	 * The HTML includes text displayed before and after the player and the player itself.
	 *
	 * Note that if the "Generate Audio on Post View" option is enabled the plugin will also generate the audio file on
	 * the fly.
	 *
	 * @return string
	 */
	public function get_element_html() {

		// Do not add the player if we are not in a single post or page.
		if ( ! is_single() && ! is_page() ) {
			return '';
		}

		$post_id = get_the_ID();

		$text_to_speech_converter = get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' );

		switch ( $text_to_speech_converter ) {

			case 'speechsyntesis-api':
				$player_html = $this->get_speech_synthesis_player_html( $post_id );
				break;

			case 'google-text-to-speech-ai':
			case 'azure-text-to-speech':
				$result = $this->audio_files_management->get_audio_file( $post_id );

				if ( false === $result ) {
					return '';
				}

				$player_html = $this->get_audio_player_html( $result );
				break;

		}

		$text_before = get_option( $this->shared->get( 'slug' ) . '_text_before' );
		$text_after  = get_option( $this->shared->get( 'slug' ) . '_text_after' );

		$player_container = '<p>' . esc_html( $text_before ) . '</p>' . $player_html . '<p>' . esc_html( $text_after ) . '</p>';

		return $player_container;
	}
}
