@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])


@push('styles')
<style type="text/css">
    #users>li {
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<header>

    <div class="container">

        <div class="profile">

            <div class="profile-image">

                <img class="img-gallery" src="{{ route('user.avatar',['filename'=>$user->image]) }}" alt="">

            </div>

            <div class="profile-user-settings">

                <h1 class="profile-user-name">{{ $user->nick }}</h1>

                <a href="{{ route('profile.edit') }}" class="btn-show profile-edit-btn">Edit Profile</a>


            </div>

            <div class="profile-stats">
                <ul>
                    <li><span class="profile-stat-count">{{ $user->images->count() }}</span> posts</li>
                </ul>

            </div>

            <div class="profile-bio">

                <p><span class="profile-real-name">{{ $user->name }} {{ $user->surname }}</span></p>
                <!-- Show user description -->
                <p>{{ $user->description }}</p>

            </div>

        </div>
        <!-- End of profile section -->

    </div>
    <!-- End of container -->

</header>

<main>

    <div class="container">

        <div class="gallery">

            @foreach($user->images as $image)
            <div class="gallery-item" tabindex="0">

                <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="gallery-image" alt="">

                <div class="gallery-item-info">

                    <ul>
                        <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span> <img src="{{ asset('material/img/like-red.svg') }}" data-id="{{$image->id}}" class="btn-like-profile" />
                            <span class="likes-count">{{ $image->likes->count() }}</span>
                        </li>
                        <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span> <svg aria-label="Comment" class="post-button" color="#fff" fill="#fff" height="24" role="img" viewBox="0 0 24 24" width="24">
                                <path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                            <span class="comment-count">{{ $image->comments->count() }}</span>
                        </li>
                    </ul>

                </div>

            </div>
            @endforeach

        </div>
        <!-- End of gallery -->


    </div>
    <!-- End of container -->

</main>
@endsection