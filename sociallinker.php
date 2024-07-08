<?php
/**
 * Plugin Name
 *
 * @package           sociallinker
 * @author            Blocktech Lab
 *
 * Plugin Name:       SocialLinker
 * Plugin URI:        https://blocktech.dev
 * Description:       A plugin to add modern, open social media sharing links to your website.
 * Version:           0.7.1
 * Requires at least: 4.6
 * Requires PHP:      8.0
 * Author:            Blocktech Lab
 * Author URI:        https://blocktech.dev
 * Text Domain:       sociallinker
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define global to hold the plugin base file name.

if ( ! defined( 'SOCIALLINKERPLUGIN_BASE' ) ) {
	define( 'SOCIALLINKERPLUGIN_BASE', plugin_basename( __FILE__ ) );
}

// Include the shared functions.

require_once plugin_dir_path( __FILE__ ) . 'inc/shared.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/settings.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/add-sharing-link.php';
