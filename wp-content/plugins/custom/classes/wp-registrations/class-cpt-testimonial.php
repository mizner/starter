<?php

namespace Custom\WP_Registrations;

use function array_merge as merge;

class CPT_Testimonial {

	const SLUG = 'testimonial';

	public static function init() {
		$class = new self();
		add_action( 'init', [ $class, 'register' ], 10 );
		add_filter( 'document_title_parts', [ $class, 'set_archive_title' ] );
	}

	public function set_archive_title( $array ) {

		if ( is_post_type_archive( [ self::SLUG ] ) ) {
			return merge(
				$array,
				[
					'title' => __( 'Testimonials', 'custom' ),
				]
			);
		}

		return $array;
	}

	public function register() {
		$labels = [
			'name'                     => __( 'Testimonials', 'custom' ),
			'singular_name'            => __( 'Testimonial', 'custom' ),
			'menu_name'                => __( 'Testimonial', 'custom' ),
			'all_items'                => __( 'All Testimonials', 'custom' ),
			'add_new'                  => __( 'Add New Testimonial', 'custom' ),
			'add_new_item'             => __( 'Add New Testimonial', 'custom' ),
			'edit_item'                => __( 'Edit Testimonial', 'custom' ),
			'new_item'                 => __( 'New Testimonial', 'custom' ),
			'view_item'                => __( 'View Testimonial', 'custom' ),
			'view_items'               => __( 'View Testimonial', 'custom' ),
			'search_items'             => __( 'Search Testimonial', 'custom' ),
			'not_found'                => __( 'No Testimonial found', 'custom' ),
			'not_found_in_trash'       => __( 'No Testimonial found in trash', 'custom' ),
			'parent'                   => __( 'Parent Testimonial:', 'custom' ),
			'featured_image'           => __( 'Featured image for this Testimonial', 'custom' ),
			'set_featured_image'       => __( 'Set featured image for this Testimonial', 'custom' ),
			'remove_featured_image'    => __( 'Remove featured image for this Testimonial', 'custom' ),
			'use_featured_image'       => __( 'Use as featured image for this Testimonial', 'custom' ),
			'archives'                 => __( 'Testimonial Archives', 'custom' ),
			'insert_into_item'         => __( 'Insert into Testimonial', 'custom' ),
			'uploaded_to_this_item'    => __( 'Upload to this Testimonial', 'custom' ),
			'filter_items_list'        => __( 'Filter Testimonial list', 'custom' ),
			'items_list_navigation'    => __( 'Testimonial list navigation', 'custom' ),
			'items_list'               => __( 'Testimonial list', 'custom' ),
			'attributes'               => __( 'Testimonial attributes', 'custom' ),
			'name_admin_bar'           => __( 'Testimonial', 'custom' ),
			'item_published'           => __( 'Testimonial published', 'custom' ),
			'item_published_privately' => __( 'Testimonial published privately.', 'custom' ),
			'item_reverted_to_draft'   => __( 'Testimonial reverted to draft.', 'custom' ),
			'item_scheduled'           => __( 'Testimonial scheduled', 'custom' ),
			'item_updated'             => __( 'Testimonial updated.', 'custom' ),
			'parent_item_colon'        => __( 'Parent Testimonial:', 'custom' ),
		];

		$args = [
			'label'                 => __( 'Testimonial', 'custom' ),
			'labels'                => $labels,
			'menu_icon'             => 'dashicons-admin-users',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'has_archive'           => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'delete_with_user'      => false,
			'exclude_from_search'   => false,
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'hierarchical'          => false,
			'rewrite'               => [
				'slug'       => 'testimonial',
				'with_front' => true,
			],
			'menu_position'         => 15,
			'supports'              => [
				'title',
				'editor',
				'thumbnail',
			],
		];

		register_post_type( self::SLUG, $args );
	}
}
