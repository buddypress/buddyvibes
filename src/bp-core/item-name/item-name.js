/**
 * WordPress dependencies.
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { Placeholder } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import metadata from './block.json';

registerBlockType( metadata, {
	icon: {
		background: '#fff',
		foreground: '#d84800',
		src: 'nametag',
	},
	edit: () => {
		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<Placeholder
					className="block-editor-bp-placeholder bp-name"
					label= { __( 'BuddyPress item name', 'buddypress') }
				/>
			</div>
		);
	},
	save: () => {
		return null;
	},
} );
