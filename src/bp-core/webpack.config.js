const path = require( 'path' );

/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

module.exports = {
	...defaultConfig,
	...{
		entry: {
			"item-body/index": './src/bp-core/item-body/item-body.js',
			"item-header/index": './src/bp-core/item-header/item-header.js',
			"item-avatar/index": './src/bp-core/item-avatar/item-avatar.js',
			"loop/index": './src/bp-core/loop/loop.js',
		},
		output: {
			filename: '[name].js',
			path: path.join( __dirname, '..', '..', 'assets', 'blocks' ),
		}
    },
	plugins: [
		...defaultConfig.plugins.filter(
			( plugin ) =>
				plugin.constructor.name !== 'DependencyExtractionWebpackPlugin'
		),
		new DependencyExtractionWebpackPlugin( {
			requestToExternal( request ) {
				if ( request === '@buddypress/block-components' ) {
					return [ 'bp', 'blockComponents' ];
				} else if ( request === '@buddypress/block-data' ) {
					return [ 'bp', 'blockData' ];
				}
			},
			requestToHandle( request ) {
				if ( request === '@buddypress/block-components' ) {
					return 'bp-block-components';
				} else if ( request === '@buddypress/block-data' ) {
					return 'bp-block-data';
				}
			}
		} )
	],
}
