@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('buat-ajuan') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Buat Ajuan Baru</h1>                
    </div>
    <div class="card dropdown-divider mb-3"></div>
    <form>
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" class="form-control" id="periode" name="periode" value="{{ now()->year }}" readonly>
        </div>
        <div class="mb-3">
            <label for="waktu_kerja_efektif" class="form-label">Pilih Standar Hari Kerja per Minggu</label>
            <select class="form-select" id="waktu_kerja_efektif" name="waktu_kerja_efektif">
                <option selected>Pilih Standar Hari Kerja per Minggu</option>
                <option value="5">5 Hari Kerja</option>
                <option value="6">6 Hari Kerja</option>
            </select>
        </div>

        <a href="/anjab/data-jabatan" class="btn btn-primary">Susun Informasi Jabatan</a>
    </form>
    
            
@endsection
