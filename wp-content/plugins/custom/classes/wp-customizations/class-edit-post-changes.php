<?php

namespace Custom\WP_Customizations;

class Edit_Post_Changes {

	public static function init() {
		$class = new self();
		add_action( 'admin_head', [ $class, 'admin_inline_styles' ] );
	}

	public function admin_inline_styles() {
		ob_start();
		?>
		<style>
			.edit-post-layout .interface-interface-skeleton__content {
				background-color: white;
			}
			.edit-post-layout__metaboxes {
				max-width: 840px;
				margin-bottom: 50px;
				margin-left: auto;
				margin-right: auto;
				width: 100%;
				border: 1px solid #dddddd;
			}
		</style>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ob_get_clean();
	}

}
