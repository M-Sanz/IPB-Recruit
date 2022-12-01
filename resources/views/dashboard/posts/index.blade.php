@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Post</h1>
</div>
@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
 {{ session('success')}}
</div>
@endif

<div class="table-responsive col-lg-8 ">
  <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>
              <a href="/dashboard/posts/{{ $post->id }}" class="badge bg-info"><span data-feather="eye" ></span></a>
              <a href="/dashboard/posts/{{ $post->id }}/edit" class="badge bg-success"><span data-feather="edit" ></span></a>
              <form action="/dashboard/posts/{{ $post->id }}" method="post" class=" d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Yakin?')">
                  <span data-feather="trash-2" ></span>
                </button>
              
              </form>
            </td>
          </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>

@endsection