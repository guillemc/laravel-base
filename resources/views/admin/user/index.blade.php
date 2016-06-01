@php
    $title = trans('admin.menu_users');
    $url = url()->current();
@endphp

@extends($pjax ? 'admin.layouts.pjax' : 'admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => 'users',
])

@section('header')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<div class="box box-primary">

<div class="box-header">
<p class="pull-left">{!! trans('admin.title_pagination', ['from' => $pager->firstItem(), 'to' => $pager->lastItem(), 'total' => $pager->total()]) !!}</p>
<p class="pull-right">
    {{ trans('admin.per_page') }}
    @foreach($pageSizes as $p)
    <a href="{{ $url.'?page_size='.$p }}" class="label {{ $p == $pager->perPage() ? 'label-primary' : 'label-default'  }}">{!! $p !!}</a>
    @endforeach
</p>
<div class="buttons">
<a class="btn btn-primary" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i> {{ trans('admin.btn_add_new') }}</a>
</div>
</div>

<div class="box-body">

<div class="grid-view" data-confirm-delete="{{ trans('admin.confirm_delete') }}">
    <form method="get" name="filters" action="{{ $url }}">
    <table class="table table-bordered table-striped ">
    <thead>
    <tr class="labels" data-order="{{ key($order) }}" data-direction="{{ current($order) }}">
        <th class="sort-numerical"><a data-attr="id" href="#">{{ label('id') }}</a></th>
        <th><a data-attr="name" href="#">{{ label('name') }}</a></th>
        <th><a data-attr="email" href="#">{{ label('email') }}</a></th>
        <th class="sort-numerical"><a data-attr="created_at" href="#">{{ label('created_at') }}</a></th>
        <th class="action-column">
             
        </th>
    </tr>
    <tr class="filters">
      <td><input type="text" class="form-control" name="search[id]" value="{{ $search['id'] or '' }}"></td>
      <td><input type="text" class="form-control" name="search[name]" value="{{ $search['name'] or '' }}"></td>
      <td><input type="text" class="form-control" name="search[email]" value="{{ $search['email'] or '' }}"></td>
      <td> </td>
        <td class="text-center buttons">
            <button class="btn btn-default" type="submit" title="{{ trans('admin.btn_search') }}"><i class="fa fa-search"></i></button>
            <a class="btn btn-default" title="{{ trans('admin.btn_reset_search') }}" href="{{ $url.'?search=' }}"><i class="fa fa-undo"></i></a>
        </td>
    </tr>
    </thead>
    <tbody>
    @foreach($pager as $r)
    <tr>
        <td class="text-center"><a href="{{ route('admin.user.edit', $r->id) }}">{{ $r->id }}</a></td>
        <td><a href="{{ route('admin.user.edit', $r->id) }}">{{ $r->name }}</a></td>
        <td><a href="{{ route('admin.user.edit', $r->id) }}">{{ $r->email }}</a></td>
        <td class="text-center">{{ $r->created_at }}</td>
        <td class="text-center buttons">
            <a href="{{ route('admin.user.show', $r->id) }}" title="{{ trans('admin.btn_view') }}"><span class="label label-primary"><i class="fa fa-eye"></i></span></a>
            <a href="{{ route('admin.user.edit', $r->id) }}" title="{{ trans('admin.btn_edit') }}"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
            <a href="{{ route('admin.user.destroy', $r->id) }}" data-action="ajax-delete" title="{{ trans('admin.btn_delete') }}"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </form>
</div>

</div>
<div class="box-footer clearfix">
    <div class="pull-right">
        {!! $pager->links() !!}
    </div>
    <div class="buttons">
    <a class="btn btn-primary" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i> {{ trans('admin.btn_add_new') }}</a>
    </div>
</div>

</div>
@endsection
