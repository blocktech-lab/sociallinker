<?php
/**
 * Settings functions
 *
 * Assorted functions to add and create settings.
 *
 * @package sociallinker
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the settings
 *
 * @return   array     Settings array.
 */
function sociallinker_get_settings() {

	$settings = array();

	// Get the post type.

	$settings['type'] = esc_html( get_option( 'sociallinker_type' ) );
	if ( ! $settings['type'] ) {
		$settings['type'] = 'postpage';
	}

	// Get the share text.

	$settings['text'] = esc_attr( get_option( 'sociallinker_text' ) );
	if ( ! $settings['text'] ) {
		$settings['text'] = __( 'Share this post.', 'sociallinker' );
	}

	// Get the output priority.

	$settings['priority'] = esc_attr( get_option( 'sociallinker_priority' ) );
	if ( ! $settings['priority'] ) {
		$settings['priority'] = 10;
	}

	return $settings;
}

/**
 * Add to settings
 *
 * Add a field to the general settings screen for assorted options
 */
function sociallinker_settings_init() {

	add_settings_section( 'sociallinker_section', __( 'SocialLinker', 'sociallinker' ), 'sociallinker_settings_section', 'discussion' );

	add_settings_field( 'sociallinker_type', __( 'Sharing link location', 'sociallinker' ), 'sociallinker_type_callback', 'discussion', 'sociallinker_section', array( 'label_for' => 'sociallinker_type' ) );

	register_setting( 'discussion', 'sociallinker_type' );

	add_settings_field( 'sociallinker_text', __( 'Share Text', 'sociallinker' ), 'sociallinker_text_callback', 'discussion', 'sociallinker_section', array( 'label_for' => 'sociallinker_text' ) );

	register_setting( 'discussion', 'sociallinker_text' );

	add_settings_field( 'sociallinker_priority', __( 'Priority', 'sociallinker' ), 'sociallinker_priority_callback', 'discussion', 'sociallinker_section', array( 'label_for' => 'sociallinker_priority' ) );

	register_setting( 'discussion', 'sociallinker_priority' );
}

add_action( 'admin_init', 'sociallinker_settings_init' );

/**
 * Settings main section paragraph.
 */
function sociallinker_settings_section() {
	printf(
		'<p id="sociallinker-settings">%s</p>',
		esc_html__( 'SocialLinker allows to add a sharing link to the bottom of posts and pages on your site. Use the settings below to customize the display of that sharing link.', 'sociallinker' )
	);
}

/**
 * Type setting callback
 *
 * Output the settings field for whether to show the sharing link on posts and/or pages.
 */
function sociallinker_type_callback() {

	$options = sociallinker_get_settings();
	$type    = $options['type'];

	echo '<select name="sociallinker_type">';
	echo '<option ' . selected( 'post', $type, false ) . ' value="post">' . esc_html__( 'Posts', 'shareopesettnly' ) . '</option>';
	echo '<option ' . selected( 'page', $type, false ) . ' value="page">' . esc_html__( 'Pages', 'sociallinker' ) . '</option>';
	echo '<option ' . selected( 'postpage', $type, false ) . ' value="postpage">' . esc_html__( 'Posts & Pages', 'sociallinker' ) . '</option>';
	echo '</select>';
}

/**
 * Share text setting callback
 *
 * Output the settings field for defining the sharing text.
 */
function sociallinker_text_callback() {

	$options = sociallinker_get_settings();
	$text    = $options['text'];

	echo '<input name="sociallinker_text" size="40" type="text" value="' . esc_attr( $text ) . '" />';
}

/**
 * Priority setting callback
 *
 * Output the settings field for defining the priority of the output on the page.
 */
function sociallinker_priority_callback() {

	$options = sociallinker_get_settings();
	$type    = $options['priority'];

	echo '<input name="sociallinker_priority" size="4" maxlength="4" type="text" value="' . esc_attr( $type ) . '" />';
}
