<?php

namespace Custom\WP_Registrations;

use function array_merge as merge;

class CPT_Staff {

	const SLUG = 'staff';

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
					'title' => __( 'Our Portfolio', 'custom' ),
				]
			);
		}

		return $array;
	}

	public function register() {
		$labels = [
			'name'                     => __( 'Staff', 'custom' ),
			'singular_name'            => __( 'Staff Member', 'custom' ),
			'menu_name'                => __( 'Staff', 'custom' ),
			'all_items'                => __( 'All Staff', 'custom' ),
			'add_new'                  => __( 'Add new', 'custom' ),
			'add_new_item'             => __( 'Add new Staff Member', 'custom' ),
			'edit_item'                => __( 'Edit Staff Member', 'custom' ),
			'new_item'                 => __( 'New Staff Member', 'custom' ),
			'view_item'                => __( 'View Staff Member', 'custom' ),
			'view_items'               => __( 'View Staff', 'custom' ),
			'search_items'             => __( 'Search Staff', 'custom' ),
			'not_found'                => __( 'No Staff found', 'custom' ),
			'not_found_in_trash'       => __( 'No Staff found in trash', 'custom' ),
			'parent'                   => __( 'Parent Staff Member:', 'custom' ),
			'featured_image'           => __( 'Featured image for this Staff Member', 'custom' ),
			'set_featured_image'       => __( 'Set featured image for this Staff Member', 'custom' ),
			'remove_featured_image'    => __( 'Remove featured image for this Staff Member', 'custom' ),
			'use_featured_image'       => __( 'Use as featured image for this Staff Member', 'custom' ),
			'archives'                 => __( 'Staff Member archives', 'custom' ),
			'insert_into_item'         => __( 'Insert into Staff Member', 'custom' ),
			'uploaded_to_this_item'    => __( 'Upload to this Staff Member', 'custom' ),
			'filter_items_list'        => __( 'Filter Staff list', 'custom' ),
			'items_list_navigation'    => __( 'Staff list navigation', 'custom' ),
			'items_list'               => __( 'Staff list', 'custom' ),
			'attributes'               => __( 'Staff attributes', 'custom' ),
			'name_admin_bar'           => __( 'Staff Member', 'custom' ),
			'item_published'           => __( 'Staff Member published', 'custom' ),
			'item_published_privately' => __( 'Staff Member published privately.', 'custom' ),
			'item_reverted_to_draft'   => __( 'Staff Member reverted to draft.', 'custom' ),
			'item_scheduled'           => __( 'Staff Member scheduled', 'custom' ),
			'item_updated'             => __( 'Staff Member updated.', 'custom' ),
			'parent_item_colon'        => __( 'Parent Staff Member:', 'custom' ),
		];

		$args = [
			'label'                 => __( 'Staff', 'custom' ),
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
				'slug'       => 'staff',
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
