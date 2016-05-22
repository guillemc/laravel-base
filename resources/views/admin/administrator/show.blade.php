@php
    $title = trans('admin.menu_administrators');
@endphp

@extends('admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => '',
])

@section('header')
<h1>{{ $title }} <small>{{ $model->name }}</small></h1>
@endsection

@section('content')
<div class="box box-primary">

<div class="box-header">


</div>

<div class="box-body">

  <table class="table table-bordered table-condensed table-striped">
    <tr>
        <th>{{ label('name') }}</th>
        <td>{{ $model->name }}</td>
    </tr>
    <tr>
        <th>{{ label('email') }}</th>
        <td>{{ $model->email }}</td>
    </tr>
    <tr>
        <th>{{ label('role') }}</th>
        <td>{{ $model->getOptionValue('role') }}</td>
    </tr>
    <tr>
        <th>{{ label('last_login') }}</th>
        <td>{{ $model->last_login }}</td>
    </tr>
  </table>

</div>

<div class="box-footer">
    <a class="btn btn-primary pull-right" href="{{ route('admin.administrator.edit', $model->id) }}"><i class="fa fa-pencil"></i>&nbsp;{{ trans('admin.btn_edit') }}</a>
    <a class="btn btn-default" data-action="back" href="{{ route('admin.administrator.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('admin.link_back') }}</a>
</div>

</div>
@endsection
