@extends('admin.layouts.app', [
    'title' => 'Maintenance',
    'breadcrumbs' => ['Maintenance'],
    'menu_active' => '',
])

@section('header')
<h1>Maintenance <small>Temporarily disabled</small></h1>
@endsection

@section('content')
<div class="site-error">

    <div class="alert alert-danger">
        Site is undergoing maintenance, please check back in a few minutes.
    </div>

</div>
@endsection