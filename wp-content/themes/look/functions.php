<?php
/**
 * Look
 * https://github.com/mizner/outset
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = [ 'dist/components', 'dist/svgs' ];

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * Enqueues
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueues' );
function theme_enqueues() {
	$global = [
		'ajaxURL' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'security' ),
		'notices' => [
			'contactSupport' => __( 'please contact customer support', 'look' ),
			'noProductID'    => __( 'Sorry, we cannot add that to the cart - no product ID was found' ),
		],
		'wc'      => [
			'cartURL' => wc_get_cart_url(),
		],
	];

	wp_enqueue_style( 'tailwind', get_stylesheet_directory_uri() . '/dist/styles/tailwind.css', [], '1.0' );

	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/styles/main.css', [], '1.0' );
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/dist/scripts/main.js', [ 'jquery' ], '1.0', true );
	wp_localize_script( 'main', 'GLOBAL', $global );

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

	wp_register_script( 'newsletter', get_stylesheet_directory_uri() . '/dist/scripts/newsletter.js', [], '1.0', true );
	wp_localize_script( 'newsletter', 'GLOBAL', $global );
	$coupon = class_exists( 'WC_Coupon' ) ? new WC_Coupon( '2FN33HRP' ) : (object) [];
	wp_localize_script(
		'newsletter',
		'NEWSLETTER',
		[
			'coupon' => [
				'code'   => $coupon->get_code(),
				'amount' => number_format( $coupon->get_amount(), 2 ),
			],
		]
	);

	wp_register_style( 'flickity', get_stylesheet_directory_uri() . '/dist/vendors/flickity.min.css', [], '1.0' );
	wp_register_style( 'flickity-fade', get_stylesheet_directory_uri() . '/dist/vendors/flickity-fade.css', [], '1.0' );
	wp_register_script( 'flickity', get_stylesheet_directory_uri() . '/dist/vendors/flickity.pkgd.min.js', [], '1.0', true );
	wp_register_script( 'flickity-fade', get_stylesheet_directory_uri() . '/dist/vendors/flickity-fade.js', [], '1.0', true );

	wp_register_script( 'pristinejs', get_stylesheet_directory_uri() . '/dist/vendors/pristine.min.js', [], '1.0', true );

	wp_register_script( 'add-to-cart', get_stylesheet_directory_uri() . '/dist/scripts/addToCart.js', [], '1.0', true );
	wp_localize_script( 'add-to-cart', 'GLOBAL', $global );

}

/**
 * Enqueues: Remove WooCommerce assets from non-WooCommerce views
 */
add_action( 'template_redirect', 'remove_woocommerce_styles_scripts', 999 );
function remove_woocommerce_styles_scripts() {
	if ( function_exists( 'is_woocommerce' ) ) {
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			remove_action( 'wp_enqueue_scripts', [ WC_Frontend_Scripts::class, 'load_scripts' ] );
			remove_action( 'wp_print_scripts', [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );
			remove_action( 'wp_print_footer_scripts', [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );
		}
	}
}

/**
 * Various theme supports
 *
 * @return void
 */
add_action( 'after_setup_theme', 'theme_supports' );
function theme_supports() {
			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				[
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				]
			);

			add_theme_support( 'woocommerce' );

			/*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
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

			add_theme_support( 'menus' );

			register_nav_menus(
				[
					'header_primary'   => __( 'Header Primary', 'look' ),
					'footer_primary'   => __( 'Footer Primary', 'look' ),
					'footer_secondary' => __( 'Footer Secondary', 'look' ),
				]
			);

			/**
			 * Add twig extension to theme editor
			 */
			add_filter(
				'wp_theme_editor_filetypes',
				function( $editable_extensions ) {
					$editable_extensions[] = 'twig';
					return $editable_extensions;
				},
				'look'
			);

}

/**
 * Add to context
 *
 * @param [type] $context
 * @return object
 */
