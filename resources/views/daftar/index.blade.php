@extends('layouts.main')
@section('container')
<div class="container mb-5">
  <h1>Halaman Daftar  {{ $post->title }}</h1>
  
  <form method="POST" action="/{{ $post->slug }}/daftar">
      @csrf
  
      @foreach ($questions as $question)
      <div class="mb-3">
        
        <label for="nama" class="form-label">{{ $question->pertanyaan }}</label>
        <input type="text" name="jawaban[]" class="form-control @error('jawaban') is-invalid @enderror" required id="jawaban" value="{{ old('jawaban') }}">
        @error('jawaban')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      @endforeach
      
     
      <button type="submit" class="btn btn-lg btn-primary ngembang">Daftar</button>
    </form>

</div>
@endsection
