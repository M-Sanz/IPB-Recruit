@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $form->post->title}}</h1>
</div>

<div class="col-md-8">
  <div class="card mb-3">
    <div class="card-body">
   
      @foreach ($questions as $question)
      <div class="row">
        <div class="col-sm-3">
          <h6 class="mb-0">{{ $question->pertanyaan }}</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {{ $answers[$nomor++] }}
        </div>
      </div>
      <hr>
      @endforeach
  
          <form action="/konfirmasi/accept/{{ $form->id }}" method="POST" class=" d-inline">
            @method('put')
            @csrf
            <button class="btn btn-success">Terima</button>
          </form>

          <form action="/konfirmasi/reject/{{ $form->id }}" method="POST" class=" d-inline">
            @method('put')
            @csrf
            <button class="btn btn-danger">Tolak</button>
          </form> 

    </div>
  </div>

@endsection



