# "Outset" - Pyxl's Starter WordPress Build

### Project Details
* __Local:__ `outset.test`
* __Development:__ `outset.example.com`
* __Staging:__ `outsetstag.example.com`
* __Production:__ `outsetprod.example.com`

### Intro
Welcome to a heavily opinionated MVC-ish Twig based WordPress build that balances ACF flexible content layouts while balancing the new WordPress block based editor ("Gutenberg").

### Requirements
* PHP 7.3+
* Composer
* WP CLI

### Getting started
Helpful info on getting a local development set up.
* Rename `.env.example` to `.env`
* Rename `index.php.example` to `index.php`
* Rename `wp-config.php.example` to `wp-config.php`
* __IMPORTANT:__
    * update variables in `.env`
    * Make sure the email you use for the admin account is an `@pyxl.com` address. The core plugin hides many WordPress menus and regions from any user without a `@pyxl.com` address.
* Run `composer run-script setup`
    * Will install plugins

## Post Types
* Posts
* Pages
* Testimonials
* Careers

## Blocks
* Accordion
* Basic
* Blurbs
* Call To Action
* Comparison Cards
* Featurette
* Hero Basic
* Hero Form
* Image Grid
* Posts
* Tabs
* Testimonials

## Actions
### Model Registrations
* `do/post_types`
* `do/taxonomies`
* `do/blocks`
* `do/field_groups`
* `do/option_pages`
### Globals
* `look/global/head`
* `look/global/header`
* `look/global/footer`
### Template Hierarchy
* `look/index`
* `look/archive/post-type/default`
* `look/singular/default`
* `look/single/post`
* `look/four-oh-four`
### Blocks
* uses render callback directly

## Filters
### Globals
* `look/global/head/data`
* `look/global/header/data`
* `look/global/footer/data`
### Template Hierarchy
* `look/index/data`
* `look/archive/post-type/default/data`
* `look/singular/default/data`
* `look/single/post/data`
* `look/four-oh-four/data`
### Blocks
* `look/block/$block-name/data`