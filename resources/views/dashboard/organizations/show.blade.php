@extends('dashboard.layouts.main')
@section('container')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $user->name }}</h1>
</div>
@if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>  
@endif
@if (session()->has('passchanged'))
            <div class="alert alert-success" role="alert">
                {{ session('passchanged') }}
            </div>  
@endif
<div class="col-md-8">
  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-3">
          <h6 class="mb-0">Full Name</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {{ $user->name }}
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <h6 class="mb-0">Username</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {{ $user->username }}
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <h6 class="mb-0">Email</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {{ $user->email }}
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-3">
          <h6 class="mb-0">Account</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          {{ $user->role }}
        </div>
      </div>
      <hr>
      
      <div class="row">
        <div class="col-sm-12">
          <a class="btn btn-info "  href="/dashboard/organization/{{ $user->id }}/edit" >Edit</a>
        </div>
      </div>
    </div>
  </div>

@endsection