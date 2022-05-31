@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
    <div class="col-12">
      <h2 class="text-white text-center">{{ __('Welcome to Chatinity') }}</h2>
    </div>
    <div class="col-7">
      <img src="{{ asset('material/img/home.svg') }}" />
    </div>
  </div>
</div>
@endsection