@php
    $title = trans('admin.title_profile')
@endphp

@extends('admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => '',
])

@section('header')
<h1>{{ $title }} <small>{{ Auth::user()->name }}</small></h1>
@endsection

@section('content')

@if(session('status'))
<div class="alert alert-success">
    <button data-dismiss="alert" class="close" type="button">×</button>
    <i class="fa fa-check"></i>  {{ session('status') }}
</div>
@endif

<div class="row">

  <div class="col-md-6">

        <div class="box box-primary">
        <div class="box-header">
          <h2>{{ trans('admin.title_profile_info') }}</h2>
        </div>
        <form class="form-horizontal" action="{{ route('admin.profile_store_action') }}" method="post">
        {!! csrf_field() !!}
        <div class="box-body">

            <div class="form-group @err_class('name')">
                <label class="control-label col-sm-4">{{ label('name') }}</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="name" value="{{ old('name') ?: $user->name }}" maxlength="60">
                @err_block('name')
                </div>
            </div>


            <div class="form-group @err_class('email')">
                <label class="control-label col-sm-4">{{ label('email') }}</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="email" value="{{ old('email') ?: $user->email }}" maxlength="120">
                @err_block('email')
                </div>
            </div>

        </div>

        <div class="box-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-4">
                <button type="submit" class="btn btn-success">{{ trans('admin.btn_save') }}&nbsp;<i class="fa fa-check"></i></button>
              </div>
            </div>
        </div>

        </form>
        </div>

  </div>

  <div class="col-md-6">

        <div class="box box-primary">
        <div class="box-header">
          <h2>{{ trans('admin.title_profile_password') }}</h2>
        </div>
        <form class="form-horizontal" action="{{ route('admin.profile_password_action') }}" method="post">
        {!! csrf_field() !!}
        <div class="box-body">

            <div class="form-group @err_class('password')">
                <label class="control-label col-sm-4">{{ label('password') }}</label>
                <div class="col-sm-8">
                <input type="password" class="form-control" name="password" value="" maxlength="120">
                @err_block('password')
                </div>
            </div>


            <div class="form-group  @err_class('password_confirmation')">
                <label class="control-label col-sm-4">{{ label('password_confirmation') }}</label>
                <div class="col-sm-8">
                <input type="password" class="form-control" name="password_confirmation" value="" maxlength="120">
                @err_block('password_confirmation')
                </div>
            </div>

        </div>

        <div class="box-footer">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-4">
                <button type="submit" class="btn btn-success">{{ trans('admin.btn_save') }}&nbsp;<i class="fa fa-check"></i></button>
              </div>
            </div>
        </div>

        </form>
        </div>

  </div>
</div>


@endsection
