<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="/home">
        <img src="{{ asset('material/img/logo-chatinity-negro.svg') }}" style="width: 24px; height:24px;" />
        Chatinity
      </a>
    </div>
    <button class="navbar-toggler" data-target="#navbar" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbar">

      <ul class="navbar-nav">
        <li class="nav-item search-nav">
          <form class="navbar-form" id='search' method="GET" action="{{ route('profile.index') }}">
            <div class="input-group no-border">
              <input type="text" id='search-input' class="form-control" placeholder="Search">
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <svg aria-label="Search" class="search-button" color="#262626" fill="#262626" height="16" role="img" viewBox="0 0 24 24" width="16">
                  <path d="M19 10.5A8.5 8.5 0 1110.5 2a8.5 8.5 0 018.5 8.5z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="16.511" x2="22" y1="16.511" y2="22"></line>
                </svg>
                <div class="ripple-container"></div>
              </button>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route ('home')}}" aria-haspopup=" true" aria-expanded="false">
            <svg aria-label="Home" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
              <path d="M9.005 16.545a2.997 2.997 0 012.997-2.997h0A2.997 2.997 0 0115 16.545V22h7V11.543L12 2 2 11.543V22h7.005z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <p class="d-lg-none d-md-block nav-text">
              {{ __('Home') }}
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/upload" aria-haspopup=" true" aria-expanded="false">
            <svg aria-label="Upload" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
              <path d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552zM6.545 12.001h10.91M12.003 6.545v10.91" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
            <p class="d-lg-none d-md-block nav-text">
              {{ __('Upload') }}
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route ('likes')}}" aria-haspopup=" true" aria-expanded="false">
            <svg aria-label="Favorites" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
              <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z"></path>
            </svg>
            <p class="d-lg-none d-md-block nav-text">
              {{ __('Favorites') }}
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/people" aria-haspopup=" true" aria-expanded="false">
            <svg aria-label="People" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
              <circle cx="12.004" cy="12.004" fill="none" r="10.5" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></circle>
              <path d="M18.793 20.014a6.08 6.08 0 00-1.778-2.447 3.991 3.991 0 00-2.386-.791H9.38a3.994 3.994 0 00-2.386.791 6.09 6.09 0 00-1.779 2.447" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path>
              <circle cx="12.006" cy="9.718" fill="none" r="4.109" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></circle>
            </svg>
            <p class="d-lg-none d-md-block nav-text">
              {{ __('People') }}
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="/chat" aria-haspopup="true" aria-expanded="false">
            <svg aria-label="Chat" color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
              <path id="chat-svg" d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <p class="d-lg-none d-md-block nav-text">
              {{ __('Chat') }}
            </p>
          </a>
        </li>
        <!-- Show the settings of admin if the auth user role is admin -->
        @if(Auth::user()->role == 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link" href="" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg aria-label="Admin" class="_8-yf5 " color="#262626" fill="#262626" role="img" viewBox="0 0 24 24" width="24" height="24">
              <circle cx="12" cy="12" fill="none" r="8.635" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
              <path d="M14.232 3.656a1.269 1.269 0 01-.796-.66L12.93 2h-1.86l-.505.996a1.269 1.269 0 01-.796.66m-.001 16.688a1.269 1.269 0 01.796.66l.505.996h1.862l.505-.996a1.269 1.269 0 01.796-.66M3.656 9.768a1.269 1.269 0 01-.66.796L2 11.07v1.862l.996.505a1.269 1.269 0 01.66.796m16.688-.001a1.269 1.269 0 01.66-.796L22 12.93v-1.86l-.996-.505a1.269 1.269 0 01-.66-.796M7.678 4.522a1.269 1.269 0 01-1.03.096l-1.06-.348L4.27 5.587l.348 1.062a1.269 1.269 0 01-.096 1.03m11.8 11.799a1.269 1.269 0 011.03-.096l1.06.348 1.318-1.317-.348-1.062a1.269 1.269 0 01.096-1.03m-14.956.001a1.269 1.269 0 01.096 1.03l-.348 1.06 1.317 1.318 1.062-.348a1.269 1.269 0 011.03.096m11.799-11.8a1.269 1.269 0 01-.096-1.03l.348-1.06-1.317-1.318-1.062.348a1.269 1.269 0 01-1.03-.096" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <p class="d-lg-none d-md-block nav-text">
              {{ __('Admin Settings') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('admin.users')}}">{{ __('Users') }}</a>
            <a class="dropdown-item" href="{{ route('admin.images') }}">{{ __('Images') }}</a>
          </div>
        </li>

        @endif
        <li class="nav-item dropdown">
          <a class="nav-link mb-1" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!-- If user has image, show it, if not, show default -->
            @if(auth()->user()->image)
            <div class="container-avatar">
              <img src="{{ route ('user.avatar', ['filename'=>Auth::user()->image]) }}" class="img-profile-mini">
            </div>
            @else
            <div class="container-avatar">
              <img src="{{ asset('material/img/default.jpg') }}" class="img-profile-mini" />
            </div>
            @endif
            <p class="d-lg-none d-md-block nav-text">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.show', ['id'=>Auth::user()->id]) }}">{{ __('My Profile') }}</a>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit My Profile') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item hover-delete" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>