<?php
/**
 * Plugin Name: Real Voice
 * Description: Versatile Text to Speech plugin for WordPress.
 * Version: 1.12
 * Author: DAEXT
 * Author URI: https://daext.com
 * Text Domain: real-voice
 * License: GPLv3
 *
 * @package real-voice
 */

// Prevent direct access to this file.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// Set constants.
define( 'DAEXTREVO_EDITION', 'FREE' );

// Shared across public and admin.
require_once plugin_dir_path( __FILE__ ) . 'shared/class-daextrevo-shared.php';

// Class to handle the audio files.
require_once plugin_dir_path( __FILE__ ) . 'inc/class-daextrevo-audio-files-management.php';

// Class to write custom CSS files.
require_once plugin_dir_path( __FILE__ ) . 'inc/class-daextrevo-write-css-file.php';

// Rest API.
require_once plugin_dir_path( __FILE__ ) . 'inc/class-daextrevo-rest.php';
add_action( 'plugins_loaded', array( 'Daextrevo_Rest', 'get_instance' ) );

// Perform the Gutenberg related activities only if Gutenberg is present.
if ( function_exists( 'register_block_type' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'blocks/src/init.php';
}

require_once plugin_dir_path( __FILE__ ) . 'public/class-daextrevo-public.php';
add_action( 'plugins_loaded', array( 'Daextrevo_Public', 'get_instance' ) );

// Admin.
if ( is_admin() ) {

	// Admin.
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-daextrevo-admin.php';

	// If this is not an AJAX request, create a new singleton instance of the admin class.
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		add_action( 'plugins_loaded', array( 'Daextrevo_Admin', 'get_instance' ) );
	}

	// Activate the plugin using only the class static methods.
	register_activation_hook( __FILE__, array( 'Daextrevo_Admin', 'ac_activate' ) );

	// Update the plugin db tables and options if they are not up-to-date.
	Daextrevo_Admin::ac_create_database_tables();
	Daextrevo_Admin::ac_initialize_options();
	Daextrevo_Admin::ac_initialize_post_meta();

}
