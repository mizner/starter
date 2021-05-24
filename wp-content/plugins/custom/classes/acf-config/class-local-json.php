<?php

namespace Custom\ACF_Config;
use const Custom\PATH;

class Local_Json {
    public static function init() {
		$class = new self();
        add_filter('acf/settings/save_json', [$class, 'save_point']);
        add_filter('acf/settings/load_json', [$class, 'load_point']);
	}

    function save_point($path) {
        return PATH . '/acf-json';
    }

    function load_point($paths) {
        $paths[] = PATH . '/acf-json';
        return $paths;
    }
}