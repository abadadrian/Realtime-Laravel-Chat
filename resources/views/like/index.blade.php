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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Liked posts</h1>
                <!-- If $user->id count likes > 0 -->
                @if ($likes->count() > 0)
                <!-- Loop $likes and show your liked images -->
                @foreach($likes as $like)
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ route('image.file',['filename'=>$like->image->image_path]) }}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $like->image->title }}</h5>
                                <p class="card-text">{{ $like->image->description }}</p>
                                <p class="card-text"><small class="text-muted">{{ $like->image->created_at }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- If user dont has liked posts -->
                @else
                <div class="alert alert-primary">
                    <p>You don't have any liked posts</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection