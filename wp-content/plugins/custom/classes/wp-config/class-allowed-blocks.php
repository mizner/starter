<?php

namespace Custom\WP_Config;

use WP_Block_Type_Registry;

class Allowed_Blocks {

	public static function init() {
		$class = new self();
		add_filter( 'allowed_block_types', [ $class, 'allowed_block_filter' ], 10, 2 );
	}

	public function allowed_block_filter( $allowed_blocks, $post ) {
		/**
		 * Example of listing all blocks
		 * ```php
		 * $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
		 * foreach ( $registered_blocks as $key => $value ) {
		 *     error_log( $key );
		 * }
		 * ```
		 */

		$allowed_blocks = [
			'acf/hero',
			// 'core/archives',
			// 'core/block',
			// 'core/calendar',
			// 'core/categories',
			// 'core/latest-comments',
			// 'core/latest-posts',
			// 'core/rss',
			// 'core/search',
			// 'core/shortcode',
			// 'core/social-link',
			// 'core/tag-cloud',
			// 'core/audio',
			// 'core/button',
			// 'core/buttons',
			// 'core/code',
			// 'core/column',
			// 'core/columns',
			// 'core/embed',
			// 'core/file',
			// 'core/freeform',
			'core/gallery',
			// 'core/group',
			'core/heading',
			// 'core/html',
			// 'core/image',
			// 'core/list',
			// 'core/media-text',
			// 'core/missing',
			// 'core/more',
			// 'core/nextpage',
			'core/paragraph',
			// 'core/preformatted',
			// 'core/pullquote',
			'core/quote',
			// 'core/separator',
			// 'core/social-links',
			// 'core/spacer',
			// 'core/subhead',
			// 'core/table',
			// 'core/text-columns',
			// 'core/verse',
			// 'core/video',
			// 'yoast-seo/breadcrumbs',
		];

		if ( 'page' === $post->post_type ) {
			$allowed_blocks[] = 'core/shortcode';
		}

		return $allowed_blocks;
	}
}
