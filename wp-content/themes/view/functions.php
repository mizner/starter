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
		$templates [] = trailingslashit( get_stylesheet_directory() ) . 'dist/components';
		$templates [] = trailingslashit( get_stylesheet_directory() ) . 'dist/svgs';
		return $templates;
	}
);

require_once get_stylesheet_directory() . '/inc/enqueues.php';
require_once get_stylesheet_directory() . '/inc/supports.php';
