@extends('dashboard.layouts.main')
@section('container')

<div class="col-lg-8 mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h7 class="mb-0">General</h7>
                </div>
            </div>
            <hr>
                
            <form action="/dashboard/organization" method="POST">
                @csrf
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Nama Organisasi</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" id="name" >
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Username</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" id="username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email Narahubung</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control @error('email') is-invalid @enderror"name="email" id="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection