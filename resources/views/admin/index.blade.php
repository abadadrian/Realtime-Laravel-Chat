@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Admin Dashboard')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <h1>Admin Panel - Users</h1>
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

    <!-- Table -->
    <table class="table table-hover col-md-12">
      <thead>
        <tr>
          <th scope="col" id="avatar-table"><b>Avatar</b></th>
          <th scope="col" id="name-table"><b>Name</b></th>
          <th scope="col" id="surname-table"><b>Surname</b></th>
          <th scope="col" id="nick-table"><b>Nick</b></th>
          <th scope="col" id="description-table"><b>Description</b></th>
          <th scope="col" id="email-table"><b>Email</b></th>
          <th scope="col" id="role-table"><b>Role</b></th>
          <th scope="col" id="options-table"><b>Options</b></th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <th scope="row">
            <!-- If user has image, show it, if not, show default -->
            @if($user->image)
            <img class="img-profile-medium" src="{{ route('user.avatar',['filename'=>$user->image]) }}" alt="">
            @else
            <img class="img-profile-medium" src="{{ asset('material/img/default.jpg') }}" alt="">
            @endif
          </th>
          <td id="name-table">{{'@'. $user->nick}} </td>
          <td id="surname-table">{{$user->surname}} </td>
          <td id="nick-table">{{$user->nick}} </td>
          <td id="description-table">{{$user->description}} </td>
          <td id="email-table">{{$user->email}} </td>
          <td id="role-table">{{$user->role}}</td>

          <td>
            <a href="{{ route('admin.user.show',  ['id' => $user->id])}}" class="btn btn-info btn-sm">
              <i class="material-icons">visibility</i>
            </a>
            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-info btn-sm">
              <i class="material-icons">edit</i>
            </a>
            <form method="GET" action="{{ route('admin.user.delete', ['id' => $user->id]) }}" enctype="multipart/form-data" style="display: contents;">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="material-icons">delete</i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class>No users registered yet.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    {{$users->links("pagination::bootstrap-4")}}
    @endsection