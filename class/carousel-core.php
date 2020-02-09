<?php
namespace Carousel;
use Carousel\CarouselUtils;

class CarouselPostLoop
{
    public function __construct()
    {
        $this->number = 3;
        $this->utils = new CarouselUtils();
        add_shortcode('latestPostCarousel', array($this, 'shortcode_latest_posts'));
    }

    public function get_latest_posts()
    {
        $recentPosts = [];
        $args = array(
            'posts_per_page' => $this->number,
            'offset' => 0,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish',
            'suppress_filters' => true,
        );
        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()): $query->the_post();
                array_push($recentPosts, get_the_ID());
            endwhile;
        }
        wp_reset_postdata();

        return $recentPosts;
    }

    public function show_latest_posts()
    {
        echo "<div class=\"owl-carousel owl-theme\">";
        foreach ($this->get_latest_posts($posts = $this->number) as $item):
            $postinfo = get_post((int) $item);

            if ($postinfo->post_status == 'publish') {
                echo '<div class="item post-carousel">';
                echo get_the_post_thumbnail($item);
                echo "<div class='carousel-meta'>";
                echo "<div><i class='fas fa-clock'></i> " . $this->utils->timeago($postinfo->post_date) . "</div>";
                echo "<div><i class='fas fa-user'></i> " . get_the_author_meta($field = "display_name", $user_id = $postinfo->post_author) . "</div>";
                echo "<div><i class='fas fa-folder'></i> " . $this->utils->show_cats_by_id($item) . "</div>";
                echo "</div>";
                echo "<div class='carousel-content'>";
                echo "<h3><a href=\"" . get_bloginfo('url') . "/" . $postinfo->post_name . "\">" . $postinfo->post_title . "</a></h3>";
                echo "<p>" . $this->utils->make_excerpt($postinfo->post_content, 90) . "</p>";
                echo "<div class='carousel-read-more'><a href='" . $postinfo->post_name . "'>Read More</a></div>";
                echo "</div>";
                echo "</div>";
            }
        endforeach;
        echo "</div>";
    }

    public function shortcode_latest_posts()
    {
        return $this->show_latest_posts($this->number);
    }
}
