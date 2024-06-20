@extends('layouts.main')

@section('container')
    <div class="container-fluid px-5 py-3 bg-tertiary vh-100">
        <div class="card m-0 p-3">
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
                    <select class="form-select" id="periode" name="periode">
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="otk" class="form-label">Pilih OTK</label>
                    <select class="form-select" id="otk" name="otk">
                        <option value="otk1">Peraturan Rektor no 6 2021</option>
                    </select>
                    {{-- <button type="submit" class="btn btn-primary">Buat Informasi Jabatan</button> --}}
                    </div>

                <a href="/anjab/data-jabatan" class="btn btn-primary">Susun Informasi Jabatan</a>
            </form>
        </div>
    </div>
            
@endsection
