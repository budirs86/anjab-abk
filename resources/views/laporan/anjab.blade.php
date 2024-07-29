@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('laporan-anjab', $ajuan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Laporan Hasil Anjab {{ $ajuan->tahun }}</h1>                
    </div>
    <hr>
    <div class="">
        <a href="{{ route('laporan.index') }}" class="mb-3 btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
    </div>
    <div class="mb-3 btn-group">
        <button class="btn btn-outline-primary">Lihat Laporan Lengkap</button>
        <button class="btn btn-outline-primary">Unduh Laporan Lengkap</button>
    </div>
    <div class="mb-3">
        {{-- <livewire:laporan-anjab-jabatan :jabatans="$jabatans"/> --}}
        <livewire:laporan-anjab :jabatans="$jabatans"/>
    </div>
@endsection