<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package real-voice
 */

/**
 * This class should be used to work with the administrative side of WordPress.
 */
class Daextrevo_Admin {

	/**
	 * The single instance of the class.
	 *
	 * @var Daextrevo_Admin
	 */
	protected static $instance = null;

	/**
	 * An instance of the shared class.
	 *
	 * @var Daextrevo_Shared|null
	 */
	private $shared = null;

	/**
	 * The screen id of the api log menu.
	 *
	 * @var null
	 */
	private $screen_id_api_log = null;

	/**
	 * The screen id of the "Maintenance" menu.
	 *
	 * @var null
	 */
	private $screen_id_maintenance = null;

	/**
	 * The screen id of the options' menu.
	 *
	 * @var null
	 */
	private $screen_id_options = null;

	/**
	 * An instance of the class used to write the custom CSS file.
	 *
	 * @var Daextrevo_Write_Css_File|null
	 */
	private $write_css_file = null;

	/**
	 * An instance of the audio files management class.
	 *
	 * @var Daextrevo_Audio_Files_Management|null
	 */
	private $audio_files_management = null;

	/**
	 * Instance of the class used to generate the back-end menus.
	 *
	 * @var null
	 */
	private $menu_elements = null;

	/**
	 * Constructor.
	 */
	private function __construct() {

		// Assign an instance of the plugin shared class.
		$this->shared = Daextrevo_Shared::get_instance();

		// Audio Files Management.
		$this->audio_files_management = Daextrevo_Audio_Files_Management::get_instance();

		// Write CSS File.
		$this->write_css_file = Daextrevo_Write_Css_File::get_instance();

		// Load admin stylesheets and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the admin menu.
		add_action( 'admin_menu', array( $this, 'me_add_admin_menu' ) );

		// Add the meta box.
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ) );

		// Add the "Audio File" custom coumn to the post types defined in the "Post Types" option.
		$this->add_audio_file_custom_column();

		// Save the meta box data with the save_post hook.
		add_action( 'save_post', array( $this, 'save_meta' ) );

		// This hook is triggered during the creation of a new blog.
		add_action( 'wpmu_new_blog', array( $this, 'new_blog_create_options_and_tables' ), 10, 6 );

		// This hook is triggered during the deletion of a blog.
		add_action( 'delete_blog', array( $this, 'delete_blog_delete_options_and_tables' ), 10, 1 );

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce non-necessary for menu selection.
		$page_query_param = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : null;

		// Require and instantiate the class used to register the menu options.
		if ( null !== $page_query_param ) {

			$config = array(
				'admin_toolbar' => array(
					'items'      => array(
						array(
							'link_text' => __( 'API Log', 'real-voice'),
							'link_url'  => admin_url( 'admin.php?page=daextrevo-api-log' ),
							'icon'      => 'file-06',
							'menu_slug' => 'daextrevo-api-log',
						),
						array(
							'link_text' => __( 'Maintenance', 'real-voice'),
							'link_url'  => admin_url( 'admin.php?page=daextrevo-maintenance' ),
							'icon'      => 'tool-02',
							'menu_slug' => 'daextrevo-maintenance',
						),
						array(
							'link_text' => __( 'Options', 'real-voice'),
							'link_url'  => admin_url( 'admin.php?page=daextrevo-options' ),
							'icon'      => 'settings-01',
							'menu_slug' => 'daextrevo-options',
						),
					),
					'more_items' => array(
						array(
							'link_text' => __( 'Amazon Polly Settings', 'real-voice' ),
							'link_url'  => 'https://daext.com/real-voice/#pricing',
							'pro_badge' => true,
						),
						array(
							'link_text' => __( 'ElevenLabs Settings', 'real-voice' ),
							'link_url'  => 'https://daext.com/real-voice/#pricing',
							'pro_badge' => true,
						),
						array(
							'link_text' => __( 'Download Audio', 'real-voice' ),
							'link_url'  => 'https://daext.com/real-voice/#pricing',
							'pro_badge' => true,
						),
						array(
							'link_text' => __( 'Player Position', 'real-voice' ),
							'link_url'  => 'https://daext.com/real-voice/#pricing',
							'pro_badge' => true,
						),
					),
				),
			);

			// The parent class.
			require_once $this->shared->get( 'dir' ) . 'admin/inc/menu/class-daextrevo-menu-elements.php';

			if ( 'daextrevo-api-log' === $page_query_param ) {
				require_once $this->shared->get( 'dir' ) . 'admin/inc/menu/child/class-daextrevo-api-log-menu-elements.php';
				$this->menu_elements = new Daextrevo_Api_Log_Menu_Elements( $this->shared, $page_query_param, $config );
			}
			if ( 'daextrevo-maintenance' === $page_query_param ) {
				require_once $this->shared->get( 'dir' ) . 'admin/inc/menu/child/class-daextrevo-maintenance-menu-elements.php';
				$this->menu_elements = new Daextrevo_Maintenance_Menu_Elements( $this->shared, $page_query_param, $config );
			}
			if ( 'daextrevo-options' === $page_query_param ) {
				require_once $this->shared->get( 'dir' ) . 'admin/inc/menu/child/class-daextrevo-options-menu-elements.php';
				$this->menu_elements = new Daextrevo_Options_Menu_Elements( $this->shared, $page_query_param, $config );
			}
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return Daextrevo_Admin|self|null
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Enqueue the admin styles.
	 *
	 * @return void
	 */
	public function enqueue_admin_styles() {

		$screen = get_current_screen();

		// Menu api log -----------------------------------------------------------------------------------------------.
		if ( $screen->id === $this->screen_id_api_log ) {

			wp_enqueue_style( $this->shared->get( 'slug' ) . '-framework-menu', $this->shared->get( 'url' ) . 'admin/assets/css/framework-menu/main.css', array(), $this->shared->get( 'ver' ) );

			// Required to style the DatePicker component.
			wp_enqueue_style(
				'wp-components'
			);

		}

		// menu maintenance.
		if ( $screen->id === $this->screen_id_maintenance ) {

			wp_enqueue_style( $this->shared->get( 'slug' ) . '-framework-menu', $this->shared->get( 'url' ) . 'admin/assets/css/framework-menu/main.css', array(), $this->shared->get( 'ver' ) );

			// Select2.
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-select2',
				$this->shared->get( 'url' ) . 'admin/assets/inc/select2/css/select2.min.css',
				array(),
				$this->shared->get( 'ver' )
			);

			// jQuery UI Dialog.
			wp_enqueue_style(
				$this->shared->get( 'slug' ) . '-jquery-ui-dialog',
				$this->shared->get( 'url' ) . 'admin/assets/css/jquery-ui-dialog.css',
				array(),
				$this->shared->get( 'ver' )
			);

		}

		// Menu options -----------------------------------------------------------------------------------------------.
		if ( $screen->id === $this->screen_id_options ) {

			wp_enqueue_style( $this->shared->get( 'slug' ) . '-framework-menu', $this->shared->get( 'url' ) . 'admin/assets/css/framework-menu/main.css', array( 'wp-components' ), $this->shared->get( 'ver' ) );

		}

		// post editor ------------------------------------------------------------------------------------------------.

		/**
		 * Add the styles only in the post editor to configure the style of the meta boxes content.
		 */
		if ( current_user_can( get_option( $this->shared->get( 'slug' ) . '_editor_tools_capability' ) ) ) {

			// Load the assets for the post editor.
			$available_post_types_a = get_post_types(
				array(
					'show_ui' => true,
				)
			);

			// Remove the "attachment" post type.
			$available_post_types_a = array_diff( $available_post_types_a, array( 'attachment' ) );
			if ( in_array( $screen->id, $available_post_types_a, true ) ) {

				wp_enqueue_style(
					$this->shared->get( 'slug' ) . '-post-editor',
					$this->shared->get( 'url' ) . 'admin/assets/css/post-editor.css',
					array(),
					$this->shared->get( 'ver' )
				);

			}
		}
	}

	/**
	 * Enqueue the admin scripts.
	 *
	 * @return void
	 */
	public function enqueue_admin_scripts() {

		$wp_localize_script_data = array(
			'deleteText'         => esc_html__( 'Delete', 'real-voice'),
			'cancelText'         => esc_html__( 'Cancel', 'real-voice'),
			'chooseAnOptionText' => esc_html__( 'Choose an Option ...', 'real-voice'),
			'closeText'          => esc_html__( 'Close', 'real-voice'),
			'postText'           => esc_html__( 'Post', 'real-voice'),
			'itemsText'          => esc_html__( 'items', 'real-voice'),
			'dateTooltipText'    => esc_html__( 'The date of the feedback.', 'real-voice'),
			'ratingTooltipText'  => esc_html__( 'The rating received by the feedback.', 'real-voice'),
			'commentTooltipText' => esc_html__( 'The comment associated with the feedback.', 'real-voice'),
		);

		$screen = get_current_screen();

		// General.
		wp_enqueue_script( $this->shared->get( 'slug' ) . '-general', $this->shared->get( 'url' ) . 'admin/assets/js/general.js', array( 'jquery' ), $this->shared->get( 'ver' ), true );

		// menu API Log ------------------------------------------------------------------------------------------.
		if ( $screen->id === $this->screen_id_api_log ) {

			// Store the JavaScript parameters in the window.DAEXTREVO_PARAMETERS object.
			$initialization_script  = 'window.DAEXTREVO_PARAMETERS = {';
			$initialization_script .= 'ajax_url: "' . admin_url( 'admin-ajax.php' ) . '",';
			$initialization_script .= 'read_requests_nonce: "' . wp_create_nonce( 'daextrevo_read_requests_nonce' ) . '",';
			$initialization_script .= 'admin_url: "' . get_admin_url() . '",';
			$initialization_script .= 'site_url: "' . get_site_url() . '",';
			$initialization_script .= 'plugin_url: "' . $this->shared->get( 'url' ) . '",';
			$initialization_script .= 'items_per_page: ' . intval( get_option( $this->shared->get( 'slug' ) . '_pagination_items' ), 10 ) . ',';
			$initialization_script .= 'initial_date: "' . $this->shared->get_initial_date() . '",';
			$initialization_script .= 'final_date: "' . $this->shared->get_final_date() . '"';
			$initialization_script .= '};';

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-api-log-menu',
				$this->shared->get( 'url' ) . 'admin/react/api-log-menu/build/index.js',
				array( 'wp-element', 'wp-api-fetch', 'wp-i18n', 'wp-components' ),
				$this->shared->get( 'ver' ),
				true
			);

			wp_add_inline_script( $this->shared->get( 'slug' ) . '-api-log-menu', $initialization_script, 'before' );

			wp_enqueue_script( $this->shared->get( 'slug' ) . '-menu', $this->shared->get( 'url' ) . 'admin/assets/js/framework-menu/menu.js', array( 'jquery' ), $this->shared->get( 'ver' ), true );

		}

		// Menu Maintenance.
		if ( $screen->id === $this->screen_id_maintenance ) {

			// Select2.
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-select2',
				$this->shared->get( 'url' ) . 'admin/assets/inc/select2/js/select2.min.js',
				array( 'jquery' ),
				$this->shared->get( 'ver' ),
				true
			);

			wp_enqueue_script( $this->shared->get( 'slug' ) . '-menu', $this->shared->get( 'url' ) . 'admin/assets/js/framework-menu/menu.js', array( 'jquery' ), $this->shared->get( 'ver' ), true );

			// Maintenance Menu.
			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-maintenance',
				$this->shared->get( 'url' ) . 'admin/assets/js/menu-maintenance.js',
				array( 'jquery', 'jquery-ui-dialog', $this->shared->get( 'slug' ) . '-select2' ),
				$this->shared->get( 'ver' ),
				true
			);
			wp_localize_script(
				$this->shared->get( 'slug' ) . '-menu-maintenance',
				'objectL10n',
				$wp_localize_script_data
			);

		}

		// Menu Options -----------------------------------------------------------------------------------------------.
		if ( $screen->id === $this->screen_id_options ) {

			// Store the JavaScript parameters in the window.DAEXTREVO_PARAMETERS object.
			$initialization_script  = 'window.DAEXTREVO_PARAMETERS = {';
			$initialization_script .= 'ajax_url: "' . admin_url( 'admin-ajax.php' ) . '",';
			$initialization_script .= 'read_options_nonce: "' . wp_create_nonce( 'daextrevo_read_options_nonce' ) . '",';
			$initialization_script .= 'update_options_nonce: "' . wp_create_nonce( 'daextrevo_update_options_nonce' ) . '",';
			$initialization_script .= 'admin_url: "' . get_admin_url() . '",';
			$initialization_script .= 'site_url: "' . get_site_url() . '",';
			$initialization_script .= 'plugin_url: "' . $this->shared->get( 'url' ) . '",';

			require_once $this->shared->get( 'dir' ) . '/inc/class-daextrevo-menu-options.php';
			$daextrevo_menu_options = new Daextrevo_Menu_Options();
			$initialization_script  .= 'options_configuration_pages: ' . wp_json_encode( $daextrevo_menu_options->menu_options_configuration() );

			$initialization_script .= '};';

			wp_enqueue_script(
				$this->shared->get( 'slug' ) . '-menu-options-new',
				$this->shared->get( 'url' ) . 'admin/react/options-menu/build/index.js',
				array( 'wp-element', 'wp-api-fetch', 'wp-i18n', 'wp-components' ),
				$this->shared->get( 'ver' ),
				true
			);

			wp_add_inline_script( $this->shared->get( 'slug' ) . '-menu-options-new', $initialization_script, 'before' );

			wp_enqueue_script( $this->shared->get( 'slug' ) . '-menu', $this->shared->get( 'url' ) . 'admin/assets/js/framework-menu/menu.js', array( 'jquery' ), $this->shared->get( 'ver' ), true );

		}

		// Post editor ------------------------------------------------------------------------------------------------.

		/**
		 * When the editor file is loaded (only in the post editor) add helpful form statistics as
		 * json data in a property of the window.DAEXTREVO_PARAMETERS object.
		 */
		// Load the assets for the post editor.
		$available_post_types_a = get_post_types(
			array(
				'show_ui' => true,
			)
		);

		/**
		 * Add the styles only in the post editor to configure the style of the meta boxes content.
		 */
		if ( current_user_can( get_option( $this->shared->get( 'slug' ) . '_editor_tools_capability' ) ) ) {

			// Remove the "attachment" post type.
			$available_post_types_a = array_diff( $available_post_types_a, array( 'attachment' ) );
			if ( in_array( $screen->id, $available_post_types_a, true ) ) {

				// Post editor.
				wp_enqueue_script(
					$this->shared->get( 'slug' ) . '-post-editor',
					$this->shared->get( 'url' ) . 'admin/assets/js/post-editor.js',
					array( 'wp-api-fetch', 'wp-date' ),
					$this->shared->get( 'ver' ),
					true
				);

				// Store the JavaScript parameters in the window.DAEXTREVO_PARAMETERS object.
				$script  = 'window.DAEXTREVO_PARAMETERS = {';
				$script .= 'ajaxUrl: "' . admin_url( 'admin-ajax.php' ) . '",';
				$script .= 'create_audio_file_nonce: "' . wp_create_nonce( 'daextrevo_create_audio_file_nonce' ) . '",';
				$script .= 'delete_audio_file_nonce: "' . wp_create_nonce( 'daextrevo_delete_audio_file_nonce' ) . '",';
				$script .= 'adminUrl: "' . get_admin_url() . '",';
				$script .= 'textToSpeechConverter: "' . get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' ) . '",';
				$script .= '};';
				wp_add_inline_script( $this->shared->get( 'slug' ) . '-post-editor', $script, 'before' );

			}
		}
	}

	/**
	 * Plugin activation.
	 *
	 * @param bool $networkwide Whether to activate network-wide.
	 *
	 * @return void
	 */
	public static function ac_activate( $networkwide ) {

		/**
		 * Create options and tables for all the sites in the network.
		 */
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			/**
			 * If this is a "Network Activation" create the options and tables
			 *  for each blog.
			 */
			if ( $networkwide ) {

				// Get the current blog id.
				global $wpdb;
				$current_blog = $wpdb->blogid;

				// Create an array with all the blog ids.
				// phpcs:ignore WordPress.DB.DirectDatabaseQuery
				$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

				// Iterate through all the blogs.
				foreach ( $blogids as $blog_id ) {

					// Switch to the iterated blog.
					switch_to_blog( $blog_id );

					// Create options and tables for the iterated blog.
					self::ac_initialize_options();
					self::ac_initialize_post_meta();
					self::ac_create_database_tables();
					self::ac_initialize_custom_css();

				}

				// Switch to the current blog.
				switch_to_blog( $current_blog );

			} else {

				/**
				 * If this is not a "Network Activation" create options and
				 *  tables only for the current blog.
				 */
				self::ac_initialize_options();
				self::ac_initialize_post_meta();
				self::ac_create_database_tables();
				self::ac_initialize_custom_css();

			}
		} else {

			/**
			 * If this is not a multisite installation create options and
			 *  tables only for the current blog.
			 */
			self::ac_initialize_options();
			self::ac_initialize_post_meta();
			self::ac_create_database_tables();
			self::ac_initialize_custom_css();

		}
	}

	/**
	 * Create the options and tables for the newly created blog.
	 *
	 * @param int $blog_id Site ID.
	 *
	 * @return void
	 */
	public function new_blog_create_options_and_tables( $blog_id ) {

		global $wpdb;

		/**
		 * If the plugin is "Network Active" create the options and tables for
		 *  this new blog.
		 */
		if ( is_plugin_active_for_network( 'helpful-pro/init.php' ) ) {

			// Get the id of the current blog.
			$current_blog = $wpdb->blogid;

			// Switch to the blog that is being activated.
			switch_to_blog( $blog_id );

			// Create options and database tables for the new blog.
			$this->ac_initialize_options();
			$this->ac_initialize_post_meta();
			$this->ac_create_database_tables();
			$this->ac_initialize_custom_css();

			// Switch to the current blog.
			switch_to_blog( $current_blog );

		}
	}

	/**
	 * Delete options and tables for the deleted blog.
	 *
	 * @param int $blog_id Site ID.
	 *
	 * @return void
	 */
	public function delete_blog_delete_options_and_tables( $blog_id ) {

		global $wpdb;

		// Get the id of the current blog.
		$current_blog = $wpdb->blogid;

		// Switch to the blog that is being activated.
		switch_to_blog( $blog_id );

		// Create options and database tables for the new blog.
		$this->un_delete_options();
		$this->un_delete_database_tables();

		// Switch to the current blog.
		switch_to_blog( $current_blog );
	}

	/**
	 * Initialize plugin options.
	 *
	 * @return void
	 */
	public static function ac_initialize_options() {

		if ( intval( get_option( 'daextrevo_options_version' ), 10 ) < 1 ) {

			// Assign an instance of Daextrevo_Shared.
			$shared = Daextrevo_Shared::get_instance();

			foreach ( $shared->get( 'options' ) as $key => $value ) {
				add_option( $key, $value );
			}

			// Update options version.
			update_option( 'daextrevo_options_version', '1' );

		}
	}

	/**
	 * Initialize plugin post meta.
	 *
	 * @return void
	 */
	public static function ac_initialize_post_meta() {

		if ( intval( get_option( 'daextrevo_post_meta_version' ), 10 ) < 1 ) {

			// Assign an instance of Daextrevo_Shared.
			$shared = Daextrevo_Shared::get_instance();

			// Perform adaptation of the post meta.
			$shared->convert_post_meta_string_to_array();

			// Update options version.
			update_option( 'daextrevo_post_meta_version', '1' );

		}
	}

	/**
	 * Create the plugin database tables.
	 *
	 * @return void
	 */
	public static function ac_create_database_tables() {

		global $wpdb;

		// Get the database character collate that will be appended at the end of each query.
		$charset_collate = $wpdb->get_charset_collate();

		// Check database version and create the database.
		if ( intval( get_option( 'daextrevo_database_version' ), 10 ) < 1 ) {

			require_once ABSPATH . 'wp-admin/includes/upgrade.php';

			// Create *prefix*_request.
			$table_name = $wpdb->prefix . 'daextrevo_request';
			$sql        = "CREATE TABLE $table_name (
                request_id bigint(20) UNSIGNED AUTO_INCREMENT,
                request_date datetime DEFAULT NULL,
                converter TEXT DEFAULT NULL,
                characters INT UNSIGNED DEFAULT NULL,
                error TINYINT(1) UNSIGNED DEFAULT NULL,
                error_message TEXT DEFAULT NULL,
                PRIMARY KEY  (request_id)
            ) $charset_collate";
			dbDelta( $sql );

			// Update database version.
			update_option( 'daextrevo_database_version', '1' );

		}
	}

	/**
	 * Plugin delete.
	 *
	 * @return void
	 */
	public static function un_delete() {

		/**
		 * Delete options and tables for all the sites in the network.
		 */
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			// Get the current blog id.
			global $wpdb;
			$current_blog = $wpdb->blogid;

			// Create an array with all the blog ids.
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

			// Iterate through all the blogs.
			foreach ( $blogids as $blog_id ) {

				// Switch to the iterated blog.
				switch_to_blog( $blog_id );

				// Create options and tables for the iterated blog.
				self::un_delete_options();
				self::un_delete_database_tables();

			}

			// Switch to the current blog.
			switch_to_blog( $current_blog );

		} else {

			/**
			 * If this is not a multisite installation delete options and
			 *  tables only for the current blog.
			 */
			self::un_delete_options();
			self::un_delete_database_tables();

		}
	}

	/**
	 * Delete plugin options.
	 *
	 * @return void
	 */
	public static function un_delete_options() {

		// Assign an instance of Daextrevo_Shared.
		$shared = Daextrevo_Shared::get_instance();

		foreach ( $shared->get( 'options' ) as $key => $value ) {
			delete_option( $key );
		}
	}

	/**
	 * Delete plugin database tables.
	 *
	 * @return void
	 */
	public static function un_delete_database_tables() {

		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$wpdb->query( "DROP TABLE {$wpdb->prefix}daextrevo_request" );
	}

	/**
	 * Register the admin menu.
	 *
	 * @return void
	 */
	public function me_add_admin_menu() {

		$icon_svg = '<?xml version="1.0" encoding="UTF-8"?>
		<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 40 40">
		    <defs>
		        <style>
		            .cls-1 {
		            fill: #98a3b3;
		            }
		        </style>
		    </defs>
		    <g>
		        <g id="Layer_1">
		            <g id="real-voice">
		                <path class="cls-1" d="M20,4c8.8,0,16,7.2,16,16s-7.2,16-16,16S4,28.8,4,20,11.2,4,20,4M20,2C10.1,2,2,10.1,2,20s8.1,18,18,18,18-8.1,18-18S29.9,2,20,2h0Z"/>
		                <path class="cls-1" d="M16,27.6c-.3,0-.5,0-.8-.2-.5-.3-.7-.8-.7-1.3v-12.1c0-.5.3-1,.7-1.3.5-.3,1-.3,1.5,0l10.5,6.1c.5.3.8.8.8,1.3s-.3,1-.8,1.3l-10.5,6.1c-.2.1-.5.2-.8.2ZM16.5,14.8v10.4l9-5.2-9-5.2Z"/>
		            </g>
		        </g>
		    </g>
		</svg>';

		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode -- Base64 encoding is used to embed the SVG in the HTML.
		$icon_svg = 'data:image/svg+xml;base64,' . base64_encode( $icon_svg );
		add_menu_page(
			esc_html__( 'RV', 'real-voice'),
			esc_html__( 'Real Voice', 'real-voice'),
			get_option( $this->shared->get( 'slug' ) . '_api_log_menu_capability' ),
			$this->shared->get( 'slug' ) . '-api-log',
			array( $this, 'me_display_menu_api_log' ),
			$icon_svg
		);

		$this->screen_id_api_log = add_submenu_page(
			$this->shared->get( 'slug' ) . '-api-log',
			esc_html__( 'RV - API Log', 'real-voice'),
			esc_html__( 'API Log', 'real-voice'),
			get_option( $this->shared->get( 'slug' ) . '_api_log_menu_capability' ),
			$this->shared->get( 'slug' ) . '-api-log',
			array( $this, 'me_display_menu_api_log' )
		);

		$this->screen_id_maintenance = add_submenu_page(
			$this->shared->get( 'slug' ) . '-api-log',
			esc_html__( 'HF - Maintenance', 'real-voice'),
			esc_html__( 'Maintenance', 'real-voice'),
			get_option( $this->shared->get( 'slug' ) . '_maintenance_menu_capability' ),
			$this->shared->get( 'slug' ) . '-maintenance',
			array( $this, 'me_display_menu_maintenance' )
		);

		$this->screen_id_options = add_submenu_page(
			$this->shared->get( 'slug' ) . '-api-log',
			esc_html__( 'RV - Options', 'real-voice'),
			esc_html__( 'Options', 'real-voice'),
			'manage_options',
			$this->shared->get( 'slug' ) . '-options',
			array( $this, 'me_display_menu_options' )
		);

		add_submenu_page(
			$this->shared->get( 'slug' ) . '-api-log',
			esc_html__( 'Help & Support', 'real-voice'),
			esc_html__( 'Help & Support', 'real-voice') . '<i class="dashicons dashicons-external" style="font-size:12px;vertical-align:-2px;height:10px;"></i>',
			'manage_options',
			'https://daext.com/kb-category/real-voice/',
		);
	}

	/**
	 * Includes the api log menu.
	 *
	 * @return void
	 */
	public function me_display_menu_api_log() {
		include_once 'view/api-log.php';
	}

	/**
	 * Includes the maintenance menu.
	 *
	 * @return void
	 */
	public function me_display_menu_maintenance() {
		include_once 'view/maintenance.php';
	}

	/**
	 * Includes the options' menu.
	 *
	 * @return void
	 */
	public function me_display_menu_options() {
		include_once 'view/options.php';
	}

	/**
	 * Initialize the custom-[blog_id].css file.
	 *
	 * @return void
	 */
	public static function ac_initialize_custom_css() {

		// Write CSS File.
		$write_css_file = Daextrevo_Write_Css_File::get_instance();

		/**
		 * Write the custom-[blog_id].css file or die if the file can't be created or modified.
		 */
		if ( $write_css_file->write_custom_css() === false ) {
			die( "The plugin can't write files in the upload directory." );
		}
	}

	/**
	 * Create the "Audio File" and "Text to Speech" meta boxes in the post types defined in the "Post Types" option.
	 *
	 * @return void
	 */
	public function create_meta_box() {

		if ( current_user_can( get_option( $this->shared->get( 'slug' ) . '_editor_tools_capability' ) ) ) {

			// Get the list of post types where the meta boxes should be applied.
			$post_types_a = maybe_unserialize( get_option( $this->shared->get( 'slug' ) . '_post_types_ui' ) );

			foreach ( $post_types_a as $post_type ) {

				add_meta_box(
					'daextrevo-real-voice',
					esc_html__( 'Audio File', 'real-voice'),
					array( $this, 'audio_file_meta_box_callback' ),
					$post_type,
					'normal',
					'high',
					/**
					 * Reference: https://make.wordpress.org/core/2018/11/07/meta-box-compatibility-flags/
					 */
					array(

						/**
						 * It's not confirmed that this meta box works in the block editor.
						 */
						'__block_editor_compatible_meta_box' => false,

						/**
						 * This meta box should only be loaded in the classic editor interface, and the block editor
						 *  should not display it.
						 */
						'__back_compat_meta_box' => true,

					)
				);

				add_meta_box(
					'daextrevo-text-to-speech',
					esc_html__( 'Text to Speech', 'real-voice'),
					array( $this, 'text_to_speech_meta_box_callback' ),
					$post_type,
					'normal',
					'high',
					/**
					 * Reference: https://make.wordpress.org/core/2018/11/07/meta-box-compatibility-flags/
					 */
					array(

						/**
						 * It's not confirmed that this meta box works in the block editor.
						 */
						'__block_editor_compatible_meta_box' => false,

						/**
						 * This meta box should only be loaded in the classic editor interface, and the block editor
						 *  should not display it.
						 */
						'__back_compat_meta_box' => true,

					)
				);

			}
		}
	}

	/**
	 * Callback used to generate the content of the "Audio File" meta box.
	 *
	 * @param int $post The ID of the post.
	 * @return void
	 */
	public function audio_file_meta_box_callback( $post ) {

		// Echo a message and return if the post is an auto-draft.
		$post_status = get_post_status( $post );
		if ( 'auto-draft' === $post_status ) {
			echo '<p>' . esc_html__( 'To enable this section, please save the post.', 'real-voice') . '</p>';
			return;
		}

		$audio_file_exists = true;

		$audio_file_url           = get_post_meta( $post->ID, '_daextrevo_audio_file_url', true );
		$audio_file_creation_date = get_post_meta( $post->ID, '_daextrevo_audio_file_creation_date', true );

		if ( is_array($audio_file_url ) && count( $audio_file_url ) > 0 ) {
			$formatted_date = wp_date( 'F j, o g:H a \U\T\CP', $audio_file_creation_date );
		} else {
			$formatted_date    = '';
			$audio_file_exists = false;
		}

		?>

		<table class="form-table">
			<tbody>

			<?php

			wp_nonce_field( 'daextrevo_create_audio_file_nonce', 'daextrevo_create_audio_file_nonce' );
			wp_nonce_field( 'daextrevo_delete_audio_file_nonce', 'daextrevo_delete_audio_file_nonce' );

			if ( $audio_file_exists ) {

				echo '<p id="daextrevo-audio-file-creation-date">' . esc_html__( 'Timestamp', 'real-voice') . ': <span id="daextrevo-audio-file-creation-date-value">' . esc_html( $formatted_date ) . '</span></p>';
				echo '<p id="daextrevo-create-file-message" class="daextrevo-display-none">' . esc_html__( 'Click "Generate file" to create an audio file from the configured content.', 'real-voice') . '</p>';
				echo '<button type="button" class="components-button editor-post-trash daextrevo-generate-file-button is-secondary" id="daextrevo-generate-audio-file">' . esc_html__( 'Generate file', 'real-voice') . '</button>';
				echo '<button type="button" class="components-button editor-post-trash is-destructive daextrevo-delete-file-button is-secondary" id="daextrevo-delete-audio-file">' . esc_html__( 'Delete file', 'real-voice') . '</button>';

			} else {

				echo '<p id="daextrevo-audio-file-creation-date" class="daextrevo-display-none">' . esc_html__( 'Timestamp', 'real-voice') . ': <span id="daextrevo-audio-file-creation-date-value">' . esc_html( $formatted_date ) . '</span></p>';
				echo '<p id="daextrevo-create-file-message">' . esc_html__( 'Click "Generate file" to create an audio file from the configured content.', 'real-voice') . '</p>';
				echo '<button type="button" class="components-button editor-post-trash daextrevo-generate-file-button is-secondary" id="daextrevo-generate-audio-file">' . esc_html__( 'Generate file', 'real-voice') . '</button>';
				echo '<button type="button" class="components-button editor-post-trash is-destructive daextrevo-delete-file-button is-secondary daextrevo-display-none" id="daextrevo-delete-audio-file">' . esc_html__( 'Delete file', 'real-voice') . '</button>';

			}
			?>

			</tbody>
		</table>

		<?php

		// Use nonce for verification.
		wp_nonce_field( plugin_basename( __FILE__ ), 'daextrevo_nonce' );
	}

	/**
	 * Callback used to generate the content of the "Text to Speech" meta box.
	 *
	 * @param object $post The post object.
	 * @return void
	 */
	public function text_to_speech_meta_box_callback( $post ) {

		$text_to_speech = get_post_meta( $post->ID, '_daextrevo_text_to_speech', true );
		$document_type  = get_post_meta( $post->ID, '_daextrevo_document_type', true );

		wp_nonce_field( 'daextrevo_update_meta', 'daextrevo_update_meta_nonce' );

		?>

		<label for="daextrevo-textarea" class="daextrevo-label"><?php esc_html_e( 'Document (Text/SSML)', 'real-voice'); ?></label>
		<textarea id="daextrevo-textarea" rows="4" class="daextrevo-textarea" name="daextrevo_text_to_speech"><?php echo esc_html( $text_to_speech ); ?></textarea>
		<p class="daextrevo-paragraph"><?php esc_html_e( 'Enter the text/SSML to synthesize or leave this field empty to use the post content.', 'real-voice'); ?></p>

		<label for="daextrevo-document-type" class="daextrevo-label"><?php esc_html_e( 'Document Type', 'real-voice'); ?></label>
		<select id="daextrevo-document-type" class="daextrevo-document-type" name="daextrevo_document_type">
			<option value="text" <?php selected( $document_type, 'text' ); ?>><?php esc_html_e( 'Text', 'real-voice'); ?></option>
			<option value="ssml" <?php selected( $document_type, 'ssml' ); ?>><?php esc_html_e( 'SSML', 'real-voice'); ?></option>
		</select>
		<p class="daextrevo-paragraph"><?php esc_html_e( 'Select if you want to provide the document as plain text or in SSML.', 'real-voice'); ?></p>

		<?php

		// Use nonce for verification.
		wp_nonce_field( plugin_basename( __FILE__ ), 'daextrevo_nonce' );
	}

	/**
	 * Save the data in the "Text to Speech" meta box.
	 *
	 * @param int $post_id The ID of the post.
	 *
	 * @return void
	 */
	public function save_meta( $post_id ) {

		/* --- security verification --- */

		/**
		 * Verify if this is an auto save routine.
		 * If our form has not been submitted the save routine will stop here.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		/**
		 * Allowed tags for the wp_kses function. This array should cover all the possible SSML tags provided by all the
		 * used text-to-speech services.
		 */
		$ssml_tags = array(
			'speak'    => array(),
			'break'    => array( 'time' => array() ),
			'phoneme'  => array(
				'alphabet' => array(),
				'ph'       => array(),
			),
			'prosody'  => array(
				'pitch'  => array(),
				'rate'   => array(),
				'volume' => array(),
			),
			'say-as'   => array(
				'interpret-as' => array(),
				'format'       => array(),
			),
			'emphasis' => array( 'level' => array() ),
			'p'        => array(),
			's'        => array(),
			'voice'    => array( 'name' => array() ),
		);

		// Sanitization.
		$nonce          = isset( $_POST['daextrevo_update_meta_nonce'] ) ? sanitize_key( wp_unslash( $_POST['daextrevo_update_meta_nonce'] ) ) : null;
		$text_to_speech = isset( $_POST['daextrevo_text_to_speech'] ) ? wp_kses( wp_unslash( $_POST['daextrevo_text_to_speech'] ), $ssml_tags ) : null;
		$document_type  = isset( $_POST['daextrevo_document_type'] ) ? sanitize_text_field( wp_unslash( $_POST['daextrevo_document_type'] ) ) : null;

		/**
		 * Verify this came from our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */
		if ( ! wp_verify_nonce( $nonce, 'daextrevo_update_meta' ) ) {
			return;
		}

		/* - end security verification - */

		// Save the meta data.
		update_post_meta( $post_id, '_daextrevo_text_to_speech', $text_to_speech );
		update_post_meta( $post_id, '_daextrevo_document_type', $document_type );
	}

	/**
	 * Add a custom column named "Audio File" to the post listing page.
	 *
	 * Notes:
	 *
	 * - This column is applied only when the Text-to-speech Converter is different from "SpeechSynthesis (Web Speech
	 * api). This because with the SpeechSynthesis (Web Speech API) the audio file is generated in the browser and
	 * there is no need to generate it in the server and display the audio file status with a custom column.
	 * - This column is applied only to the post types defined with the "Post Types" option.
	 *
	 * See: https://wordpress.stackexchange.com/questions/253640/adding-custom-columns-to-custom-post-types
	 *
	 * @return void
	 */
	public function add_audio_file_custom_column() {

		if ( get_option( $this->shared->get( 'slug' ) . '_text_to_speech_converter' ) !== 'speechsyntesis-api' ) {

			// Get the list of post types where the form should be applied.
			$post_types_a = maybe_unserialize( get_option( $this->shared->get( 'slug' ) . '_post_types_ui' ) );

			// Add the custom column to the post types defined in the "Post Types" option.
			if ( is_array( $post_types_a ) && count( $post_types_a ) > 0 ) {
				foreach ( $post_types_a as $post_type ) {

					// Add the custom column.
					add_filter( 'manage_' . $post_type . '_posts_columns', array( $this, 'set_custom_edit_post_columns' ) );

					// Add the data to the custom column.
					add_action( 'manage_' . $post_type . '_posts_custom_column', array( $this, 'custom_columns' ), 10, 2 );

				}
			}
		}
	}

	/**
	 * Add a custom column named "Audio File" to the post listing page.
	 *
	 * @param array $columns An array with the existing columns.
	 *
	 * @return mixed
	 */
	public function set_custom_edit_post_columns( $columns ) {
		$columns['daextrevo_audio_file'] = __( 'Audio File', 'helpful-pro' );
		return $columns;
	}

	/**
	 * Generate and echo the content of the "Audio File" custom column. (registered as "daextrevo_audio_file")
	 *
	 * @param string $column The column name.
	 * @param int    $post_id The ID of the post.
	 */
	public function custom_columns( $column, $post_id ) {

		if ( 'daextrevo_audio_file' === $column ) {

			$audio_file_status = $this->audio_files_management->get_audio_file_status( $post_id );

			// Get the meta with the last update date.
			$audio_file_creation_date           = get_post_meta( $post_id, '_daextrevo_audio_file_creation_date', true );
			$audio_file_creation_date_formatted = wp_date( 'Y/m/d \a\t g:i a', $audio_file_creation_date ) . ' UTC';

			echo '<div class="daextrevo-container">';

			switch ( $audio_file_status ) {

				case 0:
					?>

					<div class="daextrevo-file-info">
						<div><?php esc_html_e( 'Not available', 'real-voice'); ?></div>
					</div>

					<?php

					break;

				case 1:
					?>

					<div class="daextrevo-file-info">
						<div><?php esc_html_e( 'Available (not updated)', 'real-voice'); ?></div>
						<div><?php echo esc_html( $audio_file_creation_date_formatted ); ?></div>
					</div>

					<?php

					break;

				case 2:
					?>

					<div class="daextrevo-file-info">
						<div><?php esc_html_e( 'Available', 'real-voice'); ?></div>
						<div><?php echo esc_html( $audio_file_creation_date_formatted ); ?></div>
					</div>

					<?php

					break;

			}

			echo '</div>';

		}
	}
}