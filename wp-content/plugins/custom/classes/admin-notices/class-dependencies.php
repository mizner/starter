<?php

namespace Custom\Admin_Notices;

use Custom\Utils;

class Dependencies {
	public static function init() {
		$class = new self();
		add_action( 'admin_notices', [ $class, 'timber_not_installed' ], 10 );
		add_action( 'admin_notices', [ $class, 'acf_not_installed' ], 11 );
	}

	public function timber_not_installed() {
		if ( class_exists( Timber::class ) ) {
			return;
		}
		Utils\Render::notice( 'Timber is required', 'notice notice-error is-dismissible' );
	}

	public function acf_not_installed() {
		if ( class_exists( 'ACF' ) ) {
			return;
		}
		Utils\Render::notice( 'ACF is required', 'notice notice-error is-dismissible' );
	}

}
