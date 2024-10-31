<?php
/**
 * Use to include the block editor assets and to register the meta fields used in the components of the post sidebar.
 *
 * @package real-voice
 */

// Prevent direct access to this file.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// The daextrevo_init_editor_assets method has been added to the init hook to make current_user_can() available.
add_action( 'init', 'daextrevo_init_editor_assets' );

/**
 * Add the action use to include the block editor assets.
 *
 * Note that the "Editor Tools Capability" is configured in the plugin settings page.
 */
function daextrevo_init_editor_assets() {

	if ( current_user_can( get_option( 'daextrevo_editor_tools_capability' ) ) ) {

		/**
		 * Do not enable the editor assets if we are in one of the following menus:
		 *
		 * - Appearance -> Widgets (widgets.php).
		 * - Appearance -> Editor (site-editor.php)
		 *
		 * Enabling the assets in the widgets.php or site-editor.php menus would cause errors because the post editor sidebar is
		 * not available in these menus.
		 */
		global $pagenow;
		if ( 'widgets.php' !== $pagenow &&
			'site-editor.php' !== $pagenow ) {
			add_action( 'enqueue_block_editor_assets', 'daextrevo_editor_assets' );
		}
	}
}

/**
 * Enqueue the Gutenberg block assets for the backend.
 *
 * 'wp-blocks': includes block type registration and related functions.
 * 'wp-element': includes the WordPress Element abstraction for describing the structure of your blocks.
 */
function daextrevo_editor_assets() {

	// Scripts --------------------------------------------------------------------------------------------------------.

	// Assign an instance of the plugin shared class.
	$plugin_dir = substr( plugin_dir_path( __FILE__ ), 0, - 11 );
	require_once $plugin_dir . 'shared/class-daextrevo-shared.php';
	$shared = Daextrevo_Shared::get_instance();

	// Get the list of post types where the block sidebar sections should be added.
	$post_types_a = maybe_unserialize( get_option( $shared->get( 'slug' ) . '_post_types_ui' ) );

	// Verify the post type.
	if ( ! is_array( $post_types_a ) || ! in_array( get_post_type(), $post_types_a, true ) ) {

		return;

	}

	// Block.
	wp_enqueue_script(
		'daextrevo-editor-js', // Handle.
		plugins_url( '/build/index.js', __DIR__ ), // We register the block here.
		array( 'wp-blocks', 'wp-element' ), // Dependencies.
		$shared->get( 'ver' ),
		true // Enqueue the script in the footer.
	);
}



/**
 * Register the meta fields used in the components of the post sidebar.
 *
 * See: https://developer.wordpress.org/reference/functions/register_post_meta/
 */
function real_voice_pro_register_post_meta() {

	// Assign an instance of the plugin shared class.
	$plugin_dir = substr( plugin_dir_path( __FILE__ ), 0, - 11 );
	require_once $plugin_dir . 'shared/class-daextrevo-shared.php';
	$shared = Daextrevo_Shared::get_instance();

	// Register the support of the 'custom-fields' to all the post type with UI.
	$shared->register_support_on_post_types();

	/*
	 * Register the meta used to save the value of the textarea available in the "Submit Text" section of the post
	 * sidebar included in the post editor.
	 */
	register_post_meta(
		'', // Registered in all post types.
		'_daextrevo_audio_file_creation_date',
		array(
			'auth_callback' => '__return_true',
			'default'       => '',
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'string',
		)
	);

	/*
	 * Register the meta used to save the value of the textarea available in the "Text to Speech" section of the post
	 * sidebar included in the post editor.
	 */
	register_post_meta(
		'', // Registered in all post types.
		'_daextrevo_text_to_speech',
		array(
			'auth_callback' => '__return_true',
			'default'       => '',
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'string',
		)
	);

	/*
	 * Register the meta used to save the value of the selector available in the "Text to Speech" section of the post
	 * sidebar included in the post editor.
	 */
	register_post_meta(
		'', // Registered in all post types.
		'_daextrevo_document_type',
		array(
			'auth_callback' => '__return_true',
			'default'       => '',
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'string',
		)
	);
}

add_action( 'init', 'real_voice_pro_register_post_meta', 100000 );
