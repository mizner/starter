<?php
/**
 * The template for displaying the home page
 *
 * @package  View
 */

use Timber\Timber;

$context = Timber::context();

$templates = [
	'pages/home.twig',
];

Timber::render( $templates, $context );
