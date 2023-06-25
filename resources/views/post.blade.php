@extends('layouts.main')
@section('container')

    <div class="container p-3 mb-3 d-flex justify-content-center">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1> 
                <small >Created By. {{ $post->author->name }}</small>
                @if ($post->image)
                <div style="max-height: 400px; overflow:hidden" class="mt-3">
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}">
                </div>
                @endif
                <article class="my-2">
                    {!! $post->body !!}
                </article>

                <div style="background-color: #682B57; width : 50%; padding:10px; border-radius:30px; text-align:center;height:3em;line-height:1.5em;cursor:pointer" onclick="location.href='/{{$post->slug}}/daftar'" class="ngembang">
                    <a href="/{{$post->slug}}/daftar" style="color:white;text-decoration:none;font-size:1.5em;">Daftar Sebagai Pengurus</a>
                </div>
                
            </div>
        </div>
    </div>
    
@endsection