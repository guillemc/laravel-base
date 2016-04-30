@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.

                    <h4>Session variables</h4>
                    <pre>{{ print_r(request()->session()->all(), true) }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
