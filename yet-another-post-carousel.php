<?php

/**
 * Plugin Name:       Yet Another Post Carousel
 * Plugin URI:        https://parasteh.ir/plugins/post-carousel/
 * Description:       A perfect post carousel based on owl.carousel framework.
 * Version:           1.0.0
 * Requires at least: 5.1
 * Requires PHP:      7.0
 * Author:            Parasteh Digital
 * Author URI:        https://parasteh.ir/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       yet-another-post-carousel
 * Domain Path:       /languages
 */
?>
<?php
require_once plugin_dir_path(__FILE__) . 'class/class-tgm-plugin-activation.php';

require plugin_dir_path(__FILE__) . 'class/carousel-core.php';
require plugin_dir_path(__FILE__) . 'class/carousel-settings.php';

if (class_exists('CarouselSettings')) {
    new CarouselSettings;
    new AddCarousel;
}

if (class_exists('CarouselPostLoop')) {
    new CarouselPostLoop;
}
