@extends('dashboard.layouts.main')
@section('container')

<div class="col-lg-8 mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <h7 class="mb-0"> General</h7>
                </div>
            </div>
            <hr>
                
            <form action="/dashboard/profile/general" method="POST">
                @method('PUT')
                @csrf
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',auth()->user()->name) }}" name="name" id="name" >
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
                    <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username',auth()->user()->username) }} " name="username" id="username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',auth()->user()->email) }}" name="email" id="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

    <div class="col-lg-8 mt-5">
        <div class="card">  
            <div class="card-body">
                <form action="/dashboard/profile/password" method="post">
                @method('put')
                @csrf
                
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <span data-feather="key" class="align-text-bottom"></span><h7 class="mb-0"> Change Password</h7>
                        <p class=" text-muted">It's a good idea to use a strong password that you're not using elsewhere</p>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Current Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" class="form-control @error('current') is-invalid @enderror" name="current" >
                        @error('current')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (session()->has('incorrect'))
                        <p class="text-danger">
                            {{ session('incorrect') }}  
                        </p>                         
                        @endif
                        
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">New Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" class="form-control @error('new') is-invalid @enderror" name="new" >
                        @error('new')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Re-type New Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" class="form-control @error('re') is-invalid @enderror" name="re">
                        @error('re')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        @if (session()->has('different'))
                        <p class="text-danger">
                            {{ session('different') }}  
                        </p>                         
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
@endsection