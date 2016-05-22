@php
    $title = 'Template generation';
@endphp

@extends('admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => '',
])

@section('header')
<h1>{{ $title }} <small>{{ $name }}</small></h1>
@endsection

@section('content')


@if ($err->any())
    <div class="alert alert-danger">
        <button data-dismiss="alert" class="close" type="button">×</button>
        @foreach ($err->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

<div class="row">

<div class="col-lg-6">
    <form method="get" class="form-horizontal">

    <p><input type="text" class="form-control" name="name" value="{{ $name }}" placeholder="Model class (e.g. App\User)" maxlength="60"></p>

    @if($fields)
    <table class="table table-bordered table-condensed table-striped">
      <tr><th>Field</th><th>List filter</th><th>Match</th><th>Edit control</th></tr>
    @foreach($fields as $name => $type)
        <tr>
          <td>{{ $name }}</td>
          <td>
            <select class="form-control" name="listFields[{{ $name }}]">
              <option value="none" @selected($listFields[$name]=='none')>-</option>
              <option value="no_filter" @selected($listFields[$name]=='no_filter')>no filter</option>
              <option value="text_filter" @selected($listFields[$name]=='text_filter')>text filter</option>
              <option value="boolean_filter" @selected($listFields[$name]=='boolean_filter')>boolean filter</option>
              <option value="select_filter" @selected($listFields[$name]=='select_filter')>select filter</option>
            </select>
          </td>
          <td>
            <select class="form-control" name="searchFields[{{ $name }}]">
              <option value="none" @selected($searchFields[$name]=='none')>-</option>
              <option value="exact" @selected($searchFields[$name]=='exact')>exact</option>
              <option value="like" @selected($searchFields[$name]=='like')>like</option>
              <option value="boolean" @selected($searchFields[$name]=='boolean')>boolean</option>
            </select>
          </td>
          <td>
            <select class="form-control" name="controls[{{ $name }}]">
              <option value="none" @selected($controls[$name]=='none')>-</option>
              <option value="text" @selected($controls[$name]=='text')>text</option>
              <option value="textarea" @selected($controls[$name]=='textarea')>textarea</option>
              <option value="select" @selected($controls[$name]=='select')>select</option>
              <option value="radio" @selected($controls[$name]=='radio')>radio (boolean)</option>
              <option value="radio_options" @selected($controls[$name]=='radio_options')>radio (options)</option>
              <option value="checkbox" @selected($controls[$name]=='checkbox')>checkbox (boolean)</option>
              <option value="checkbox_options" @selected($controls[$name]=='checkbox_options')>checkbox (options)</option>
            </select>
          </td>
        </tr>
    @endforeach
    </table>
    @endif

    <button class="btn btn-primary" type="submit">{{ trans('admin.btn_send') }}</button>

    </form>
</div>


<div class="col-lg-6">
@foreach (['repository', 'controller', 'index', 'edit', 'show'] as $t)

@if(isset($templates[$t]))

  <h4>{{ $t }}</h4>
  <textarea class="form-control" rows="10" cols="60">{{ $templates[$t] }}</textarea>
  <hr>

@endif
@endforeach

</div>
</div>

@endsection
