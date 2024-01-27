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
 * Returns the list of BP Theme blocks.
 *
 * It's specific to the fact blocks are registered from this theme.
 *
 * @since 1.0.0
 *
 * @return array The list of BP Theme blocks.
 */
function buddyvibes_get_theme_blocks() {
	/*
	 * This part of the code should be moved into `buddypress/src/bp-core/classes/class-bp-core.php`.
	 *
	 * Target: `BP_Core::blocks_init()`.
	 */
	$blocks_dir = dirname( dirname( __FILE__ ) ) . '/assets/blocks';

	return array(
		'bp/item-header' => array(
			'metadata'        => $blocks_dir . '/item-header',
			'render_callback' => 'bp_block_render_item_header',
		),
		'bp/item-body' => array(
			'metadata'        => $blocks_dir . '/item-body',
			'render_callback' => 'bp_block_render_item_body',
		),
		'bp/item-avatar' => array(
			'metadata'        => $blocks_dir . '/item-avatar',
			'render_callback' => 'bp_block_render_item_avatar',
		),
		'bp/loop' => array(
			'metadata'        => $blocks_dir . '/loop',
			'render_callback' => 'bp_block_render_loop',
		),
	);
}

/**
 * Filters BP Theme Blocks Metadata.
 *
 * It's specific to the fact blocks are registered from this theme.
 *
 * @param array $metada The block metadata.
 * @return array The block metadata.
 */
function buddyvibes_filter_metadata( $metada ) {
	if ( isset( $metada['editorScript'] ) ) {
		unset( $metada['editorScript'] );
	}

	if ( isset( $metada['style'] ) ) {
		unset( $metada['style'] );
	}

	return $metada;
}

/**
 * Registers the BP Theme blocks.
 *
 * It's specific to the fact blocks are registered from this theme.
 *
 * @since 1.0.0
 */
function buddyvibes_register_theme_blocks() {
	$bp_theme_blocks = buddyvibes_get_theme_blocks();

	// Temporarly filter the Blocks metadata.
	add_filter( 'block_type_metadata', 'buddyvibes_filter_metadata' );

	foreach ( $bp_theme_blocks as $block_name => $block_data ) {
		$script_data  = '';
		$metadata     = array();
		$handles      = array();
		$block_folder = '';

		if ( is_dir( $block_data['metadata'] ) && file_exists( $block_data['metadata'] . '/block.json' ) ) {
			$script_data              = require_once $block_data['metadata'] . '/index.asset.php';
			$block_folder             = wp_basename( $block_data['metadata'] );
			$handles['editor_script'] = str_replace( '/', '-', $block_name ) . '-script';

			wp_register_script(
				$handles['editor_script'],
				get_theme_file_uri( '/assets/blocks/' . $block_folder . '/index.js' ),
				$script_data['dependencies'],
				$script_data['version'],
				true
			);

			$metadata = wp_json_file_decode( $block_data['metadata'] . '/block.json', array( 'associative' => true ) );
			if ( isset( $metadata['style'] ) ) {
				$handles['style'] = str_replace( '/', '-', $block_name ) . '-style';

				wp_register_style(
					$handles['style'],
					get_theme_file_uri( '/assets/blocks/' . $block_folder . '/index.css' ),
					array(),
					$script_data['version']
				);
			}

			if ( isset( $block_data['render_callback'] ) ) {
				$handles['render_callback'] = $block_data['render_callback'];
			}

			register_block_type_from_metadata( $block_data['metadata'], $handles );
		}
	}

	// Remove the temporary Blocks metadata filter.
	remove_filter( 'block_type_metadata', 'buddyvibes_filter_metadata' );
}
add_action( 'bp_blocks_init', 'buddyvibes_register_theme_blocks' );

/**
 * Callback function to render the BP Directory or Single item title.
 *
 * This function should be moved in `buddypress/src/bp-core/bp-core-blocks.php`.
 *
 * @since 1.0.0
 *
 * @return string HTML output.
 */
function bp_block_render_item_header() {
	$classnames         = 'buddypress bp-item-header';
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $classnames ) );
	$bp_content         = __( 'This is where the BuddyPress item header will be generated', 'buddyvibes' );

	return sprintf(
		'<div %1$s>%2$s</div>',
		$wrapper_attributes,
		esc_html( $bp_content )
	);
}

