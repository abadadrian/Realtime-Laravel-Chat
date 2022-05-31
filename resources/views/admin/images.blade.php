@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Admin Dashboard Images')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <h1>Admin Panel - Images</h1>
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
            <th scope="col"><b>Image</b></th>
            <th scope="col"><b>Uploaded by</b></th>
            <th scope="col"><b>Description</b></th>
            <th scope="col"><b>Likes</b></th>
            <th scope="col"><b>Comments</b></th>
            <th scope="col"><b>Uploaded at</b></th>
            <th scope="col"><b>Updated at</b></th>
            <th scope="col"><b>Options</b></th>
          </tr>
        </thead>
        <tbody>
          @forelse($images as $image)
          <tr>
            <th scope="row">
              <!-- Show the image -->
              <img class="img-medium" src="{{ route('image.file',['filename'=>$image->image_path]) }}" alt="">
            </th>
            <td>{{'@'. $image->user->nick}} </td>
            <td>{{$image->description}} </td>
            <td>{{$image->likes->count()}} </td>
            <td>{{$image->comments->count()}} </td>
            <td> {{ \FormatTime::LongTimeFilter($image->created_at) }} </td>
            <td> {{ \FormatTime::LongTimeFilter($image->updated_at) }} </td>

            <td>
                <a href="{{ route('admin.image.show', ['id' => $image->id]) }}" class="btn btn-info btn-sm">
                  <i class="material-icons">visibility</i>
                </a>
                <a href="{{ route('admin.image.edit', ['id' => $image->id]) }}" class="btn btn-info btn-sm">
                  <i class="material-icons">edit</i>
                </a>
              <form method="GET" action="{{ route('admin.image.delete', ['id' => $image->id]) }}" enctype="multipart/form-data" style="display: contents;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="material-icons">delete</i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class>No hay iagenes dadas de alta</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      {{$images->links("pagination::bootstrap-4")}}
    </div>
    @endsection