<?php

namespace Custom\ACF_Config;

class Admin_Permissions {
	public static function init() {
		$class = new self();
		add_filter( 'acf/settings/show_admin', [ $class, 'conditions' ] );

	}

	public function conditions() {
		switch ( wp_get_environment_type() ) {
			case 'local':
				return true;
			case 'development':
				return true;
			case 'staging':
				return false;
			case 'production':
			default:
				return false;
		}
	}
}
