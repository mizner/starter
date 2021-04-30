# Starter WordPress Build

### Project Details
* __Local:__ `boilerplate.test`
* __Development:__ `boilerplate.example.com`
* __Staging:__ `boilerplate-stag.example.com`
* __Production:__ `boilerplate-prod.example.com`

### Intro
Welcome to an opinionated MVC-ish Twig based WordPress build that balances ACF flexible content layouts.

### Requirements
* PHP 7.3+
* Composer
* WP CLI

### Getting started
Helpful info on getting a local development set up.
* Setup `.env` (when necessary)
* Setup `wp-config.php`
* Run `composer install`
    * Will install plugins

### Font Loading Strategy
We're using a Critical FOFT (with data URI) approach for optimum performance

This is the character set used for the base64 data uri `ABCDEFG​HIJKLMNOPQRSTUVWXYZabcdefg​hijklmnopqrstuvwxyz0123456789.!?()-;:`

#### Further Reading
* [CSS Tricks Articles](https://css-tricks.com/the-best-font-loading-strategies-and-how-to-execute-them/#critical-foft-with-data-uris)
* [Transfonter](https://transfonter.org/)

### Working with JavaScript
* Important: each time you add a new js file, you may have to stop and restart gulp
* Each file is built with webpack, but gulp controls each webpack stream.
## Post Types
* Posts
* Pages

## Flexible Content Layouts
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