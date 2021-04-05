<?php

namespace Custom\WP_Registrations;

class Nav_Menus {
	public static function init() {
		$class = new self();
		add_action( 'init', [ $class, 'global_menus' ] );
	}

	public function global_menus() {
		register_nav_menus(
			[
				'header_primary'   => __( 'Header Primary', 'custom' ),
				'footer_primary'   => __( 'Footer Primary', 'custom' ),
				'footer_secondary' => __( 'Footer Secondary', 'custom' ),
			]
		);
	}
}
