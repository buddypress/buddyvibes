<?php
/**
 * Title: Footer template
 * Slug: buddyvibes/template-footer
 * Inserter: no
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40","top":"var:preset|spacing|20"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"backgroundColor":"quaternary","textColor":"background","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background-color has-quaternary-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40)">
		<!-- wp:social-links -->
		<ul class="wp-block-social-links">
			<!-- wp:social-link {"url":"https://github.com/buddypress/","service":"github"} /-->
			<!-- wp:social-link {"url":"https://buddypress.org","service":"wordpress"} /-->
		</ul>
		<!-- /wp:social-links -->
		<!-- wp:paragraph {"align":"right"} -->
		<p class="has-text-align-right">
			<?php
			printf(
				esc_html__( 'Built with %1$s by the %2$s community.', 'buddyvibes' ),
				wp_staticize_emoji( '❤️' ),
				sprintf(
					'<a href="%s">BuddyPress</a>',
					esc_url( 'https://buddypress.org' )
				)
			);
			?>
		</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
