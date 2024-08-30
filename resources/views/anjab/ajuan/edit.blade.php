@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('edit-ajuan-anjab', $ajuan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit Ajuan Analisis Jabatan {{ $ajuan->tahun }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <livewire:lihat-jabatan-table :ajuan="$ajuan" mode="show" />
    <form action="{{ route('anjab.ajuan.update', ['ajuan' => $ajuan->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i>
            Simpan Ajuan Informasi Jabatan</button>
    </form>
@endsection
