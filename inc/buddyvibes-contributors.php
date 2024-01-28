<?php
/**
 * BuddyVibes Contributors functions.
 *
 * @package \buddyvibes\inc
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the content for WordPress pages of the starter content.
 *
 * @since 1.0.0
 *
 * @return array The content for WordPress pages of the starter content.
 */
function buddyvibes_contributors_get_starter_content() {
	return array(
		'landing'   =>
			'<!-- wp:paragraph -->
			<p>Hello <strong>BuddyVibes</strong>!</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Thanks a lot for contributing to the <strong>BP Block Theme</strong> that will help shaping the BuddyPress Blocks, Patterns, Templates and Parts that will be used to add the needed code in BuddyPress core so that users will be able to <strong>customize their site’s community area from the WordPress Site Editor</strong>.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Here are some useful links to help you get started:</p>
			<!-- /wp:paragraph -->

			<!-- wp:list -->
			<ul><!-- wp:list-item -->
			<li>The <a href="https://github.com/buddypress/buddyvibes" target="_blank" rel="noreferrer noopener">BuddyVibes GitHub repository</a>,</li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li>The <a href="https://bpdevel.wordpress.com/" target="_blank" rel="noreferrer noopener">BP Development blog</a>,</li>
			<!-- /wp:list-item -->

			<!-- wp:list-item -->
			<li>The <a href="https://wordpress.slack.com/messages/buddypress">#buddypress</a> Slack’s channel</li>
			<!-- /wp:list-item --></ul>
			<!-- /wp:list -->',
		'community' =>
			'<!-- wp:paragraph -->
			<p>Let’s build the Site’s navigation so that the menu link to this page has a submenu containing BuddyPress directories.</p>
			<!-- /wp:paragraph -->',
	);
}
