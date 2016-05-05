<?php

namespace App\Support;

class Html
{

    public static function classes($a) {
        $classes = [];
        foreach ($a as $k => $v) {
            if (is_int($k) && $v) {
                $classes[] = $v;
            } else if ($v) {
                $classes[] = $k;
            }
        }
        return $classes ? 'class="'.implode(' ', $classes).'"' : '';
    }

}
