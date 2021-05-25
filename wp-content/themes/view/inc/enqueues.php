<?php
/**
 * Enqueues
 */
require 'utils/class-register-directory-enqueues.php';

add_action( 'wp_enqueue_scripts', 'theme_enqueues' );
function theme_enqueues() {
	/**
	 * Examples:
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/styles/main.css', [], '1.0' );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/dist/scripts/main.js', [ 'jquery' ], '1.0', true );
		wp_localize_script( 'main', 'GLOBAL',
			[
				'ajaxURL' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'security' ),
			]
		);
	*/

	Register_Directory_Enqueues::js(
		[
			'dist/vendors',
			'dist/components/organisms',
			'dist/components/templates',
			'dist/components/pages',
			'dist/components',
		]
	);
	// Globally loaded scripts
	wp_enqueue_script( 'base' );

	if ( 'production' === wp_get_environment_type() ) {
		Register_Directory_Enqueues::css(
			[
				'dist/vendors',
				'dist/components/organisms',
				'dist/components/templates',
				'dist/components/pages',
				'dist/components',
			]
		);
		// Globally loaded styles
		wp_enqueue_style( 'base' );
	} else {
		// Globally loaded styles
		wp_enqueue_style( 'base-dev', get_stylesheet_directory_uri() . '/dist/components/base-dev.css', [], '1.0' );
	}

}
