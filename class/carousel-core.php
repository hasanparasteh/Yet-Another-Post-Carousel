<?php
class CarouselPostLoop
{
    public function __construct()
    {
        $this->number = 3;
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
        $query = new WP_Query($args);
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
                echo "<h3><a href=\"" . get_bloginfo('url') . "/" . $postinfo->post_name . "\">" . $postinfo->post_title . "</a></h3>";
                echo "<div>" . $postinfo->post_date . "<br/>" . get_the_author_meta($field = "display_name", $user_id = $postinfo->post_author) . "</div>";
                echo '</div>';
            }

        endforeach;
        echo "</div>";
    }

    public function shortcode_latest_posts()
    {
        return $this->show_latest_posts($this->number);
    }

    public function timeago($ptime)
    {
        $ptime = strtotime($ptime);
        $etime = time() - $ptime;
        if ($etime < 1) {
            return 'just now';
        }

        $interval = array(12 * 30 * 24 * 60 * 60 => 'years ago ('
            . date('Y-m-d', $ptime) . ')', 30 * 24 * 60 * 60 => 'months ago ('
            . date('m-d', $ptime) . ')', 7 * 24 * 60 * 60 => 'weeks ago ('
            . date('m-d', $ptime) . ')', 24 * 60 * 60 => 'days ago', 60 * 60 => 'hours ago', 60 => 'minutes ago', 1 => 'seconds ago');

        foreach ($interval as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . $str;
            }
        }
    }
}