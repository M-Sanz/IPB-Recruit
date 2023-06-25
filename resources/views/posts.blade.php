
@extends('layouts.main')
@section('container')
    <h1 class="text-center text-dark heading1">{{ $title }}</h1>
    <h2 class="heading2 text-center">Ilmu Komputer | IPB University</h2>

    @if ($posts->count())

    <div class="container mt-5 ">
        <div class="row">
            @foreach($posts as $post)
            
              <div class="posts mt-3 ngembang" onclick="location.href='/organisasi/{{ $post->slug }}'" style="cursor: pointer">
                <a class=" text-decoration-none heading2" href="/organisasi/{{ $post->slug }}">{{ $post->title }}</a>
              </div>    
              <div class="daftar_btn mt-3 ngembang" onclick="location.href='/{{$post->slug}}/daftar'" style="cursor: pointer">
                <a class="text-decoration-none heading2" href="/{{$post->slug}}/daftar">Daftar</a>
              </div>    
            @endforeach
        </div>
    </div>
    @else 
    <p class="text-center fs-4">No Post Found</p> 
    @endif
@endsection
