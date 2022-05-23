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
    <div class="container-fluid">
        <div class="card pub_image_detail rounded-0">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="image-detail-container">
                        <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" />
                    </div>
                </div>
                <div class="col-md-6 pub_image">
                    <div class="card-header">
                        @if($image->user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
                        </div>
                        @endif
                        <div class="data-user">
                            <span class="nickname">
                                {{ $image->user->nick }}
                            </span>
                        </div>
                        <!-- Show "More options" if you are owner of this image or your role is admin -->
                        @if(Auth::user()->id == $image->user_id || Auth::user()->role == 'admin')
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(auth()->user()->image)
                                    <svg aria-label="Moreoptions" class="delete-option" color="#262626" fill="#262626" height="24" width="24" role="img" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="1.5"></circle>
                                        <circle cx="6" cy="12" r="1.5"></circle>
                                        <circle cx="18" cy="12" r="1.5"></circle>
                                    </svg> @endif
                                    <p class="d-lg-none d-md-block">
                                        {{ __('More options') }}
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="{{ route('image.edit', ['id' => $image->id]) }}">{{ __('Edit') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('image.delete', ['id' => $image->id]) }}">{{ __('Delete') }}</a>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </div>
                    @if(Auth::user()->id == $image->user_id || Auth::user()->role == 'admin')
                    <hr style="margin-top: 0;">
                    @else
                    <hr style="margin-top: 2rem;">
                    @endif
                    <div class="card-body">
                        <div class="desc-detail">
                            @if($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
                            </div>
                            @endif
                            <div class="data-user-detail">
                                <span class="nickname">
                                    {{ $image->user->nick }}
                                </span>
                            </div>
                            <span class="description ml-1 mt-1">
                                {{$image->description}}
                            </span>
                        </div>
                        <!-- Date when the picture was uploaded -->
                        <div class="date ml-3 mb-4">
                            <span id="date-text">
                                {{ \FormatTime::LongTimeFilter($image->created_at) }}
                            </span>
                        </div>
                        <!-- List of comments -->
                        @foreach($image->comments as $comment)
                        <div class="desc-detail">
                            @if($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar',['filename'=>$comment->user->image]) }}" class="avatar" />
                            </div>
                            @endif
                            <div class="data-user-detail">
                                <span class="nickname">
                                    {{ $comment->user->nick }}
                                </span>
                            </div>
                            <div class="description ml-1 mt-1">
                                {{$comment->content}}
                            </div>
                        </div>
                        <!-- Date when the comment was posted -->
                        <div class="date-detail mt-1 ml-3 mb-4">
                            <span id="date-text">
                                {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                <!-- Delete Button -->
                                <a href="{{ route('comment.destroy',['id'=>$comment->id]) }}" class=" ml-1">
                                    Delete
                                </a>
                                @endif
                            </span>

                        </div>
                        <div class="clearfix"></div>
                        @endforeach

                        <div class="likes-comments ml-2 mt-4">
                            <!-- Check if user liked the image -->
                            <?php $user_like = false; ?>
                            @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                            <?php $user_like = true; ?>
                            @endif
                            @endforeach

                            @if($user_like)
                            <img src="{{ asset('material/img/like-red.svg') }}" data-id="{{$image->id}}" class="btn-dislike" />
                            @else
                            <img src="{{ asset('material/img/like-outline.svg') }}" data-id="{{$image->id}}" class="btn-like" />
                            @endif

                            <a href="{{ route ('image.detail', ['id' => $image->id])}}">
                                <svg aria-label="Comment" class="post-button" color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
                                    <path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </a>
                            <!-- Likes counter -->
                            <div class="ml-2 font-weight-bold">
                                {{ $image->likes->count() }} Likes
                            </div>
                        </div>
                        <!-- Date when the picture was uploaded -->
                        <div class="date ml-3 mb-3">
                            <span id="date-text">
                                {{ \FormatTime::LongTimeFilter($image->created_at) }}
                            </span>
                        </div>
                        <!-- Comments Form -->
                        <div class="comments">
                            <!-- Form to write comments in the image -->
                            <form class="form-inline" id="comment-form" method="POST" action="{{ route ('comment.store')}}">
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <div class="form-group mb-2">
                                    <!-- Input with the user nick in the placeholder -->
                                    <input type="text" class="form-control" id="comment" name="content" placeholder="Add a comment as {{ Auth::user()->nick }} ..." required>
                                </div>
                                <button type="submit" class="rounded-pill btn btn-outline-primary  mb-2">Post</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection