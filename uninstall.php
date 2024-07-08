<?php
/**
 * Uninstaller
 *
 * Uninstall the plugin by removing any options from the database
 *
 * @package sociallinker
 */

// If the uninstall was not called by WordPress, exit.

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete options.

delete_option( 'sociallinker_type' );
delete_option( 'sociallinker_text' );
delete_option( 'sociallinker_priority' );