/**
 * Callback function to render the BP Directory or Single item body.
 *
 * This function should be moved in `buddypress/src/bp-core/bp-core-blocks.php`.
 *
 * @since 1.0.0
 *
 * @return string HTML output.
 */
function bp_block_render_item_body() {
	$classnames         = 'buddypress bp-item-body';
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $classnames ) );
	$bp_content         = __( 'This is where BuddyPress body will be generated.', 'buddyvibes' );
	$bp_page            = get_queried_object();

	if ( isset( $bp_page->post_content ) && $bp_page->post_content ) {
		$bp_content = $bp_page->post_content;
	}

	return sprintf(
		'<div %1$s>%2$s</div>',
		$wrapper_attributes,
		$bp_content
	);
}

/**
 * Callback function to render a BP item avatar.
 *
 * This function should be moved in `buddypress/src/bp-core/bp-core-blocks.php`.
 *
 * @since 1.0.0
 *
 * @todo Group, Blog avatars, other loop contexts.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string HTML output.
 */
function bp_block_render_item_avatar( $attributes, $content, $block ) {
	$avatar = '';

	if ( ! isset( $block->context['itemId'] ) || ! isset( $block->context['itemType'] ) ) {
		return $avatar;
	}

	$is_link = false;
	if ( isset( $attributes['isLink'] ) ) {
		$is_link = (bool) $attributes['isLink'];
	}

	$avatar_args = array(
		'type' => 'full',
	);

	if ( isset( $attributes['size'] ) ) {
		$size = (int) $attributes['size'];

		if ( 50 >= $size ) {
			$avatar_args['type'] = 'thumb';
		}

		$avatar_args['width']  = $size;
		$avatar_args['height'] = $size;
	}

	if ( 'members' === $block->context['itemType'] ) {
		// Use the BuddyPress loop global if available.
		if ( isset( $GLOBALS['members_template']->member ) ) {
			$avatar = bp_get_member_avatar( $avatar_args );

			if ( $is_link ) {
				$avatar = sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url( bp_get_member_permalink() ),
					$avatar
				);
			}

			// Use Block context.
		} else {
			$avatar_args = array_merge(
				$avatar_args,
				array(
					'item_id' => $block->context['itemId'],
					'object'  => 'user',
					'class'   => 'avatar',
					'alt'     => sprintf(
						/* translators: %s: member name */
						__( 'Profile picture of %s', 'buddyvibes' ),
						esc_html( bp_core_get_user_displayname( $block->context['itemId'] ) )
					),
				)
			);

			/** This filter is documented in bp-members/bp-members-template.php */
			$avatar = apply_filters( 'bp_get_member_avatar', bp_core_fetch_avatar( $avatar_args ) );

			if ( $is_link ) {
				$permalink = bp_members_get_user_url( $block->context['itemId'] );
				$avatar = sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url( $permalink ),
					$avatar
				);
			}
		}
	}

	return $avatar;
}

/**
 * Callback function to render a BP Loop.
 *
 * This function should be moved in `buddypress/src/bp-core/bp-core-blocks.php`.
 *
 * @since 1.0.0
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string HTML output.
 */
function bp_block_render_loop( $attributes, $content, $block ) {
	$loop_content = '';
	$classnames   = 'buddypress bp-loop';

	if ( 'members' === $attributes['object'] ) {
		$classnames .= ' bp-members-list';

		if ( bp_has_members() ) {
			while ( bp_members() ) {
				bp_the_member();

				// Get an instance of the current Post Template block.
				$block_instance              = $block->parsed_block;
				$block_instance['blockName'] = 'bp/null';

				$item_id   = bp_get_member_user_id();
				$item_type = 'members';
				$filter_block_context = static function( $context ) use ( $item_id, $item_type ) {
					$context['itemType'] = $item_type;
					$context['itemId']   = $item_id;
					return $context;
				};

				add_filter( 'render_block_context', $filter_block_context, 1 );
				$block_content = ( new WP_Block( $block_instance ) )->render( array( 'dynamic' => false ) );
				remove_filter( 'render_block_context', $filter_block_context, 1 );

				$loop_content .= '<li>' . $block_content . '</li>';
			}
		}
	}

	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $classnames ) );

	return sprintf(
		'<ul %1$s>%2$s</ul>',
		$wrapper_attributes,
		$loop_content
	);
}

