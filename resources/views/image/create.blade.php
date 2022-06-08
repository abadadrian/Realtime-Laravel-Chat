@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Upload Image')])

@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Upload</h1>
                <div class="row justify-content-center">
                    <div class="col-md-12">
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
                                    º @endif

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
                                    <div class="card-footer justify-content-center">
                                        <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
