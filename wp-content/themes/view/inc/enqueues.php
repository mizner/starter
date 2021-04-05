<?php
/**
 * Enqueues
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueues' );
function theme_enqueues() {
	wp_enqueue_style( 'tailwind', get_stylesheet_directory_uri() . '/dist/styles/tailwind.css', [], '1.0' );

	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/styles/main.css', [], '1.0' );
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/dist/scripts/main.js', [ 'jquery' ], '1.0', true );
	wp_localize_script(
		'main',
		'GLOBAL',
		[
			'ajaxURL' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'security' ),
		]
	);

	wp_register_script( 'active-hover', get_stylesheet_directory_uri() . '/dist/scripts/activeHover.js', [], '1.0', true );
	wp_register_script( 'lightbox', get_stylesheet_directory_uri() . '/dist/scripts/lightbox.js', [], '1.0', true );

	wp_register_style( 'hero', get_stylesheet_directory_uri() . '/dist/components/hero.css', [], '1.0' );
	wp_register_style( 'products', get_stylesheet_directory_uri() . '/dist/components/products.css', [], '1.0' );
	wp_register_style( 'slider', get_stylesheet_directory_uri() . '/dist/components/slider.css', [], '1.0' );
	wp_register_style( 'cta', get_stylesheet_directory_uri() . '/dist/components/cta.css', [], '1.0' );
	wp_register_style( 'map', get_stylesheet_directory_uri() . '/dist/components/map.css', [], '1.0' );
	wp_enqueue_style( 'header', get_stylesheet_directory_uri() . '/dist/components/header.css', [], '1.0' );
	wp_enqueue_style( 'footer', get_stylesheet_directory_uri() . '/dist/components/footer.css', [], '1.0' );

	wp_register_script( 'map', get_stylesheet_directory_uri() . '/dist/scripts/map.js', [], '1.0', true );

	wp_register_style( 'flickity', get_stylesheet_directory_uri() . '/dist/vendors/flickity.min.css', [], '1.0' );
	wp_register_style( 'flickity-fade', get_stylesheet_directory_uri() . '/dist/vendors/flickity-fade.css', [], '1.0' );
	wp_register_script( 'flickity', get_stylesheet_directory_uri() . '/dist/vendors/flickity.pkgd.min.js', [], '1.0', true );
	wp_register_script( 'flickity-fade', get_stylesheet_directory_uri() . '/dist/vendors/flickity-fade.js', [], '1.0', true );

	// wp_register_script( 'pristinejs', get_stylesheet_directory_uri() . '/dist/vendors/pristine.min.js', [], '1.0', true );
}
