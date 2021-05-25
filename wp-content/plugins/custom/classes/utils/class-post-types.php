<?php

namespace Custom\Utils;

use function Functional\map;

class Post_Types {
	public static function get_list_by_slugs_for_acf( $post_type_slugs = [] ) {
		$post_type_choices = [];
		foreach ( $post_type_slugs as $slug ) {
			$post_type_object           = get_post_type_object( $slug );
			$post_type_choices[ $slug ] = $post_type_object->label;
		}
		return $post_type_choices;
	}
}
