@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])


@push('styles')
<style type="text/css">
    #users>li {
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<div class="content">
    <div id="notification" class="alert mx-1  invisible fade show"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($images as $image)
                <!-- Image Card Include -->
                    @include('layouts.page_templates.image', ['image' => $image])
                @endforeach

            </div>
        </div>
    </div>
    @endsection