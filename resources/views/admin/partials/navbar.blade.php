<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      @unless (Auth::guest())

      @can('administrator.manage')
      <li>
        <a href="{{ route('admin.administrator.index') }}"><i class="fa fa-users"></i>&nbsp;{{ trans('admin.menu_administrators') }}</a>
      </li>
      @endcan

      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="@gravatar(Auth::user()->email)" class="user-image" alt="avatar"/>
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            <img src="@gravatar(Auth::user()->email)" class="img-circle" alt="avatar" />
            <p>
              {{ Auth::user()->name }}
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">{{ trans('admin.link_profile') }}</a>
            </div>
            <div class="pull-right">
              <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">{{ trans('admin.link_logout') }}</a>
            </div>
          </li>
        </ul>
      </li>
      @endunless
    </ul>
  </div>
</nav>