/**
 * Returns the titles and descriptions for supported block templates.
 *
 * This function should be moved in `buddypress/src/bp-core/bp-core-template.php`.
 *
 * @since 1.0.0
 *
 * @return array The titles and descriptions for supported block templates.
 */
function bp_get_default_block_templates() {
	return array(
		'buddypress'                                   => array(
			'title'       => 'BuddyPress',
			'description' => __( 'Used as a fallback template for all BuddyPress pages when a more specific template is not defined.', 'buddypress' ),
		),
		'buddypress/activity/index'                    => array(
			'title'       => 'BuddyPress Activity Directory page',
			'description' => __( 'Used to display the list of public BuddyPress sitewide activities shared by the community.', 'buddypress' ),
		),
		'buddypress/members/single-activity-permalink' => array(
			'title'       => 'BuddyPress Activity single item page',
			'description' => __( 'Used to display a single BuddyPress activity shared by a specific member.', 'buddypress' ),
		),
		'buddypress/blogs/create'                      => array(
			'title'       => 'BuddyPress site creation form',
			'description' => __( 'Used to display the form to create a new site.', 'buddypress' ),
		),
		'buddypress/blogs/index'                       => array(
			'title'       => 'BuddyPress Sites Directory page',
			'description' => __( 'Used to display the list of public sites of a WordPress network.', 'buddypress' ),
		),
		'buddypress/groups/create'                     => array(
			'title'       => 'BuddyPress Groups creation form',
			'description' => __( 'Used to display the form to create a new group.', 'buddypress' ),
		),
		'buddypress/groups/index'                      => array(
			'title'       => 'BuddyPress Groups Directory page',
			'description' => __( 'Used to display the list of public groups of the community site.', 'buddypress' ),
		),
		'buddypress/groups/single-home'                => array(
			'title'       => 'BuddyPress Groups single item Homepage',
			'description' => __( 'Used to display a group’s homepage.', 'buddypress' ),
		),
		'buddypress/members/index'                     => array(
			'title'       => 'BuddyPress Members Directory page',
			'description' => __( 'Used to display the list of members of the community site.', 'buddypress' ),
		),
		'buddypress/members/activate'                  => array(
			'title'       => 'BuddyPress new member’s activation page',
			'description' => __( 'Used to display the form to let a new member input their activation key.', 'buddypress' ),
		),
		'buddypress/members/register'                  => array(
			'title'       => 'BuddyPress registration page',
			'description' => __( 'Used to display the form to let new members register to the site.', 'buddypress' ),
		),
		'buddypress/members/single-home'               => array(
			'title'       => 'BuddyPress Members single item Homepage',
			'description' => __( 'Used to display a member’s personnal homepage.', 'buddypress' ),
		),
		'buddypress/members/single-plugins'            => array(
			'title'       => 'BuddyPress Members single item plugin page',
			'description' => __( 'Used by BuddyPress plugins to output some content specific to a member.', 'buddypress' ),
		),
	);
}

/**
 * Adds a title and a description to BP Block Templates found into the theme by the site editor.
 *
 * This function should be moved in `buddypress/src/bp-core/bp-core-template.php`.
 *
 * @since 1.0.0
 *
 * @param array $query_result Templates found by the site editor.
 * @return array              Templates possibly completed with a title and a description.
 */
function bp_get_block_templates_data( $query_result = array() ) {
	if ( ! bp_theme_compat_is_block_theme() ) {
		return $query_result;
	}

	$bp_block_templates = bp_get_default_block_templates();
	$bp_block_theme     = bp_get_theme_compat_id();

	foreach ( $query_result as $query_item_key => $query_item ) {
		$bp_block_template_id = str_replace( $bp_block_theme . '//', '', $query_item->id );

		if ( isset( $bp_block_templates[ $bp_block_template_id ] ) ) {
			$query_result[ $query_item_key ]->description = esc_html( $bp_block_templates[ $bp_block_template_id ]['description'] );
			$query_result[ $query_item_key ]->title       = esc_html( $bp_block_templates[ $bp_block_template_id ]['title'] );
		}
	}

	return $query_result;
}
add_filter( 'get_block_templates', 'bp_get_block_templates_data', 10, 1 );