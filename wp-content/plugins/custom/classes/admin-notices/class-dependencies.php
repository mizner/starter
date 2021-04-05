<?php

namespace Custom\Admin_Notices;

use Custom\Utils;
use Timber\Timber;
use ACF;

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

		Utils\Render::notice(
			'Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a>',
			'notice notice-error is-dismissible'
		);
	}

	public function acf_not_installed() {
		if ( class_exists( ACF::class ) ) {
			return;
		}

		Utils\Render::notice(
			'ACF not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#acf' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a>',
			'notice notice-error is-dismissible'
		);
	}

}
