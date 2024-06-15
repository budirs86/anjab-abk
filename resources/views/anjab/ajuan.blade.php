@extends('anjab.layouts.main')

@section('content')
    <div class="mb-3">
        {{ Breadcrumbs::render('lihat-ajuan-analisis-jabatan') }}
    </div>
    <div class="card-head mb-3">
                <h1 class="fw-light fs-4 ">Ajuan Analisis Jabatan Periode {{ request('periode') }}</h1>                
        </div>
    <div class="card dropdown-divider mb-5"></div>

    <table class="table table-striped table-bordered">
                    <thead >
                        <th class="fw-semibold text-muted">Action</th>
                        <th class="fw-semibold text-muted">Kode</th>
                        <th class="fw-semibold text-muted">Unit Kerja</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target=".collapseparent0">Expand</button>
                        </td>
                        <td>// K-123 //</td>
                        <td class="d-flex justify-content-start">
                            <p>Bidang Kepegawaian</p>
                            <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalJabatan"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
                        </td>
                    </tr>                                
                        @foreach ($jabatans as $jabatan)
                            <x-table-row :jabatan="$jabatan" :editable="$editable"/>    
                        @endforeach
                            
                    </tbody>
                </table>
@endsection