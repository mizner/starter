<?php

namespace Custom\ACF_Compatibility;

class Block_Editor_Customizations {

	public static function init() {
		$class = new self();
		add_action(
			'current_screen',
			function( $current_screen ) use ( $class ) {
				add_action( 'admin_head', [ $class, 'add_block_preview_overlay' ] );
				add_action( 'admin_footer', [ $class, 'add_block_preview_classes' ] );

				// Ensure we're on the single post edit screen
				if ( 'post' !== $current_screen->base ) {
					return;
				}

				// Ensure we're only modifying post types we mean to
				if ( ! in_array( $current_screen->post_type, BLOCK_EDITOR_LIMITED_POST_TYPES, true ) ) {
					return;
				}

				add_action( 'admin_head', [ $class, 'admin_inline_styles' ] );
				add_action( 'admin_head', [ $class, 'disable_editor_fullscreen_by_default' ] );
			}
		);
	}

	/**
	 *  Custom styles to hide block editor items
	 */
	public function disable_editor_fullscreen_by_default() {
		ob_start();
		?>
		<script>
		window.onload = function() {
			var isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' );
			if ( isFullscreenMode ) {
				wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
			}
		}
		</script>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ob_get_clean();
	}

	/**
	 * Add Helper classes for wp-block and acf-block-previews
	 */
	public function add_block_preview_classes() {
		ob_start();
		?>
		<script>
		window.addEventListener( 'load', function( event ) {
			var blocks = document.querySelectorAll('.block-editor-writing-flow .wp-block')
			for (i = 0; i < blocks.length; i++) {
				var block = blocks[i]
				var acfBlockPreview = block.querySelector('.acf-block-preview')
				console.log(block, acfBlockPreview)
				if (acfBlockPreview) {
					acfBlockPreview.classList.add('block-previews')
				}
				else {
					block.classList.add('block-previews')
				}
			}
		})
		</script>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ob_get_clean();
	}

	/**
	 * Add some hacky CSS to prevent users from accidentally interacting with component
	 */
	public function add_block_preview_overlay() {
		ob_start();
		?>
		<style>
			.acf-block-preview {
				position: relative;
			}

			.acf-block-preview::after {
				content: "";
				position: absolute;
				top: 0;
				bottom: 0;
				right: 0;
				left: 0;
				z-index: 100;
			}
		</style>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo ob_get_clean();
	}


	/**
	 * Disable fullscreen mode
	 */
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
