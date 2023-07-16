<?php
/**
 * Title: 404
 * Slug: buddyvibes/404
 * Inserter: no
 *
 * @package /buddyvibes/patterns
 *
 * @since 1.0.0
 */
?>
<!-- wp:group {"layout":{"inherit":true}} -->
<div class="wp-block-group">
	<!-- wp:heading {"textAlign":"center","className":"wp-block-post-title","fontSize":"xx-large"} -->
	<h2 class="wp-block-heading has-text-align-center wp-block-post-title has-xx-large-font-size"><?php esc_html_e( '404', 'buddyvibes' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center"><?php echo esc_html_x( 'Ouch! Looks like you reached a dead-end.', 'buddyvibes' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
