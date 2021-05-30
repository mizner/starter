<?php // phpcs:disable WordPress.Files.FileName.InvalidClassFileName
/**
 * Enqueues
 */

add_action( 'wp_enqueue_scripts', 'Theme_Enqueues::front_end' );
add_action( 'admin_head', 'Theme_Enqueues::dashboard' );
add_action( 'admin_enqueue_scripts', 'Theme_Enqueues::dashboard' );
class Theme_Enqueues {
	/**
	 * Enqueue Examples:
	 * wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/styles/main.css', [], '1.0' );
	 * wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/dist/scripts/main.js', [ 'jquery' ], '1.0', true );
	 * wp_localize_script( 'main', 'GLOBAL', [ 'ajaxURL' => admin_url( 'admin-ajax.php' ), 'nonce'   => wp_create_nonce( 'security' ), ]);
	*/

	const DIRECTORIES = [
		'dist/vendors',
		'dist/components/organisms',
		'dist/components/templates',
		'dist/components/pages',
		'dist/components',
	];

	public static function dashboard() {
		// Enqueue special class prefixed file for better CSS scoped previews
		wp_enqueue_style( 'block-previews', get_stylesheet_directory_uri() . '/dist/styles/block-previews.css', [], '1.0' );
	}

	public static function front_end() {
		// Register all matching assets for enqueues
		// Note: does not load these assets, it's only for registration
		self::register_directory_glob_js( self::DIRECTORIES );
		self::register_directory_glob_css( self::DIRECTORIES );

		if ( 'production' === wp_get_environment_type() ) {
			// Enqueue limited base styles
			wp_enqueue_style( 'base' );
		} else {
			// Use unique file for easy CSS reloads during development
			wp_enqueue_style( 'base-dev', get_stylesheet_directory_uri() . '/dist/components/base-dev.css', [], '1.0' );
		}
	}

	public static function register_directory_glob_js( $directories = [] ) {
		foreach ( $directories as $directory ) {
			$file_paths = glob( trailingslashit( get_stylesheet_directory() ) . trailingslashit( $directory ) . '*.js' );
			foreach ( $file_paths as $file_path ) {
				wp_register_script( basename( $file_path, '.js' ), get_stylesheet_directory_uri() . str_replace( get_stylesheet_directory(), '', $file_path ), null, '1.0', true );
			}
		}
	}

	public static function register_directory_glob_css( $directories = [] ) {
		foreach ( $directories as $directory ) {
			$file_paths = glob( trailingslashit( get_stylesheet_directory() ) . trailingslashit( $directory ) . '*.css' );
			foreach ( $file_paths as $file_path ) {
				wp_register_style( basename( $file_path, '.css' ), get_stylesheet_directory_uri() . str_replace( get_stylesheet_directory(), '', $file_path ), [], '1.0' );
			}
		}
	}
}
