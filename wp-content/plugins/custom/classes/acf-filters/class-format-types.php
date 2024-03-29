<?php

namespace Custom\ACF_Filters;

use Timber;

class Format_Types {
	public static function init() {
		$class = new self();
		add_filter( 'acf/format_value/type=gallery', [ $class, 'format_acf_gallery' ], 11, 3 );
		add_filter( 'acf/format_value/type=image', [ $class, 'format_acf_images' ], 11, 3 );
	}

	/**
	 * Return Timber Image class and features to all ACF images
	 */
	public function format_acf_images( $value, $post_id, $field ) {
		if ( $value ) {
			return new Timber\Image( $value );
		}

		return $value;
	}

	/**
	 * Return Timber Image class and features to all ACF images
	 */
	public function format_acf_gallery( $value, $post_id, $field ) {
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
}
