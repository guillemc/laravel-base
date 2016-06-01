<?php

$model_name = snake_case($modelName);
$plural_name = str_plural($model_name);

?>
@php
    $title = <?= 'trans' ?>('admin.menu_<?= $plural_name ?>');
    $url = url()->current();
@endphp

@extends($pjax ? 'admin.layouts.pjax' : 'admin.layouts.app', [
    'title' => $title,
    'breadcrumbs' => [$title],
    'menu_active' => '<?= $plural_name ?>',
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
<a class="btn btn-primary" href="{{ route('admin.<?= $model_name ?>.create') }}"><i class="fa fa-plus"></i> {{ trans('admin.btn_add_new') }}</a>
</div>
</div>

<div class="box-body">

<div class="grid-view" data-confirm-delete="{{ trans('admin.confirm_delete') }}">
    <form method="get" name="filters" action="{{ $url }}">
    <table class="table table-bordered table-striped ">
    <thead>
    <tr class="labels" data-order="{{ key($order) }}" data-direction="{{ current($order) }}">
<?php foreach ($fields as $name => $type): if ($listFields[$name] == 'none') continue; ?>
        <th<?php if ($type != 'string') echo ' class="sort-numerical"' ?>><a data-attr="<?= $name ?>" href="#">{{ label('<?= $name ?>') }}</a></th>
<?php endforeach ?>
        <th class="action-column">
<?php if ($positionField): ?>
            <a class="btn btn-default" href="{{ route('admin.<?= $model_name ?>.sort') }}">{{ trans('admin.btn_sort') }} <i class="fa fa-sort"></i></a>
<?php endif ?>
        </th>
    </tr>
    <tr class="filters">
<?php foreach ($fields as $name => $type): if ($listFields[$name] == 'none') continue; ?>
<?php if ($listFields[$name] == 'text_filter'): ?>
      <td><input type="text" class="form-control" name="search[<?= $name ?>]" value="{{ $search['<?= $name ?>'] or '' }}"></td>
<?php elseif ($listFields[$name] == 'boolean_filter'): ?>
      <td>
        <select class="form-control" name="search[<?= $name ?>]">
          <option value=""></option>
          <option value="1" @selected(isset($search['<?= $name ?>']) && $search['<?= $name ?>'] == '1')>{{ trans('admin.option_yes') }}</option>
          <option value="0" @selected(isset($search['<?= $name ?>']) && $search['<?= $name ?>'] == '0')>{{ trans('admin.option_no') }}</option>
        </select>
      </td>
<?php elseif ($listFields[$name] == 'select_filter'): ?>
      <td>
        <select class="form-control" name="search[<?= $name ?>]">
          <option value=""></option>
          @foreach(\<?= $modelFullName ?>::getOptions('<?= $name ?>') as $k => $v)<option value="{{ $k }}" @selected(isset($search['<?= $name ?>']) && $search['<?= $name ?>'] == $k)>{{ $v }}</option>@endforeach
        </select>
      </td>
<?php else: ?>
      <td> </td>
<?php endif ?>
<?php endforeach ?>
        <td class="text-center buttons">
            <button class="btn btn-default" type="submit" title="{{ trans('admin.btn_search') }}"><i class="fa fa-search"></i></button>
            <a class="btn btn-default" title="{{ trans('admin.btn_reset_search') }}" href="{{ $url.'?search=' }}"><i class="fa fa-undo"></i></a>
        </td>
    </tr>
    </thead>
    <tbody>
    @foreach($pager as $r)
    <tr>
<?php foreach ($fields as $name => $type):
        if ($listFields[$name] == 'none') continue;

        if ($listFields[$name] == 'select_filter'):
            $label = '$r->getOptionValue(\''.$name.'\')';
        elseif ($listFields[$name] == 'boolean_filter'):
            $label = '$r->'.$name.' ? trans(\'admin.option_yes\') : trans(\'admin.option_no\')';
        else:
            $label = '$r->'.$name;
        endif;
?>
        <td<?php if ($type != 'string') echo ' class="text-center"' ?>><?php if (in_array($name, $labelFields)): ?><a href="{{ route('admin.<?= $model_name ?>.edit', $r->id) }}">{{ <?= $label ?> }}</a><?php else: ?>{{ <?= $label ?> }}<?php endif ?></td>
<?php endforeach ?>
        <td class="text-center buttons">
            <a href="{{ route('admin.<?= $model_name ?>.show', $r->id) }}" title="{{ trans('admin.btn_view') }}"><span class="label label-primary"><i class="fa fa-eye"></i></span></a>
            <a href="{{ route('admin.<?= $model_name ?>.edit', $r->id) }}" title="{{ trans('admin.btn_edit') }}"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
            <a href="{{ route('admin.<?= $model_name ?>.destroy', $r->id) }}" data-action="ajax-delete" title="{{ trans('admin.btn_delete') }}"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
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
    <a class="btn btn-primary" href="{{ route('admin.<?= $model_name ?>.create') }}"><i class="fa fa-plus"></i> {{ trans('admin.btn_add_new') }}</a>
    </div>
</div>

</div>
@endsection
