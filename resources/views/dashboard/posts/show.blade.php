@extends('dashboard.layouts.main')
@section('container')
<div class="container">
    <div class="row  mb-5">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $post->title }}</h1> 
            <small>Created By. {{ $post->author->name }}</small>

            @if ($post->image)
            <div style="max-height: 400px; overflow:hidden">
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}">
            </div>
            @endif
            <article class="my-3">
                {!! $post->body !!}
            </article>
            <a href="/dashboard/posts" class="btn btn-success">Back to Posts</a>
        </div>
    </div>
</div>

@endsection