@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Admin Dashboard User Edit')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.user.update', ['id' => $user->id]) }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Edit Profile') }}</h4>
              <p class="card-category">{{ __('User information') }}</p>
            </div>
            <div class="card-body ">
              @if (session('status'))
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status') }}</span>
                  </div>
                </div>
              </div>
              @endif
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Profile Image') }}</label>
                <div class="col-sm-7">

                  <!-- Link to delete user image and parameter user id -->
                  <li class="nav-item dropdown">
                    <a class="nav-link mb-1" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- If user has image, show it, if not, show default -->
                      @if($user->image)
                      <div class="container-avatar delete-image">
                        <img src="{{ route ('user.avatar', ['filename'=>$user->image]) }}" class="img-profile-edit">
                      </div>
                      @else
                      <div class=" container-avatar delete-image">
                        <img src="{{ asset('material/img/default.jpg') }}" class="img-profile-edit" />
                      </div>
                      @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownProfile">
                      <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path" placeholder="{{ __('image_path') }}" />
                      <a class="dropdown-item" href="" id="upload_link">{{ __('Replace Image') }}</a>
                      <a class="dropdown-item hover-delete" href="{{ route('profile.image.delete', ['id'=>Auth::user()->id])  }}">{{ __('Delete Image') }}</a>
                    </div>
                  </li>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                    <!-- Select for choose user or admin -->
                    <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" id="role">
                      <optgroup label="Choose a role">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                    </select>

                    <!-- Visible select -->

                    @if ($errors->has('role'))
                    <span id="role-error" class="error text-danger" for="input-role">{{ $errors->first('role') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required="true" aria-required="true" />
                    @if ($errors->has('name'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Surname') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="surname" placeholder="{{ __('surname') }}" value="{{ old('surname', $user->surname) }}" required />
                    @if ($errors->has('surname'))
                    <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Nickname') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('nick') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" id="input-nick" type="nick" placeholder="{{ __('nick') }}" value="{{ old('nick', $user->nick) }}" required />
                    @if ($errors->has('nick'))
                    <span id="nick-error" class="error text-danger" for="input-nick">{{ $errors->first('nick') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required />
                    @if ($errors->has('email'))
                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" type="description" placeholder="{{ __('description') }}" value="{{ old('description', $user->description) }}" required />
                    @if ($errors->has('description'))
                    <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Change password') }}</h4>
              <p class="card-category">{{ __('Have you forgotten your password? You can change it here') }}</p>
            </div>
            <div class="card-body ">
              @if (session('status_password'))
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status_password') }}</span>
                  </div>
                </div>
              </div>
              @endif
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                    @if ($errors->has('old_password'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                    @if ($errors->has('password'))
                    <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="notification" class="alert mx-3  invisible fade show"></div>

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Delete Account') }}</h4>
            <p class="card-category">{{ __('Are you sure? You cant undo this action.') }}</p>
          </div>

          <div class="card-body">
            <form method="GET" action="{{ route ('profile.delete', ['id' => Auth::user()->id])}}" enctype="multipart/form-data">
              @csrf
              <div class="card-footer justify-content-center">
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection