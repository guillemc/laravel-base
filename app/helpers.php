<?php

/* VIEW HELPERS */

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



/* DB HELPERS */

function prepare_like($str) {
    return '%'.addcslashes($str, '%_').'%';
}

function get_count_from_query(\Illuminate\Database\Query\Builder $query) {
    $totalQuery = DB::table(DB::raw("({$query->toSql()}) AS t"));
    $totalQuery->setBindings($query->getBindings());
    return $totalQuery->select(DB::raw('COUNT(*) AS num'))->value('num');
}