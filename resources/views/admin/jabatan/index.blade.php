@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('jabatan-dashboard') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Atur Jabatan Referensi</h1>
    </div>
    <hr>
    <div class="mb-3">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Silahkan atur jabatan referensi yang akan digunakan dalam aplikasi ini. Pilih unsur yang akan diatur, kemudian tambahkan/ubah jabatan yang sesuai.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="w-50">Unsur</th>
                    <th class="w-50">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unsurs as $unsur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $unsur->nama }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <livewire:jabatan-referensi-table/>
    </div>
@endsection