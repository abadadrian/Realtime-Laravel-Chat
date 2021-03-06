@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('People')])


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
                <div class="col-1">
                    <a href="{{ route('profile.index')}}">
                        <h1 class="no-link">People</h1>
                    </a>
                </div>
                <!-- If there is any user   -->
                @if(count($users) > 0)
                @foreach($users as $user)
                <!-- User profile card -->
                <a href="{{ route('profile.show', $user->id) }}">
                    <div class="card mb-4">
                        <div class="card-body" id="card-people">
                            <div class="row row-custom">
                                <div class="col-lg-2 col-md-12" id="imagen-people">
                                    <!-- If user has image, show it, if not, show default -->
                                    @if($user->image)
                                    <img class="img-profile-people" src="{{ route('user.avatar',['filename'=>$user->image]) }}" alt="">
                                    @else
                                    <img class="img-profile-people" src="{{ asset('material/img/default.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-10 col-md-12" id="nick-people">
                                    <h3><strong>{{ $user->nick }}</strong></h3>
                                    <h5>{{ $user->name }} {{ $user->surname }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="alert alert-primary">
                    <strong>No users found</strong>
                </div>
                @endif
                {{$users->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
</div>
@endsection