add_filter( 'timber/context', 'add_to_context' );
function add_to_context( $context ) {
	$context['menus'] = [
		'header_primary'   => new Timber\Menu( 'header_primary' ),
		'footer_primary'   => new Timber\Menu( 'footer_primary' ),
		'footer_secondary' => new Timber\Menu( 'footer_secondary' ),
	];

	$context['address'] = [
		'name'        => __( 'Vigor Health inc.', 'look' ),
		'address_one' => __( '1190 Mission St', 'look' ),
		'address_two' => __( '1190 Mission St', 'look' ),
		'city'        => __( 'San Francisco', 'look' ),
		'state'       => __( 'CA', 'look' ),
		'zip'         => __( '94103', 'look' ),
		'country'     => __( 'USA', 'look' ),
	];

	return $context;
}

/**
 * Custom Twig functionality.
 *
 * @param \Twig\Environment $twig
 * @return \Twig\Environment
 */
add_filter( 'timber/twig', 'add_to_twig' );
function add_to_twig( $twig ) {
	$twig->addFunction( new Timber\Twig_Function( 'add_script', 'wp_enqueue_script' ) );
	$twig->addFunction( new Timber\Twig_Function( '_log', '_log' ) );
	$twig->addFunction( new Timber\Twig_Function( 'add_style', 'wp_enqueue_style' ) );
	$twig->addFunction( new Timber\Twig_Function( 'is_front_page', 'is_front_page' ) );

	$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
	return $twig;
};

/**
 * Add subscriber
 */
add_action( 'wp_ajax_add_subscriber', 'add_subscriber' );
add_action( 'wp_ajax_nopriv_add_subscriber', 'add_subscriber' );
function add_subscriber() {
	check_ajax_referer( 'security', 'security' );
	// Insert the post into the database.
	$post_id = wp_insert_post(
		[
			'post_title'  => sanitize_text_field( $_POST['email'] ),
			'post_status' => 'publish',
			'post_type'   => 'subscribers',
			'post_author' => 1,
		]
	);

	if ( function_exists( 'update_field' ) ) {
		update_field( 'email', sanitize_text_field( $_POST['email'] ), $post_id );
	}

	if ( is_wp_error( $post_id ) ) {
		$errors = $post_id->get_error_messages();
		wp_send_json_error( $errors );
		wp_die();
	}

	wp_send_json_success();
	wp_die();
}

/**
 * Add to cart via user click on custom module
 */
add_action( 'wp_ajax_custom_add_to_cart', 'custom_add_to_cart' );
add_action( 'wp_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart' );
function custom_add_to_cart() {
	check_ajax_referer( 'security', 'security' );
	WC()->cart->add_to_cart( sanitize_text_field( $_POST['productID'] ) );
	wp_send_json_success(
		[
			'goToCartText' => __( 'PRODUCT ADDED', 'look' ),
			'productTitle' => get_the_title( sanitize_text_field( $_POST['productID'] ) ),
		]
	);
	wp_die();
}

/**
 * Add to cart via user click on custom module
 */
add_action( 'wp_ajax_check_cart_qty', 'check_cart_qty' );
add_action( 'wp_ajax_nopriv_check_cart_qty', 'check_cart_qty' );
function check_cart_qty() {
	check_ajax_referer( 'security', 'security' );
	wp_send_json_success(
		[
			'cartQty' => WC()->cart->get_cart_contents_count(),
		]
	);
	wp_die();
}

/**
 * Return Timber Image class and features to all ACF images
 */
add_filter( 'acf/format_value/type=image', 'format_acf_images', 11, 3 );
function format_acf_images( $value, $post_id, $field ) {
	return new Timber\Image( $value );
}


/**
 * Return Timber Image class and features to all ACF images
 */
add_filter( 'acf/format_value/type=gallery', 'format_acf_gallery', 11, 3 );
function format_acf_gallery( $value, $post_id, $field ) {
	$gallery = [];
	foreach ( $value as $gallery_item ) {

		$image = new Timber\Image( $gallery_item );

		$gallery[] = [
			'srcset'  => $image->srcset(),
			'preview' => $image->src( 'thumbnail' ),
			'src'     => $image->src(),
			'alt'     => $image->alt(),
		];
	}

	return $gallery;
}
