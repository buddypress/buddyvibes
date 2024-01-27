<?php
/**
 * BuddyVibes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package \buddyvibes
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'buddyvibes_setup' ) ) {
	/**
	 * Set-up BuddyVibes theme support.
	 *
	 * @since 1.0.0
	 */
	function buddyvibes_setup() {
		// Add support for BuddyPress.
		add_theme_support( 'buddypress' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Translations.
		load_theme_textdomain( 'buddyvibes', get_theme_file_path( '/languages' ) );
	}
}
add_action( 'after_setup_theme', 'buddyvibes_setup' );

if ( ! function_exists( 'buddyvibes_includes' ) ) {
	/**
	 * Load BuddyPress specific functions.
	 *
	 * @since 1.0.0
	 */
	function buddyvibes_includes() {
		if ( ! function_exists( 'bp_theme_compat_is_block_theme' ) ) {
			return;
		}

		require get_theme_file_path( '/inc/buddypress-blocks.php' );
		require get_theme_file_path( '/inc/buddypress-compat.php' );
	}
}
add_action( 'bp_after_setup_theme', 'buddyvibes_includes' );
