<?php

namespace Custom\Timber_Add_Context;

use Timber;

class Everywhere {
	public static function init() {
		$class = new self();
		add_filter( 'timber/context', [ $class, 'add_context' ] );
	}

	public function add_context( $context ) {
		$context['menus'] = [
			'header_primary'   => new Timber\Menu( 'header_primary' ),
			'footer_primary'   => new Timber\Menu( 'footer_primary' ),
			'footer_secondary' => new Timber\Menu( 'footer_secondary' ),
		];

		return $context;
	}
}
