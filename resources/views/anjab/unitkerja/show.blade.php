@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('lihat-ajuan-analisis-jabatan-unitkerja',$unit_kerja) }}
    </div>
    <div class="card-head mb-3">
                <h1 class="fw-light fs-4 ">Analisis Jabatan Periode {{ $periode }} | {{ $unit_kerja->nama }}</h1>                
        </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="mb-3">
        <label for="tracking" class="form-label">Tracking :</label>
        <div class="tracking mb-3 d-flex gap-1">
            <div class="alert alert-success">
                <div class="alert-heading d-flex">
                    <img width="20px" data-feather="check-circle" class="m-0 p-0 me-2"></img>
                    <p class="m-0 p-0">Disetujui</p>
                </div>
                <hr>  
                <p class="m-0 p-0">Manajer Tata Usaha/Kepegawaian</p>
            </div>
            <div class="alert alert-info">
                <div class="alert-heading d-flex">
                    <img width="20px" data-feather="clock" class="m-0 p-0 me-2"></img>
                    <p class="m-0 p-0">Menunggu Diperiksa</p>
                </div>
                <hr>  
                <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
            </div>
            <div class="alert alert-warning">
                <div class="alert-heading d-flex">
                    <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                    <p class="m-0 p-0">Perlu Perbaikan</p>
                </div>
                <hr>  
                <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
            </div>
        </div>        
    </div>
    <div class="mb-3">
        <label for="catatan" class="form-label">Catatan Perbaikan :</label>
        <textarea class="form-control" name="" id="catatan" cols="30" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <table class="table table-striped table-bordered">
            <thead >
                {{-- <th class="fw-semibold text-muted">Action</th> --}}
                <th class="fw-semibold text-muted">Kode</th>
                <th class="fw-semibold text-muted">Jabatan</th>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>
                        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target=".collapseparent0">Expand</button>
                    </td>
                    <td>// K-123 //</td>
                    <td class="d-flex justify-content-start">
                        <p>Bidang Kepegawaian</p>
                        <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalJabatan"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
                    </td>
                </tr>                                 --}}
                @foreach ($jabatans as $jabatan)
                    <x-table-row :jabatan="$jabatan" :buttons="$buttons"/>    
                @endforeach
                    
            </tbody>
        </table>
    </div>
    <div class="">
        <a href="/anjab/ajuan/1?periode={{ $periode }}" class="btn btn-secondary"><i data-feather="chevron-left"></i> Kembali</a>
    </div>
@endsection