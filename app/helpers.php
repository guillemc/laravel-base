<?php

function label($name) {
    return ucfirst(trans("validation.attributes.{$name}"));
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