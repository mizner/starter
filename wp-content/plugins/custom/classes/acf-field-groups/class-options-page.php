<?php

namespace Custom\ACF_Field_Groups;

class Options_Page {
	public static function init() {
		acf_add_options_page(
			[
				'page_title' => 'General Settings',
				'menu_title' => 'General Settings',
				'menu_slug'  => 'general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false,
			]
		);
	}
}
