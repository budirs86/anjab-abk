@extends('login.layouts.main')

@section('container')
    <div class="bg-light">
        <div class="container card  col-4 p-3">
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <small>{{ session('loginError') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-start text-center">
                <img src="/assets/undip-logo.svg" width="200" class="" alt="">
                <div class="d-flex flex-column my-3">
                    {{-- <h1 class="card-title display-6">Anjab ABK</h1> --}}
                    <p class="">Selamat datang di Aplikasi Anjab ABK <br> Universitas Diponegoro</p>
                    <p>Silakan Login untuk melanjutkan</p>
                </div>
                
            </div>
            
    
            <form action="" method="POST" class="d-flex flex-column ">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                    <label for="email" >Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" >
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary header1">Masuk</button>
            </form>
        </div>

    </div>
    
@endsection
