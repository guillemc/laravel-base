@php

if (!isset($menu_active)) $menu_active = '';

$activate = function ($option) use ($menu_active) {
    return strpos($menu_active, $option) === 0 ? 'active' : '';
};

@endphp

<ul class="sidebar-menu">

  <li class="{!! $activate('home') !!}">
    <a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> <span>{{ trans('admin.menu_home') }}</span></a>
  </li>

  <li class="{!! $activate('users') !!}">
    <a href="{{ route('admin.user.index')}}"><i class="fa fa-user"></i> <span>{{ trans('admin.menu_users') }}</span></a>
  </li>

  <li class="treeview {!! $activate('configuration') !!}">
    <a href="#"><i class="fa fa-cog"></i> <span>Configuration</span> <i class="fa fa-angle-left pull-right"></i></a>

    <ul class="treeview-menu">
      <li class="{!! $activate('configuration.options') !!}">
        <a href="#"><i class="fa fa-tag"></i> <span>Options</span></a>
      </li>
      <li class="{!! $activate('configuration.translations') !!}">
        <a href="#"><i class="fa fa-globe"></i> <span>Translations</span></a>
      </li>
    </ul>
  </li>


</ul>