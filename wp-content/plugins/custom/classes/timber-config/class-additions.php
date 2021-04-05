<?php

namespace Custom\Timber_Config;

use Timber;
use Twig;

class Additions {
	public static function init() {
		$class = new self();
		add_filter( 'timber/twig', [ $class, 'add_to_twig' ] );
	}

	/**
	 * Custom Twig functionality.
	 *
	 * @param \Twig\Environment $twig
	 * @return \Twig\Environment
	 */
	public function add_to_twig( $twig ) {
		$twig->addFunction( new Timber\Twig_Function( 'add_script', 'wp_enqueue_script' ) );
		$twig->addFunction( new Timber\Twig_Function( '_log', '_log' ) );
		$twig->addFunction( new Timber\Twig_Function( 'add_style', 'wp_enqueue_style' ) );
		$twig->addFunction( new Timber\Twig_Function( 'is_front_page', 'is_front_page' ) );

		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		return $twig;
	}
}
