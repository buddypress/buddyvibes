<?php
/**
 * Title: Content header template
 * Slug: buddyvibes/template-blog-header
 * Inserter: no
 */

$menu_items = array();
$posts_page = (int) get_option( 'page_for_posts' );

if ( $posts_page ) {
	$menu_items[] = array(
		'id'    => $posts_page,
		'title' => __( 'All news', 'buddyvibes' ),
		'url'   => get_post_type_archive_link( 'post' ),
		'kind'  => 'post-type',
	);
}

$categories = get_categories(
	array(
		'hide_empty'          => 1,
		'hierarchical'        => true,
		'order'               => 'ASC',
		'orderby'             => 'name',
		'show_count'          => 0,
	)
);

if ( $categories && count( $categories ) ) {
	foreach ( $categories as $category ) {
		$menu_items[ $category->slug ] = array(
			'id'    => $category->term_id,
			'title' => $category->name,
			'url'   => get_term_link( $category->term_id ),
			'kind'  => 'term_id',
		);
	}
}
?>

<?php if ( ! $menu_items ) : ?>
	<!-- wp:spacer {"height":"30px"} -->
	<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
<?php else: ?>
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);padding-top:var(--wp--preset--spacing--30);">
		<!-- wp:navigation {"overlayMenu":"never","className":"buddyvibes-content-header__navigation","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"left"}} -->
			<?php
			/*
			* Loop though menu items and create navigation item blocks.
			*/
			foreach ( $menu_items as $menu_item ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				printf(
					'<!-- wp:navigation-link {"label":"%1$s","url":"%2$s","kind":"%3$s","id":"%4$s"} /-->',
					esc_html( $menu_item['title'] ),
					esc_url( $menu_item['url'] ),
					sanitize_key( $menu_item['kind'] ),
					(int) $menu_item['id']
				);
			}
			?>
		<!-- /wp:navigation -->
	</div>
	<!-- /wp:group -->
<?php endif; ?>
