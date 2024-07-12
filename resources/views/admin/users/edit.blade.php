@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('user-edit', $user) }}
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit User {{ $user->name }}</h1>
    </div>
    <hr>
    <div class="">
        <form action="{{ route('admin.users.update',['user' => $user]) }}" method="POST">
            @csrf
            @method('put')
            <div class=" mb-3">
                <label class="form-label" for="name">Nama User</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" name="name" value="{{ $user->name ?? old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class=" mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" name="email" value="{{ $user->email ?? old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="">
                <div class="alert alert-info alert-dismissible fade show">
                    <div class="alert-heading d-flex justify-content-between">
                        <div class="d-flex">
                            <img width="20px" data-feather="info" class="m-0 p-0 me-2"></img>
                            <p class="m-0 p-0">Perhatian</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <hr>  
                    <p class="m-0 p-0">Kolom password tidak perlu diisi jika tidak ingin mengganti password.</p>
                </div>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="" name="password" value="">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class=" mb-3">
                <label class="form-label" for="password_confirmation">Ulangi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="" name="password_confirmation" value="">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class=" mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" aria-label="Default select example" name="role">
                    <option selected>Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @selected($role->name == $user->getRoleNames()[0])>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary header1 "><i data-feather="save"></i> Simpan</button>
            <button type="submit" class="btn btn-pri
        </form>
    </div>
@endsection

