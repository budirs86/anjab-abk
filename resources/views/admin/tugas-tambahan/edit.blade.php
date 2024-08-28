@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{-- {{ Breadcrumbs::render('user-create') }} --}}
        <a href="{{ route('admin.tugas-tambahan.index') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i>
            Kembali</a>
    </div>
    {{-- alert success closable --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Tambah Jabatan Tugas Tambahan</h1>
    </div>
    <hr>
    <div class="">
        <form action="{{ route('admin.tugas-tambahan.update', ['tugasTambahan' => $tugasTambahan]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="kode">Kode Tugas Tambahan</label>
                <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" placeholder=""
                    name="kode" value="{{ $tugasTambahan->kode }}">
                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="nama">Nama Tugas Tambahan</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder=""
                    name="nama" value="{{ $tugasTambahan->nama }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="unsur" class="form-label">Unsur</label>
                <select class="form-select" id="unsur" aria-label="Default select example" name="unsur_id">
                    <option selected>Pilih Unsur</option>
                    @foreach ($unsurs as $unsur)
                        <option value="{{ $unsur->id }}" @selected($unsur->id == $tugasTambahan->unsur->id)>{{ $unsur->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jenisJabatan" class="form-label">Jenis Jabatan</label>
                <select class="form-select" id="jenisJabatan" aria-label="Default select example" name="jenis_jabatan_id">
                    <option selected>Pilih Jenis Jabatan</option>
                    @foreach ($jenisJabatans as $jenisJabatan)
                        <option value="{{ $jenisJabatan->id }}" @selected($jenisJabatan->id == $tugasTambahan->jenisJabatan->id)>{{ $jenisJabatan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary header1 "><i data-feather="plus"></i>Simpan</button>
        </form>
    </div>
@endsection
