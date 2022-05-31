@extends('layouts.app', [ 'titlePage' => __('User Profile')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="notification" class="alert mx-3  invisible fade show"></div>

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Edit') }}</h4>
                        <p class="card-category">{{ __('Edit your image') }}</p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('image.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}" />
                            <div class="row">
                                <label for="image_path" class="col-sm-2 col-form-label">{{ __('Profile Image') }}</label>
                                <div class="col-sm-7">
                                    <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="avatar" style="width:30rem; float:left; object-fit: contain;" />
                                    <input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" />
                                </div>
                            </div>
                            @if ($errors->has('image_path'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image_path') }}</strong>
                            </span>
                            @endif

                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                <div class="col-sm-7">
                                    <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $image->description}}</textarea>
                                </div>
                            </div>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection