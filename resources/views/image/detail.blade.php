@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Image Detail')])

<link href="{{ asset('css/homemobile.css') }}" rel="stylesheet">

@push('styles')
<style type="text/css">
    #users>li {
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<div>
    @include('layouts.page_templates.desktopdetail', ['image' => $image])
</div>
<div>
    @include('layouts.page_templates.mobiledetail', ['image' => $image])
</div>
@endsection