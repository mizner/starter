<?php

namespace Custom\ACF_Filters;

use Custom\WP_Registrations\CPT_Staff;
use Custom\Utils;
class Filter_Values {
	public static function init() {
		$class = new self();
		add_filter( 'acf/load_field/name=post_types', [ $class, 'post_types' ] );
	}
	public function post_types( $field ) {
		$field['choices'] = Utils\Post_Types::get_list_by_slugs_for_acf( [ CPT_Staff::SLUG, 'post', 'page' ] );
		return $field;
	}
}
