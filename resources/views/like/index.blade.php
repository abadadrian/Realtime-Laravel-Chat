@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Liked Posts')])


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
            </div>
        </div>
    </div>
    <!-- If $user->id count likes > 0 -->
    <div class="container">
        @if ($likes->count() > 0)
        <div class="row justify-content-center">
            <!-- Loop $likes and show your liked images -->
            @foreach($likes as $like)
            <div class="col-sm image-box mb-5">
                <div class="image-box">
                    <a class="image-box gallery-item m-0" href="{{ route('image.detail', $like->image->id) }}">
                        <img class="image-box" src="{{ route('image.file',['filename'=>$like->image->image_path]) }}" alt="Card image cap">
                        <div class="gallery-item-info">
                            <ul>
                                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span>
                                    <!-- Heart -->
                                    <svg aria-label="Favorites" class="_8-yf5 " color="#fff" fill="#fff" height="24" role="img" viewBox="0 0 24 24" width="24">
                                        <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z" fill="#fff"></path>
                                    </svg>
                                    {{ $like->getLikes($like->image_id) }}
                                </li>
                                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span>
                                    <!-- Comment -->
                                    <svg aria-label="Chat" color="#fff" fill="#fff" height="24" role="img" viewBox="0 0 24 24" width="24">
                                        <path id="chat-svg" d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg>
                                    {{ $like->getComments($like->image_id) }}
                                </li>
                            </ul>
                        </div>
                    </a>
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