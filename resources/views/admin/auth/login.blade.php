@extends('admin.layouts.login', ['title' => trans('admin.title_login')])

@section('content')

<div class="login-box">
  <div class="login-logo">
      <a href="{{ route('home') }}"><b>{{ config('app.name') }}</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ trans('admin.text_please_log_in') }}</p>

    @if(count($errors) > 0)
    <p class="text-danger">
        <i class="fa fa-exclamation-circle"></i> {{ trans('admin.error_login_failed') }}
    </p>
    @endif

    <form id="login-form" action="{{ route('admin.login_action') }}" method="post">
      {!! csrf_field() !!}
      <div class="form-group has-feedback @err_class('email')">
        <input type="text" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" autofocus="autofocus" placeholder="{{ trans('admin.label_email') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback @err_class('password')">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="{{ trans('admin.label_password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
              <label><input type="checkbox" name="remember" value="1" > {{ trans('admin.label_remember_me') }}</label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('admin.link_log_in') }}</button>
        </div><!-- /.col -->
      </div>
    </form>

    <p class="text-right"><a href="{{ route('admin.forgot_password') }}">{{ trans('admin.link_forgot_password') }}</a></p>


  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@endsection
