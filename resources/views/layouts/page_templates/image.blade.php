<div class="card pub_image rounded-0">
    <div class="card-header">
        <!-- If user has image, show it, if not, show default -->
        @if($image->user->image)
        <div class="container-avatar">
            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
        </div>
        @else
        <div class="container-avatar">
            <img src="{{ asset('material/img/default.jpg') }}" class="avatar" />
        </div>
        @endif
        <div class="data-user">
            <a href="{{ route('profile.show',['id'=>$image->user->id]) }}">
                <span class="nickname">
                    {{ $image->user->nick }}
                </span>
            </a>
        </div>

        <!-- Show "More options" if you are owner of this image or your role is admin -->
        @if(Auth::user()->id == $image->user_id || Auth::user()->role == 'admin')
        <ul class="navbar-nav">

            <li class="nav-item dropdown">
                <a class="nav-link nav-mini" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg aria-label="Moreoptions" class="delete-option" color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
                        <circle cx="12" cy="12" r="1.5"></circle>
                        <circle cx="6" cy="12" r="1.5"></circle>
                        <circle cx="18" cy="12" r="1.5"></circle>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item" href="{{ route('image.edit', ['id' => $image->id]) }}">{{ __('Edit') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item  hover-delete" href="{{ route('image.delete', ['id' => $image->id]) }}">{{ __('Delete') }}</a>
                </div>
            </li>
        </ul>
        @endif
    </div>

    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" />
        </div>
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
            <div class="like-count ml-2 font-weight-bold">
                {{ $image->likes->count() }} Likes
            </div>
        </div>
        <div class="desc ml-3">
            <a href="{{ route('profile.show', ['id' => $image->user->id]) }}">
                <span class="nickname nick-underline">
                    {{$image->user->nick}}
                </span>
            </a>
            <span class="description ml-1">
                {{$image->description}}
            </span>

        </div>

        <!-- If count comments more than 0 -->
        @if($image->comments()->count() > 0)
        <div id="view-comments" class="ml-3">
            <a href="{{ route ('image.detail', ['id' => $image->id])}}">
                <span>View {{count($image->comments)}} comments</span>
            </a>
        </div>
        @endif

        <!-- Date when the picture was uploaded -->
        <div class="date ml-3 mb-3">
            <span id="date-text">
                {{ \FormatTime::LongTimeFilter($image->created_at) }}
            </span>
        </div>
    </div>
</div>