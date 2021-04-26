<?php
/**
 * View theme specific functions
 *
 * @package  View
 */
use Timber\Timber;

if ( ! class_exists( Timber::class ) ) {
	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

add_filter(
	'custom/view/directories',
	function( $templates ) {
		return [
			trailingslashit( get_stylesheet_directory() ) . 'dist/components',
			trailingslashit( get_stylesheet_directory() ) . 'dist/svgs',
		];
	}
);

require_once get_stylesheet_directory() . '/inc/enqueues.php';
require_once get_stylesheet_directory() . '/inc/supports.php';
require_once get_stylesheet_directory() . '/inc/critical-foft-data-uri.php';
