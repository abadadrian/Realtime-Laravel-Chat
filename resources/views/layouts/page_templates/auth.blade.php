<div class="container-fluid">
  @include('layouts.navbars.navs.auth')
  <div class="main-panel">
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>