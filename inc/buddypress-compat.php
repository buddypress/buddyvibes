<?php
/**
 * BuddyVibes BP Block renderers.
 *
 * @package \buddyvibes\inc
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Use BP Nouveau BP Email template.
 *
 * @since 1.0.0
 * @todo This should be handled by BuddyPress inside the `bp_core_render_email_template()` function.
 */
function bp_block_theme_set_email_template( $template ) {
	if ( ! $template ) {
		$template = buddypress()->themes_dir . '/bp-nouveau/buddypress/assets/emails/single-bp-email.php';
	}

	return $template;
}
add_filter( 'bp_core_render_email_template', 'bp_block_theme_set_email_template', 10, 2 );

/**
 * Disable the customizer on front-end.
 *
 * @since 1.0.0
 * @todo This should be handled by BuddyPress inside the `bp_customize_register()` function.
 */
function bp_block_theme_unregister_customizer() {
	if ( wp_using_themes() && ! isset( $_GET['bp_customizer'] ) ) {
		remove_action( 'customize_register', 'bp_customize_register', 20 );
	}
}
add_action( 'bp_after_setup_theme', 'bp_block_theme_unregister_customizer', 15 );
