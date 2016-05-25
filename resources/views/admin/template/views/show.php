<?php

$model_name = snake_case($modelName);
$plural_name = str_plural($model_name);

?>
@php
    $title = <?= 'trans' ?>('admin.menu_<?= $plural_name ?>');
    $label = $model-><?= $titleField ?>;
@endphp

@extends('admin.layouts.app', [
    'title' => "$title: $label",
    'breadcrumbs' => [route('admin.<?= $model_name ?>.index') => $title, $label],
    'menu_active' => '<?= $plural_name ?>',
])

@section('header')
<h1>{{ $title }} <small>{{ $label }}</small></h1>
@endsection

@section('content')
<div class="box box-primary">

<div class="box-header">

</div>

<div class="box-body">

  <table class="table table-bordered table-condensed table-striped">
<?php foreach ($fields as $name => $type): ?>
    <tr>
        <th>{{ label('<?= $name ?>') }}</th>
        <td>{{ $model-><?= $name ?> }}</td>
    </tr>
<?php endforeach ?>
  </table>

</div>

<div class="box-footer">
    <a class="btn btn-primary pull-right" href="{{ route('admin.<?= $model_name ?>.edit', $model->id) }}"><i class="fa fa-pencil"></i>&nbsp;{{ trans('admin.btn_edit') }}</a>
    <a class="btn btn-default" data-action="back" href="{{ route('admin.<?= $model_name ?>.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('admin.link_back') }}</a>
</div>

</div>
@endsection
