<?php

namespace Custom\Timber_Config;

use Timber\Timber;
use const Custom\PATH;
use function array_merge as merge;

class Setup {
	public static function init() {
		$class = new self();
		add_action( 'after_setup_theme', [ $class, 'setup_timber' ] );
	}

	public function setup_timber() {
		/**
		 * Sets the directories (inside your theme) to find .twig files
		 */
		// Timber::$locations = [
		// 	trailingslashit( get_stylesheet_directory() ) . 'dist/components',
		// 	trailingslashit( get_stylesheet_directory() ) . 'dist/svgs',
		// 	PATH . 'components',
		// ];
		Timber::$locations = merge(
			apply_filters( 'custom/view/directories', [] ),
			[
				PATH . 'components',
			]
		);
		/**
		 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
		 * No prob! Just set this value to true
		 */
		Timber::$autoescape = false;
	}
}
