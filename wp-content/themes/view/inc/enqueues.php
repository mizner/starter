<?php // phpcs:disable WordPress.Files.FileName.InvalidClassFileName
/**
 * Enqueues
 */

add_action( 'wp_enqueue_scripts', 'Theme_Enqueues::front_end' );
add_action( 'admin_head', 'Theme_Enqueues::dashboard' );
class Theme_Enqueues {
	/**
	 * Enqueue Examples:
		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/styles/main.css', [], '1.0' );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/dist/scripts/main.js', [ 'jquery' ], '1.0', true );
		wp_localize_script( 'main', 'GLOBAL',
			[
				'ajaxURL' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'security' ),
			]
		);
	*/

	const DIRECTORIES = [
		'dist/vendors',
		'dist/components/organisms',
		'dist/components/templates',
		'dist/components/pages',
		'dist/components',
	];

	public static function dashboard() {
		?>
		<style>
		<?php include get_stylesheet_directory() . '/dist/components/base-dev.css'; ?>
		</style>
		<?php
	}

	public static function front_end() {
		self::register_directory_glob_js( self::DIRECTORIES );
		self::register_directory_glob_css( self::DIRECTORIES );
		wp_enqueue_script( 'base' );

		if ( 'production' === wp_get_environment_type() ) {
			self::register_directory_glob_css();
			wp_enqueue_style( 'base' );
		} else {
			// Use unique file for easy CSS reloads during development
			wp_enqueue_style( 'base-dev', get_stylesheet_directory_uri() . '/dist/components/base-dev.css', [], '1.0' );
		}

		// TODO: Update inline styles
		// add_editor_style( 'dist/styles/tailwind.css' );
		// add_editor_style( 'dist/styles/main.css' );
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
