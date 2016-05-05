@extends('admin.layouts.app', [
    'title' => 'Unauthorized',
    'breadcrumbs' => ['Unauthorized'],
    'menu_active' => '',
])

@section('header')
<h1>Error <small>Unauthorized</small></h1>
@endsection

@section('content')
<div class="site-error">

    <div class="alert alert-danger">
        You don't have permission to perform the requested action.
    </div>

</div>
@endsection