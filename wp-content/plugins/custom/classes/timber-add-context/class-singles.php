<?php

namespace Custom\Timber_Add_Context;

use Timber;
use Twig;

class Singles {
	public static function init() {
		$class = new self();
		add_filter( 'timber/context', [ $class, 'add_context' ] );
	}

	public function add_context( $context ) {
		if ( ! is_singular() ) {
			return $context;
		}

		$context['post'] = Timber\Timber::get_post();
		$context['meta'] = get_fields();

		return $context;
	}
}
