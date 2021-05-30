<?php
/**
 * Various theme supports
 *
 * @return void
 */
add_action( 'after_setup_theme', 'theme_supports' );
function theme_supports() {
	/**
	 * Examples of various other options
	 * add_theme_support( 'woocommerce' );
	 * add_theme_support( 'custom-logo', ['height' => 480, 'width'  => 720,] );
	 * add_theme_support( 'post-formats', ['aside', 'gallery'] );
	 * add_theme_support( 'post-thumbnails', ['post', 'movie'] );
	 * add_theme_support( 'custom-background' );
	 * add_theme_support( 'custom-header' );
	 * add_theme_support( 'custom-logo' );
	 * add_theme_support( 'customize-selective-refresh-widgets' );
	 */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		[
			'gallery',
			'comment-form',
			'comment-list',
			'caption',
			'search-form',
			'script',
			'style',
		]
	);
	add_theme_support(
		'post-formats',
		[
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		]
	);
		/**
	 * Block Editor supports
	 */
	add_theme_support( 'align-wide' );
}
