<?php
/**
 * Uninstall plugin.
 *
 * @package real-voice
 */

// Exit if this file is not called during the uninstallation process.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die();
}

require_once plugin_dir_path( __FILE__ ) . 'shared/class-daextrevo-shared.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/class-daextrevo-admin.php';

// Delete options and tables.
Daextrevo_Admin::un_delete();
