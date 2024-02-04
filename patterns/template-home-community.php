<?php
/**
 * Title: Community home template
 * Slug: buddyvibes/template-home-community
 * Template Types: front-page, home
 * Inserter: no
 */
?>

<!-- wp:group {"align":"full"} -->
<div class="wp-block-group alignfull">
	<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/balloons.webp","dimRatio":0,"overlayColor":"foreground","isUserOverlayColor":true,"focalPoint":{"x":0.55,"y":0.24},"align":"full","style":{"spacing":{"padding":{"bottom":"0"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-cover alignfull" style="padding-bottom:0">
		<span aria-hidden="true" class="wp-block-cover__background has-foreground-background-color has-background-dim-0 has-background-dim"></span>
		<img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/balloons.webp" style="object-position:55% 24%" data-object-fit="cover" data-object-position="55% 24%"/>
		<div class="wp-block-cover__inner-container">
			<!-- wp:spacer -->
			<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			<!-- wp:heading {"textAlign":"left","level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontSize":"x-large"} -->
			<h1 class="wp-block-heading has-text-align-left has-background-color has-text-color has-link-color has-x-large-font-size">Welcome to BuddyVibes</h1>
			<!-- /wp:heading -->
			<!-- wp:site-tagline /-->
			<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}},"border":{"radius":{"topLeft":"10px","topRight":"10px"}}},"backgroundColor":"background","textColor":"foreground","layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-foreground-color has-background-background-color has-text-color has-background" style="border-top-left-radius:10px;border-top-right-radius:10px;padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:post-content {"layout":{"inherit":true}} /-->
				<!-- wp:spacer {"height":"20px"} -->
				<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
			</div>
			<!-- /wp:group -->
		</div>
	</div>
	<!-- /wp:cover -->
</div>
<!-- /wp:group -->
