<?php

namespace Custom\Utils;

class Render {
	public static function notice( $message, $classes = 'notice is-dismissible' ) {
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $classes ), wp_kses_post( $message ) );
	}
}
