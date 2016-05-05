<?php

function label($name) {
    $key = "validation.attributes.{$name}";
    return ucfirst(trans($key));
}

function html_classes($a) {
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
