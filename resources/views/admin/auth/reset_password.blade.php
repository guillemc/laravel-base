@extends('admin.layouts.login', ['title' => trans('admin.title_reset_password')])

@section('content')

<div class="login-box">
  <div class="login-logo">
      <a href="{{ route('home') }}"><b>{{ config('app.name') }}</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ trans('admin.text_reset_password') }}</p>

    @if(count($errors) > 0)
    <p class="text-danger">
        <i class="fa fa-exclamation-circle"></i> @foreach ($errors->all() as $error) {{ $error }} <br> @endforeach
    </p>
    @endif

    <form id="login-form" action="{{ route('admin.reset_password_action') }}" method="post">
      {!! csrf_field() !!}

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group has-feedback @err_class('email')">
        <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="{{ trans('admin.label_email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback @err_class('password')">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="{{ trans('admin.label_password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback @err_class('password_confirmation')">
        <input type="password" class="form-control" name="password_confirmation" autocomplete="off" placeholder="{{ trans('admin.label_repeat_password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('admin.btn_reset_password') }}</button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@endsection