<?php
/**
 * Shared Functions
 *
 * A group of functions shared across my plugins, for consistency.
 *
 * @package sociallinker
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add meta to plugin details
 *
 * Add options to plugin meta line
 *
 * @version  1.1
 * @param    string $links  Current links.
 * @param    string $file   File in use.
 * @return   string         Links, now with settings added.
 */
function sociallinker_plugin_meta( $links, $file ) {

	if ( false !== strpos( $file, 'sociallinker.php' ) ) {

		$links = array_merge(
			$links,
			array( '<a href="https://github.com/blocktech-lab/sociallinker">' . __( 'Github', 'sociallinker' ) . '</a>' ),
		);
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'sociallinker_plugin_meta', 10, 2 );

/**
 * Modify actions links.
 *
 * Add or remove links for the actions listed against this plugin
 *
 * @version  1.1
 * @param    string $actions      Current actions.
 * @param    string $plugin_file  The plugin.
 * @return   string               Actions, now with deactivation removed!
 */
function sociallinker_action_links( $actions, $plugin_file ) {

	// Make sure we only perform actions for this specific plugin!
	if ( strpos( $plugin_file, 'sociallinker.php' ) !== false ) {

		// Add link to the settings page.
		if ( current_user_can( 'manage_options' ) ) {
			array_unshift( $actions, '<a href="options-discussion.php#sociallinker-settings">' . __( 'Settings', 'sociallinker' ) . '</a>' );
		}
	}

	return $actions;
}

add_filter( 'plugin_action_links', 'sociallinker_action_links', 10, 2 );

/**
 * WordPress Fork Check
 *
 * Deactivate the plugin if an unsupported fork of WordPress is detected.
 *
 * @version 1.0
 */
function sociallinker_fork_check() {

	// Check for a fork.

	if ( function_exists( 'calmpress_version' ) || function_exists( 'classicpress_version' ) ) {

		// Grab the plugin details.

		$plugins = get_plugins();
		$name    = $plugins[ SOCIALLINKERPLUGIN_BASE ]['Name'];

		// Deactivate this plugin.

		deactivate_plugins( SOCIALLINKERPLUGIN_BASE );

		// Set up a message and output it via wp_die.

		/* translators: 1: The plugin name. */
		$message = '<p><b>' . sprintf( __( '%1$s has been deactivated', 'sociallinker' ), $name ) . '</b></p><p>' . __( 'Reason:', 'sociallinker' ) . '</p>';
		/* translators: 1: The plugin name. */
		$message .= '<ul><li>' . __( 'A fork of WordPress was detected.', 'sociallinker' ) . '</li></ul><p>' . sprintf( __( 'The author of %1$s will not provide any support until the above are resolved.', 'sociallinker' ), $name ) . '</p>';

		$allowed = array(
			'p'  => array(),
			'b'  => array(),
			'ul' => array(),
			'li' => array(),
		);

		wp_die( wp_kses( $message, $allowed ), '', array( 'back_link' => true ) );
	}
}

add_action( 'admin_init', 'sociallinker_fork_check' );
