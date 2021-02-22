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
define( 'PATH', plugin_dir_path( __FILE__ ) );
define( 'URI', plugin_dir_url( __FILE__ ) );

// Loads composer packages.
require_once PATH . 'vendor/autoload.php';

// Loads custom classes based on WordPress Coding Standards and our namespace.
require_once PATH . 'lib/class-wpcs-autoloader.php';

// Action Hook for this plugin to load after all other plugins have been loaded.
add_action( 'plugins_loaded', __NAMESPACE__ . '\run' );
function run() {
	Admin_Notices\Dependencies::init();
	Field_Groups\Options_Page::init();
};
