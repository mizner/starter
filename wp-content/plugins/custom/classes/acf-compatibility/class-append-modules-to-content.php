<?php

namespace Custom\ACF_Compatibility;

use Timber\Timber;

class Append_Modules_To_Content {

	public static function init() {
		$class = new self();
		add_filter( 'the_content', [ $class, 'append_modules' ] );
	}

	public function append_modules( $content ) {
		if ( ! in_array( get_post_type(), [ 'page' ], true ) ) {
			return $content;
		}

		$post_id = get_the_ID();
		$modules = get_field( 'modules', $post_id );

		ob_start();

		if ( ! in_array( get_post_type(), BLOCK_EDITOR_LIMITED_POST_TYPES, true ) ) {
			?>
			<div class="the_content">
				<div class="container">
					<?php echo wp_kses_post( $content ); ?>
				</div>
			</div>
			<?php
		}

		foreach ( $modules as $module ) {
			Timber::render( "organisms/{$module['acf_fc_layout']}.twig", $module );
			/**
			 * We're likely handling enqueues with Timber Functions, but below is an example of
			 * dynamic enqueues if needed
			 * ```php
			 * self::enqueue_module_assets( $module['acf_fc_layout'] );
			 * ```
			 */
		}

		return ob_get_clean();
	}

	private static function enqueue_module_assets( $module_slug ) {
		$script_path = "/dist/scripts/organisms/{$module_slug}.js";
		$style_path  = "/dist/styles/organisms/{$module_slug}.css";
		if ( file_exists( get_stylesheet_directory() . $script_path ) ) {
			wp_enqueue_script( $module_slug, get_stylesheet_directory_uri() . $script_path, [], '1.0', true );
		}
		if ( file_exists( get_stylesheet_directory() . $style_path ) ) {
			wp_enqueue_style( $module_slug, get_stylesheet_directory_uri() . $style_path, [], '1.0' );
		}
	}
}
