<?php

$labelWidth = 4;
$controlWidth = 8;

$model_name = snake_case($modelName);
$plural_name = str_plural($model_name);

?>
@php
    $title = trans('admin.menu_<?= $plural_name ?>');
    $label = $model-><?= $titleField ?> ?: trans('admin.title_new');
@endphp

@extends('admin.layouts.app', [
    'title' => "$title: $label",
    'breadcrumbs' => [$title],
    'menu_active' => '<?= $plural_name ?>',
])

@section('header')
<h1>{{ $title }} <small>{{ $label }}</small></h1>
@endsection

@section('content')
<div class="box box-primary">

<div class="box-header">

    @if ($errors->any())
        <div class="alert alert-danger">
            <button data-dismiss="alert" class="close" type="button">×</button>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

</div>

<form class="form-horizontal" action="{{ $model->exists ? route('admin.<?= $model_name ?>.update', $model->id) : route('admin.<?= $model_name ?>.store') }}" method="post" data-confirm-delete="{{ trans('admin.confirm_delete') }}">
{!! csrf_field() !!}
@if($model->exists){!! method_field('PUT') !!}@endif

<div class="box-body">

<?php foreach ($fields as $name => $type): if ($controls[$name] == 'none') continue; ?>
<?php if ($controls[$name] == 'textarea'): ?>
    <div class="form-group @err_class('<?= $name ?>')">
        <label class="control-label col-sm-<?= $labelWidth ?>">{{ label('<?= $name ?>') }}</label>
        <div class="col-sm-<?= $controlWidth ?>">
          <textarea class="form-control" name="<?= $name ?>" cols="60" rows="5">
            {{ old('<?= $name ?>') ?: $model-><?= $name ?> }}
          </textarea>
        @err_block('<?= $name ?>')
        </div>
    </div>
<?php elseif ($controls[$name] == 'select'): ?>
    <div class="form-group @err_class('<?= $name ?>')">
      <label class="control-label col-sm-<?= $labelWidth ?>">{{ label('<?= $name ?>') }}</label>
      <div class="col-sm-<?= $controlWidth ?>">
        <select class="form-control" name="<?= $name ?>">
          <option value=""></option>
          @foreach($model->getOptions('<?= $name ?>') as $k => $v)
          <option value="{{ $k }}" @selected($model-><?= $name ?> == $k)>{{ $v }}</option>
          @endforeach
        </select>
        @err_block('<?= $name ?>')
      </div>
    </div>
<?php elseif ($controls[$name] == 'checkbox'): ?>
    <div class="form-group @err_class('<?= $name ?>')">
      <div class="col-sm-offset-<?= $labelWidth ?> col-sm-<?= $controlWidth ?>">
        <div class="checkbox">
          <label><input type="checkbox" name="<?= $name ?>" value="1" @checked($model-><?= $name ?>)> {{ label('<?= $name ?>') }}</label>
        </div>
        @err_block('<?= $name ?>')
      </div>
    </div>
<?php elseif ($controls[$name] == 'radio'): ?>
    <div class="form-group @err_class('<?= $name ?>')">
      <label class="control-label col-sm-<?= $labelWidth ?>">{{ label('<?= $name ?>') }}</label>
      <div class="col-sm-<?= $controlWidth ?>">
        <label class="radio-inline">
            <input type="radio" name="<?= $name ?>" @checked(!$model-><?= $name ?>) value="0"> {{ trans('admin.option_no') }}
        </label>
        <label class="radio-inline">
            <input type="radio" name="<?= $name ?>" @checked($model-><?= $name ?>) value="1"> {{ trans('admin.option_yes') }}
        </label>
        @err_block('<?= $name ?>')
      </div>
    </div>
<?php elseif ($controls[$name] == 'checkbox_options'): ?>
    <label class="control-label col-sm-<?= $labelWidth ?>">{{ label('<?= $name ?>') }}</label>
    <div class="form-group @err_class('<?= $name ?>')">
      <div class="col-sm-<?= $controlWidth ?>">
        @foreach($model->getOptions('<?= $name ?>') as $k => $v)
        <div class="checkbox">
          <label><input type="checkbox" name="<?= $name ?>" value="{{ $v }}" @checked($model-><?= $name ?> == $k)> {{ $v }}</label>
        </div>
        @endforeach
        @err_block('<?= $name ?>')
      </div>
    </div>
<?php elseif ($controls[$name] == 'radio_options'): ?>
    <label class="control-label col-sm-<?= $labelWidth ?>">{{ label('<?= $name ?>') }}</label>
    <div class="form-group @err_class('<?= $name ?>')">
      <div class="col-sm-<?= $controlWidth ?>">
        @foreach($model->getOptions('<?= $name ?>') as $k => $v)
        <div class="radio">
          <label><input type="radio" name="<?= $name ?>" value="{{ $v }}" @checked($model-><?= $name ?> == $k)> {{ $v }}</label>
        </div>
        @endforeach
        @err_block('<?= $name ?>')
      </div>
    </div>
<?php else: // default: text ?>
    <div class="form-group @err_class('<?= $name ?>')">
        <label class="control-label col-sm-<?= $labelWidth ?>">{{ label('<?= $name ?>') }}</label>
        <div class="col-sm-<?= $controlWidth ?>">
        <input type="text" class="form-control" name="<?= $name ?>" value="{{ old('<?= $name ?>') ?: $model-><?= $name ?> }}" maxlength="60">
        @err_block('<?= $name ?>')
        </div>
    </div>
<?php endif ?>
<?php endforeach ?>
</div>

<div class="box-footer">
    <div class="row">
      <div class="col-sm-<?= $controlWidth ?> col-sm-offset-<?= $labelWidth ?>">
          @if($model->exists)
          <a href="#" class="btn btn-danger pull-right" data-action="delete">{{ trans('admin.btn_delete') }}</a>
          @endif
          <a class="btn btn-default" data-action="back" href="{{ route('admin.<?= $model_name ?>.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('admin.link_back') }}</a>
          <button type="submit" class="btn btn-success">{{ trans('admin.btn_save') }}&nbsp;<i class="fa fa-check"></i></button>
      </div>
    </div>
</div>

</form>

</div>
@endsection