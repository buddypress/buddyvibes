<?php
/**
 * Title: Post footer template
 * Slug: buddyvibes/template-post-footer
 * Inserter: no
 */
?>
<!-- wp:group {"layout":{"type":"flex"}} -->
<div class="wp-block-group">
	<!-- wp:paragraph -->
	<p>
	<?php
	/**
	 * Post comments link/count are only available when Gutenberd is active.
	 *
	 * @todo Find a way to provide an action link to comment a post.
	 */
	esc_html_e( 'This is a placeholder for the comment action', 'buddyvibes' );
	?>
	</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
