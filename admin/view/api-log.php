<?php
/**
 * The file used to display the "API Log" menu in the admin area.
 *
 * @package real-voice
 */

$this->menu_elements->capability = get_option( $this->shared->get( 'slug' ) . '_api_log_menu_capability' );
$this->menu_elements->context    = null;
$this->menu_elements->display_menu_content();
