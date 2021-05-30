<?php
namespace Custom\ACF_Blocks;

use Timber\Timber;

class Hero {
	public static function init() {
		$class = new self();
		acf_register_block_type(
			[
				'name'            => 'hero',
				'title'           => __( 'Hero' ),
				'align'           => 'full',
				'description'     => __( 'A custom hero block.' ),
				'render_callback' => [ $class, 'handle_render' ],
				'category'        => 'formatting',
				'supports'        => [
					'align' => [ 'full' ],
				],
				'enqueue_assets'  => [ $class, 'handle_enqueues' ],
			]
		);
	}


	public function handle_render( $block, $content = '', $is_preview = false, $post_id = 0 ) {
		Timber::render( 'organisms/hero.twig', (array) get_fields() );
	}
	public function handle_enqueues() {
		// wp_enqueue_style( 'block-hero', get_stylesheet_directory_uri() . '/dist/components/hero.css', [], '1.0' );
		// wp_enqueue_script( 'block-hero', get_stylesheet_directory_uri() . '/dist/components/hero.js', [ 'jquery' ], '1.0', true );
	}
}
