@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('User Profile')])


@push('styles')
<style type="text/css">
    #users>li {
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- If images count > 0 -->
                @if(count($images) > 0)
                @foreach($images as $image)
                <!-- Image Card Include -->
                @include('layouts.page_templates.image', ['image' => $image])
                @endforeach
                @else
                <div class="alert alert-primary">
                    <strong>No images found</strong>
                </div>
                @endif
            </div>
        </div>
        @endsection