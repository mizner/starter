<?php

namespace Custom\Yoast_Compatibility;

class Metabox_Changes {

	public static function init() {
		$class = new self();
		add_filter( 'wpseo_metabox_prio', [ $class, 'change_position' ] );
			// Custom styles to hide block editor items
		add_action( 'admin_head', [ $class, 'admin_inline_styles' ] );
	}

	public function change_position() {
		return 'low';
	}


	public function admin_inline_styles() {
		ob_start();
		?>
		<style>
			.wpseo-metabox-menu,
			.wpseo-metabox-content,
			.wpseo-meta-section,
			.wpseo-meta-section-react {
				max-width: 100%;
			}
		</style>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ob_get_clean();
	}

}
