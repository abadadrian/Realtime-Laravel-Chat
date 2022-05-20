<div class="card pub_image rounded-0">
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
        <!-- Show svg if you are owner of this image or your role is admin -->
        @if(Auth::user()->id == $image->user_id || Auth::user()->role == 'admin')
        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="delete-option">
            <svg aria-label="Delete" color="#262626" fill="#262626" height="16" role="img" viewBox="0 0 24 24" width="16">
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="2.876" x2="21.124" y1="4.727" y2="4.727"></line>
                <path d="M8.818 4.727v-1.59A1.136 1.136 0 019.954 2h4.092a1.136 1.136 0 011.136 1.136v1.591" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                <path d="M4.377 4.727l1.987 15.88A1.59 1.59 0 007.942 22h8.116a1.59 1.59 0 001.578-1.393l1.987-15.88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
        </a>
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
            <span class="nickname">
                {{$image->user->nick}}
            </span>
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