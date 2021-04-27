<?php
class Register_Directory_Enqueues {

	public static function js( $directories = [] ) {
		foreach ( $directories as $directory ) {
			$file_paths = glob( trailingslashit( get_stylesheet_directory() ) . trailingslashit( $directory ) . '*.js' );
			foreach ( $file_paths as $file_path ) {
				wp_register_script( basename( $file_path, '.js' ), get_stylesheet_directory_uri() . str_replace( get_stylesheet_directory(), '', $file_path ), null, '1.0', true );
			}
		}
	}

	public static function css( $directories = [] ) {
		foreach ( $directories as $directory ) {
			$file_paths = glob( trailingslashit( get_stylesheet_directory() ) . trailingslashit( $directory ) . '*.css' );
			foreach ( $file_paths as $file_path ) {
				wp_register_style( basename( $file_path, '.css' ), get_stylesheet_directory_uri() . str_replace( get_stylesheet_directory(), '', $file_path ), [], '1.0' );
			}
		}
	}
}
