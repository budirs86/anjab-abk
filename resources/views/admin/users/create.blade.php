@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('user-create') }}
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Tambah User </h1>
    </div>
    <hr>
    <div class="">
        <form action="{{ route('admin.users.store',) }}" method="POST">
            @csrf
            <div class=" mb-3">
                <label class="form-label" for="name">Nama User</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class=" mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="" name="password_confirmation">
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
                        <option value="{{ $role->name }}" @selected($role->name == old('role'))>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary header1 "><i data-feather="plus"></i> Tambah</button>
        </form>
    </div>
@endsection

