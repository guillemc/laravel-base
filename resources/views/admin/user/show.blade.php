@php
    $title = trans('admin.menu_users');
    $label = $model->name;
@endphp

@extends('admin.layouts.app', [
    'title' => "$title: $label",
    'breadcrumbs' => [$title],
    'menu_active' => 'users',
])

@section('header')
<h1>{{ $title }} <small>{{ $label }}</small></h1>
@endsection

@section('content')
<div class="box box-primary">

<div class="box-header">

</div>

<div class="box-body">

  <table class="table table-bordered table-condensed table-striped">
    <tr>
        <th>{{ label('id') }}</th>
        <td>{{ $model->id }}</td>
    </tr>
    <tr>
        <th>{{ label('name') }}</th>
        <td>{{ $model->name }}</td>
    </tr>
    <tr>
        <th>{{ label('email') }}</th>
        <td>{{ $model->email }}</td>
    </tr>
    <tr>
        <th>{{ label('created_at') }}</th>
        <td>{{ $model->created_at }}</td>
    </tr>
    <tr>
        <th>{{ label('updated_at') }}</th>
        <td>{{ $model->updated_at }}</td>
    </tr>
  </table>

</div>

<div class="box-footer">
    <a class="btn btn-primary pull-right" href="{{ route('admin.user.edit', $model->id) }}"><i class="fa fa-pencil"></i> {{ trans('admin.btn_edit') }}</a>
    <a class="btn btn-default" data-action="back" href="{{ route('admin.user.index') }}"><i class="fa fa-arrow-left"></i> {{ trans('admin.link_back') }}</a>
</div>

</div>
@endsection
