@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('User Profile')])

<link href="{{ asset('css/homemobile.css') }}" rel="stylesheet">

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
        <div id="notification" class="alert alert-dismissible mx-1 invisible fade show ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @if (session('status'))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status') }}</span>
                </div>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- If images count > 0 -->
                @if(count($images) > 0)
                @foreach($images as $image)
                <!-- Image Card Include -->
                @include('layouts.page_templates.image', ['image' => $image])
                @endforeach
                @else
                <div class="row justify-content-center col-12">
                    <div class="col-md-8 col-xs-10 row justify-content-center">
                        <p class="font-weight-bold">No images uploaded yet...</p>
                        <!-- PHP for print random gif from public/assets/gifs -->
                        <img src="{{ asset('assets/gifs/'.rand(1,8).'.gif') }}" alt="random-gif" width="500px">
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endsection