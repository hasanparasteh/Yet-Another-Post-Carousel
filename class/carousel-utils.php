<?php
namespace Carousel;

class CarouselUtils
{
    public function __construct()
    {

    }

    public function make_excerpt($string, $length, $end = '....')
    {
        $string = strip_tags($string);

        if (strlen($string) > $length) {
            $stringCut = substr($string, 0, $length);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . $end;
        }
        return $string;
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

    public function show_cats_by_id($id)
    {
        $post_categories = wp_get_post_categories($id);

        foreach ($post_categories as $c) {
            $cat = get_category($c);
            return $cat->name;
        }
    }
}
