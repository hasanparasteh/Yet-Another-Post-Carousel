<?php
namespace Carousel;

class CarouselSettings
{
    public function __construct()
    {
        add_action('tgmpa_register', array($this, 'yet_another_post_carousel_register_required_plugins'));
        add_action('wp_enqueue_scripts', array($this, 'load_owl_carousel'));
        add_action('admin_menu', array($this, 'add_menu_to_dashboard'));
    }

    public function yet_another_post_carousel_register_required_plugins()
    {
        $plugins = array(
            array(
                'name' => 'Font Awesome',
                'slug' => 'font-awesome',
                'required' => true,
            ),
        );

        $config = array(
            'id' => 'yet-another-post-carousel',
            'default_path' => '',
            'menu' => 'tgmpa-install-plugins',
            'parent_slug' => 'plugins.php',
            'capability' => 'manage_options',
            'has_notices' => true, 
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => false,
            'message' => '',
        );

        tgmpa($plugins, $config);
    }

    public function load_owl_carousel()
    {
        wp_enqueue_script(
            'owl.carouselJS',
            plugin_dir_url(__FILE__) . '../assets/js/owl.carousel.js',
            $deps = array('jquery'),
            $ver = "2.3.4",
            $in_footer = true
        );
        wp_enqueue_script(
            'post.carousel',
            plugin_dir_url(__FILE__) . '../assets/js/post-carousel.js',
            $deps = array('owl.carouselJS', 'jquery'),
            $ver = "1.0",
            $in_footer = true
        );

        wp_enqueue_style(
            'owl.carouselStyle',
            plugin_dir_url(__FILE__) . '../assets/css/owl.carousel.css',
            $deps = null,
            $ver = "2.3.4",
            $media = "all"
        );
        wp_enqueue_style(
            'owl.carouselTheme',
            plugin_dir_url(__FILE__) . '../assets/css/owl.theme.default.css',
            $deps = null,
            $ver = "2.3.4",
            $media = "all"
        );
    }

    public function add_menu_to_dashboard()
    {
        add_menu_page(
            'Carousel Settings',
            'Post Carousel Settings',
            'manage_options',
            'post-carousel',
            array(new AddCarousel(), 'create_add_carousel_table'),
            '',
            128
        );
    }
}

class AddCarousel
{
    public function __construct()
    {

    }

    public function create_add_carousel_table()
    {
        echo "This is tempreorary";
    }
}
