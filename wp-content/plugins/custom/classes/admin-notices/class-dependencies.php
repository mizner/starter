<?php

namespace Custom\Admin_Notices;

use Custom\Utils;
use Timber\Timber;
use ACF;

class Dependencies {
	public static function are_installed() {
		$class = new self();
		if ( ! class_exists( Timber::class ) ) {
			add_action( 'admin_notices', [ $class, 'timber_not_installed' ], 10 );
			return false;
		}
		if ( ! class_exists( ACF::class ) ) {
			add_action( 'admin_notices', [ $class, 'acf_not_installed' ], 11 );
			return false;
		}
		return true;
	}

	public function timber_not_installed() {
		Utils\Render::notice(
			'Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a>',
			'notice notice-error is-dismissible'
		);
	}

	public function acf_not_installed() {
		Utils\Render::notice(
			'ACF not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#acf' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a>',
			'notice notice-error is-dismissible'
		);
	}

}
