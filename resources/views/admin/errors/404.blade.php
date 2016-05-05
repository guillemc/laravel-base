@extends('admin.layouts.app', [
    'title' => 'Not found',
    'breadcrumbs' => ['Error'],
    'menu_active' => '',
])

@section('header')
<h1>Error <small>Not found</small></h1>
@endsection

@section('content')
<div class="site-error">

    <div class="alert alert-danger">
        The requested page was not found on the server.
    </div>

</div>
@endsection