@extends('layouts.main')
@section('container')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Halaman Registrasi</title>
    </head>
    <body>
        <div class="container " style="margin-top: 15%">
            <div class="row justify-content-center d-flex" >
                <div class="col-md-6 p-3 justify-content-end d-flex" >
                    <div class="card d-inline-block border-primary ngembang" style="width: 18rem;cursor: pointer;"  onclick="location.href='register/mahasiswa'">
                        <div class="card-body p-7" for="mahasiswa" style="text-align: center">
                          <h1 class="card-title text-center">Mahasiswa</h1>
                          <a href="register/mahasiswa" class="card-link" id="mahasiswa" style="margin: auto">Register as Student</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-6 p-3 justify-content-start d-flex" >
                    <div class="card d-inline-block border-primary ngembang" style="width: 18rem; cursor: pointer;" onclick="location.href='register/organisasi'">
                        <div class="card-body p-6" style="text-align: center">
                          <h1 class="card-title">Organisasi</h1>
                          <a href="register/organisasi" class="card-link">Register as organization</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </body>
    </html>
@endsection