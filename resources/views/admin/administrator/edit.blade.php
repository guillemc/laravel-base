@php
    $title = trans('admin.menu_administrators');
@endphp

@extends('admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => '',
])

@section('header')
<h1>{{ $title }} <small>{{ $model->name ?: trans('admin.title_new') }}</small></h1>
@endsection

@section('content')
<div class="box box-primary">

<div class="box-header">

    @if ($errors->any())
        <div class="alert alert-danger">
            <button data-dismiss="alert" class="close" type="button">×</button>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

</div>

<form class="form-horizontal" action="{{ $model->exists ? route('admin.administrator.update', $model->id) : route('admin.administrator.store') }}" method="post" data-confirm-delete="{{ trans('admin.confirm_delete') }}">
{!! csrf_field() !!}
@if($model->exists){!! method_field('PUT') !!}@endif

<div class="box-body">

    <div class="form-group @err_class('name')">
        <label class="control-label col-sm-4">{{ label('name') }}</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" name="name" value="{{ old('name') ?: $model->name }}" maxlength="60">
        @err_block('name')
        </div>
    </div>


    <div class="form-group @err_class('email')">
        <label class="control-label col-sm-4">{{ label('email') }}</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" name="email" value="{{ old('email') ?: $model->email }}" maxlength="120">
        @err_block('email')
        </div>
    </div>

    <div class="form-group @err_class('role')">
      <label class="control-label col-sm-4">{{ label('role') }}</label>
      <div class="col-sm-8">
        <select class="form-control" name="role">
          @foreach($model->getOptions('role') as $k => $v)
          <option value="{{ $k }}" @selected($model->role == $k)>{{ $v }}</option>
          @endforeach
        </select>
        @err_block('role')
      </div>
    </div>

    @if(!$model->exists)
    <div class="form-group @err_class('password')">
        <label class="control-label col-sm-4">{{ label('password') }}</label>
        <div class="col-sm-8">
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" maxlength="120">
        @err_block('password')
        </div>
    </div>
    <div class="form-group @err_class('password_confirmation')">
        <label class="control-label col-sm-4">{{ label('password_confirmation') }}</label>
        <div class="col-sm-8">
        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" maxlength="120">
        @err_block('password_confirmation')
        </div>
    </div>
    @endif

</div>

<div class="box-footer">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-4">
          @if($model->exists)
          <a class="btn btn-danger pull-right" data-action="delete" href="#">{{ trans('admin.btn_delete') }}</a>
          @endif
          <a class="btn btn-default" data-action="back" href="{{ route('admin.administrator.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('admin.link_back') }}</a>
          <button type="submit" class="btn btn-success">{{ trans('admin.btn_save') }}&nbsp;<i class="fa fa-check"></i></button>
      </div>
    </div>
</div>

</form>

</div>
@endsection
