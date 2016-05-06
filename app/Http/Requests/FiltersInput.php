<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait FiltersInput
{

    public function filter(Request $request, $keys, $callback)
    {
        $values = [];
        if (!is_array($keys)) $keys = array($keys);
        foreach ($keys as $key) {
            $value = $request->input($key, null);
            if ($value === null) {
                continue;
            }
            Arr::set($values, $key, call_user_func($callback, $value));
        }
        if ($values) {
            $request->merge($values);
        }
    }

}