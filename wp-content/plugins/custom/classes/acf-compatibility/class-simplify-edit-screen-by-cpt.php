<?php

namespace Custom\ACF_Compatibility;

class Simplify_Edit_Screen_By_CPT {

	public static function init() {
		$class = new self();
		add_action(
			'current_screen',
			function( $current_screen ) use ( $class ) {
				if ( 'post' !== $current_screen->base ) {
					return;
				}

				if ( ! in_array( $current_screen->post_type, BLOCK_EDITOR_LIMITED_POST_TYPES, true ) ) {
					return;
				}

				// Custom styles to hide block editor items
				add_action( 'admin_head', [ $class, 'admin_inline_styles' ] );
				// Disable fullscreen mode
				add_action( 'enqueue_block_editor_assets', [ $class, 'disable_editor_fullscreen_by_default' ] );
			}
		);
	}

	public function disable_editor_fullscreen_by_default() {
		$script = "window.onload = function() {
			var isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' );
			if ( isFullscreenMode ) {
				wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
			} }
		";
		wp_add_inline_script( 'wp-blocks', $script );
	}

	public function admin_inline_styles() {
		ob_start();
		?>
		<style>
			.edit-post-more-menu {
				display: none;
			}

			.block-editor-block-list__layout  {
				display: none;
			}

			.edit-post-header-toolbar__left {
				display: none;
			}
			.edit-post-visual-editor {
				flex-basis: initial;
				flex: initial;
			}

			.edit-post-layout__metaboxes {
				margin-top: 0px;
			}

			.edit-post-sidebar__panel-tabs {
				display: none;
			}
		</style>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ob_get_clean();
	}
}
