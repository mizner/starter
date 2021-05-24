<?php

namespace Custom\ACF_Filters;

class Filter_Values {
	public static function init() {
		$class = new self();
		// add_filter( 'acf/load_field/name=post_type', [ $class, 'post_type' ] );

	}
	public function post_type( $field ) {
		_log( $field );
		return $field;
	}
}
