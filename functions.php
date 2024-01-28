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
	 * Load BuddyPress & Contributors specific functions.
	 *
	 * @since 1.0.0
	 */
	function buddyvibes_includes() {
		if ( ! function_exists( 'bp_theme_compat_is_block_theme' ) ) {
			return;
		}

		require get_theme_file_path( '/inc/buddypress-blocks.php' );
		require get_theme_file_path( '/inc/buddypress-compat.php' );

		// Set some initial content for people contributing to BuddyVibes.
		if ( defined( 'BP_SOURCE_SUBDIRECTORY' ) && BP_SOURCE_SUBDIRECTORY === 'src' ) {
			require get_theme_file_path( '/inc/buddyvibes-contributors.php' );

			$contributor_content = buddyvibes_contributors_get_starter_content();

			if ( get_option( 'fresh_site' ) ) {
				add_theme_support(
					'custom-logo',
					array(
						'height'      => 50,
						'width'       => 50,
						'header-text' => array( 'site-title', 'site-description' ),
					)
				);
			}

			add_theme_support(
				'starter-content',
				array(
					// Create landing, post and community pages.
					'posts' => array(
						'landing'   => array(
							'post_title'   => __( 'Home', 'buddyvibes' ),
							'post_type'    => 'page',
							'post_content' => $contributor_content['landing'],
							'post_name'    => 'landing',
						),
						'blog'      => array(
							'post_title' => __( 'Blog', 'buddyvibes' ),
							'post_type'  => 'page',
							'post_name'  => 'blog',
						),
						'community' => array(
							'post_title'   => __( 'Community', 'buddyvibes' ),
							'post_type'    => 'page',
							'post_content' => $contributor_content['community'],
							'post_name'    => 'community',
						),
					),
					// Site logo Attachment.
					'attachments' => array(
						'asset-site-logo' => array(
							'post_title'   => __( 'Site Logo', 'buddyvibes' ),
							'post_content' => __( 'The Site Logo is displayed into the header of the site and helps to come back to the landing page.', 'buddyvibes' ),
							'post_excerpt' => __( 'It’s the BuddyPress logo used on the BuddyPress.org Network.', 'buddyvibes' ),
							'file'         => 'assets/images/site-logo.png',
						),
					),
					// Sets Site name, description & logo.
					'theme_mods'  => array(
						'blogname'        => __( 'BuddyVibes', 'buddyvibes' ),
						'blogdescription' => __( 'The BP Block Theme built by the BuddyPress community.', 'buddyvibes' ),
						'custom_logo'     => '{{asset-site-logo}}',
					),
					// Use a static front page and assign the front and posts pages.
					'options' => array(
						'show_on_front'  => 'page',
						'page_on_front'  => '{{landing}}',
						'page_for_posts' => '{{blog}}',
					),
				)
			);
		}
	}
}
add_action( 'bp_after_setup_theme', 'buddyvibes_includes' );
