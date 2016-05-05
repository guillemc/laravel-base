@php
    $title = trans('admin.menu_users')
@endphp

@extends('admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => 'users',
])

@section('header')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<p>TO DO: user list</p>
@endsection