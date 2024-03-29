<?php
/**
 * Plugin Name: 🚀 Custom
 * Description: This plugin handles most if not all CMS customizations. Including core actions, core filters, registering ACF field groups, etc.
 * Version: 1.0
 * Author: Michael Mizner
 * Author URI:
 * License: GPLv3+
 */

namespace Custom;

// Security precaution, to prevent plugin from being accessed directly.
defined( 'WPINC' ) || die;

// Constants we'll commonly use in the plugin.
define( __NAMESPACE__ . '\PATH', plugin_dir_path( __FILE__ ) );
define( __NAMESPACE__ . '\URI', plugin_dir_url( __FILE__ ) );
define( 'BLOCK_EDITOR_LIMITED_POST_TYPES', [ 'page' ] );

// Loads composer packages.
require_once PATH . 'vendor/autoload.php';

// Loads custom classes based on WordPress Coding Standards and our namespace.
require_once PATH . 'lib/class-wpcs-autoloader.php';

// Action Hook for this plugin to load after all other plugins have been loaded.
add_action( 'plugins_loaded', __NAMESPACE__ . '\run' );
function run() {
	if ( ! Admin_Notices\Dependencies::are_installed() ) {
		return;
	}
	WP_Config\Allowed_Blocks::init();
	WP_Registrations\Nav_Menus::init();
	WP_Registrations\CPT_Staff::init();
	WP_Registrations\CPT_Testimonial::init();
	WP_Customizations\Edit_Post_Changes::init();
	Timber_Config\Setup::init();
	Timber_Config\Additions::init();
	ACF_Config\Local_Json::init();
	ACF_Config\Admin_Permissions::init();
	ACF_Compatibility\Block_Editor_Customizations::init();
	ACF_Compatibility\Append_Modules_To_Content::init();
	ACF_Field_Groups\Options_Page::init();
	ACF_Filters\Format_Types::init();
	ACF_Filters\Filter_Values::init();
	Timber_Add_Context\Everywhere::init();
	Timber_Add_Context\Singles::init();
	ACF_Blocks\Hero::init();
	Yoast_Compatibility\Metabox_Changes::init();
};
