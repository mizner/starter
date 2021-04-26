<?php
add_action(
	'wp_head',
	function() {
		ob_start();
		?>
		<style>
			<?php include trailingslashit( get_stylesheet_directory() ) . 'static/fonts-base64.css'; ?>
		</style>
		<?php
        // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( ob_get_clean() );
	}
);
