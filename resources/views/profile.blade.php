@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    You are logged in as {{ Auth::user()->name }} &lt;{{ Auth::user()->email }}&gt;

                    <h4>Session variables</h4>
                    <pre>{{ print_r(request()->session()->all(), true) }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
