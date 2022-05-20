@extends('layouts.app', [ 'titlePage' => __('User Profile')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div id="notification" class="alert mx-3  invisible fade show"></div>

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Upload') }}</h4>
                        <p class="card-category">{{ __('Upload an image') }}</p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/image/store" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <label class="col-sm-2 col-form-label">{{ __('Image') }}</label>
                                <div class="col-sm-7">
                                    <input id="image_path" type="file" class="form-control" name="image_path" />
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
                                    <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" placeholder="Insert a caption."></textarea>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection