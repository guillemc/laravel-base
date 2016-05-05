@extends('admin.layouts.app', [
    'title' => 'Error',
    'breadcrumbs' => ['Error'],
    'menu_active' => '',
])

@section('header')
<h1>Error <small>Internal server error</small></h1>
@endsection

@section('content')
<div class="site-error">

    <div class="alert alert-danger">
        An unexpected server error has ocurred. Please contact us if the problem persists.
    </div>

</div>
@endsection