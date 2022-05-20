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
            <div class="col-md-12">
                <h1>My favorites posts</h1>

                @foreach($likes as $like)
                @include('layouts.page_templates.image', ['image' => $like->image])
                @endforeach

            </div>
        </div>
    </div>
    @endsection