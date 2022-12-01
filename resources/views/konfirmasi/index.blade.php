@extends('layouts.main')
@section('container')
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@can('student')
@foreach ($forms as $form)
    @if ($form->status == 0)
    <div class="posts mt-3 ">
        Formulir pendaftaran  {{ $form->post->title }} dalam proses pengajuan
      </div>   
    @endif
    @if ($form->status == 1)
    <div class="posts mt-3 ">
        Formulir pendaftaran  {{ $form->post->title }} telah diverifikasi
      </div>  
    @endif
    @if ($form->status == 2)
    <div class="posts mt-3 ">
        Formulir pendaftaran  {{ $form->post->title }} ditolak
      </div>  
    @endif
@endforeach
@endcan

@can('organization')

@foreach ($forms as $form)
    <div class="posts mt-3 ngembang" onclick="location.href='/konfirmasi/{{ $form->id }}'" style="cursor: pointer">
        <a class=" text-decoration-none text-dark" href="/konfirmasi/{{ $form->id }}">Formulir pendaftaran {{ $form->post->title }} dari {{ $form->user->name }}</a>   
    </div> 
@endforeach

@endcan

@can('admin')
@foreach ($organizations as $organization)
    <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama Organisasi</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $organization->name }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Username</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $organization->username }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $organization->email }}
              </div>
            </div>
            <hr>
            
            <form action="/konfirmasi/organisasi/accept/{{ $organization->id }}" method="POST" class=" d-inline">
                @method('put')
                @csrf
                <button class="btn btn-success">Terima</button>
            </form>
            <form action="/konfirmasi/organisasi/reject/{{ $organization->id }}" method="POST" class=" d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger">Tolak</button>
            </form> 
          </div>
        </div>
      
@endforeach
    
@endcan


@endsection
