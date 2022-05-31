@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter"  data-color="purple">
    @yield('content')
    @include('layouts.footers.guest')
  </div>
</div>