@extends('admin.layouts.login', ['title' => trans('admin.title_reset_password')])

@section('content')

<div class="login-box">
  <div class="login-logo">
      <a href="{{ route('home') }}"><b>{{ config('app.name') }}</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{ trans('admin.text_forgot_password') }}</p>

    @if($errors->has('email'))
        <p class="text-danger"><i class="fa fa-exclamation-circle"></i> {{ $errors->first('email') }}</p>
    @endif

    @if(session('status'))
        <p class="text-success"><i class="fa fa-check"></i>  {{ session('status') }} </p>
    @endif

    <form id="login-form" action="{{ route('admin.forgot_password_action') }}" method="post">
      {!! csrf_field() !!}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" autofocus="autofocus" placeholder="{{ trans('admin.label_email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('admin.btn_send') }}</button>
        </div><!-- /.col -->
      </div>
    </form>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@endsection
