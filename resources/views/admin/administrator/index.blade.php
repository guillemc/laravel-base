@php
    $title = trans('admin.menu_administrators')
@endphp

@extends('admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => '',
])

@section('header')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<p>TO DO: user list</p>

<p>search: <?php print_r($search) ?></p>

<p>pageSize: {{ $pageSize }}</p>

<p>page: {{ $page }}</p>
@endsection