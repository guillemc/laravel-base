<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($title) ? $title.' | '.config('app.name') : config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="{{ asset("/components/adminlte/css/AdminLTE.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/components/adminlte/css/skins/skin-blue.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/css/admin.css") }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>

@php
    if (!isset($breadcrumbs)) $breadcrumbs = [];
    $collapse = filter_input(INPUT_COOKIE, 'admin-sidebar-collapse');
@endphp

<body @class(['skin-blue', 'sidebar-collapse' => $collapse])>

    <div class="wrapper">

    <header class="main-header">
    <a href="{{ route('home') }}" class="logo" rel="external"><b>{{ config('app.name') }}</b></a>
    @include('admin.partials.navbar')
    </header>

    <aside class="main-sidebar">
    <section class="sidebar">
        @include('admin.partials.menu')
    </section>
    </aside>

    <div class="content-wrapper" id="main-content">

        @hasSection('header')
        <section class="content-header">
            @yield('header')

            @if($breadcrumbs)
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i>&nbsp;{{ trans('admin.menu_home') }}</a></li>
                @php $i = 0; $n = count($breadcrumbs); @endphp
                @foreach($breadcrumbs as $route => $crumb)
                <li @class(['active' => $i == $n - 1])>@if(is_int($route)){{ $crumb }}@else<a href="{{ $route }}">{{ $crumb }}</a>@endif</li>
                @php $i++ @endphp
                @endforeach
            </ol>
            @endif
        </section>
        @endif

        <section class="content">
             @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <a href="#main-content" rel="go-top"><i class="fa fa-angle-up"></i></a>
        </div>
        {{ config('app.name') }} &copy; {{ date('Y') }}
    </footer>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ asset("/js/jquery.pjax.js") }}"></script>
    <script src="{{ asset("/components/adminlte/js/app.min.js") }}"></script>
    <script src="{{ asset("/js/admin.js") }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
