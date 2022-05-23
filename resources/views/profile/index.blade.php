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
                <h1>People</h1>
                @foreach($users as $user)
                <h1>{{$user->name}}</h1>
                @endforeach
            </div>
        </div>
    </div>
    @endsection