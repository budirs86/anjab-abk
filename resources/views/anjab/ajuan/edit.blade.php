@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('edit-ajuan-anjab', $ajuan) }} 
    </div>
    <div class="card-head mb-3">
            <h1 class="fw-light fs-4 d-inline nav-item">Edit Ajuan Analisis Jabatan {{ $ajuan->tahun }}</h1>                
    </div>
    <hr>
    <table class="table table-striped table-bordered">
            <thead >
                <th class="fw-semibold text-muted">Kode</th>
                <th class="fw-semibold text-muted">Jabatan</th>
            </thead>
            <tbody>
                @foreach ($jabatans as $jabatan)
                    <tr>
                        <td>K - 123</td>
                        <td class="d-flex justify-content-between">
                            <p class="" href="/anjab/analisis-jabatan/create" style="">{{ $jabatan->nama }}</p>
                            <div class="div">
                                <a href="{{ route('anjab.ajuan.jabatan.edit', ['ajuan'=> $ajuan->id,'jabatan'=> $jabatan->id]) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="edit"></img> Edit Informasi Jabatan</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                    
            </tbody>
    </table>
    <a href="{{ route('anjab.ajuan.index') }}" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan Informasi Jabatan</a>
@endsection