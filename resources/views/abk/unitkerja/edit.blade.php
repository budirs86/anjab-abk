@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('edit-ajuan-abk-unitkerja', $abkunit, $unit_kerja) }}
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit Analisis Beban Kerja {{ $abkunit->tahun }} {{ $unit_kerja->nama }}
        </h1>
    </div>
    <div class="card dropdown-divider mb-3"></div>
    <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1 mb-3"><i data-feather="arrow-left"></i> Kembali</a>
    <div class="">
        <livewire:edit-jabatan-abk-table :tutams="$tutams" :abk="$abkunit" :jabatans="$jabatans" :unit="$unit_kerja"/>
        <form action="{{ route('abk.ajuan.update', ['abk' => $abkunit   ]) }}"  method="POST">
            @csrf
            <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan
                ABK</button>
        </form>
    @endsection
