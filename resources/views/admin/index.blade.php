@extends('layouts.app', [ 'titlePage' => __('User Profile')])

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
    <div class="col-md-12">
      <!-- Table -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col"><b>Avatar</b></th>
            <th scope="col"><b>Name</b></th>
            <th scope="col"><b>Surname</b></th>
            <th scope="col"><b>Nick</b></th>
            <th scope="col"><b>Description</b></th>
            <th scope="col"><b>Email</b></th>
            <th scope="col"><b>Role</b></th>
            <th scope="col"><b>Options</b></th>
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
            <td>{{$user->name}} </td>
            <td>{{$user->surname}} </td>
            <td>{{$user->nick}} </td>
            <td>{{$user->description}} </td>
            <td>{{$user->email}} </td>
            <td>{{$user->role}}</td>

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
            <td colspan="7" class>No hay miembros dados de alta</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      {{$users->links("pagination::bootstrap-4")}}
    </div>
    @endsection