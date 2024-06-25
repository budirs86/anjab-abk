@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('informasi-abk-jabatan',$jabatan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Informasi ABK {{ $jabatan->nama_jabatan }}</h1>                
    </div>
    <label for="uraian_tugas_table" class="form-label">Uraian Tugas</label>
    <div class="mb-3" id="uraian_tugas_table">
        <table class=" table table-bordered" id="tabelTugas">
            <thead class="table-light">
                <tr>
                    <th class="fw-semibold text-muted" scope="col ">Uraian Tugas</th>
                    <th class="fw-semibold text-muted" scope="col ">Hasil Kerja</th>
                    <th class="fw-semibold text-muted" scope="col ">Jumlah Hasil Kerja</th>
                    <th class="fw-semibold text-muted" scope="col ">Waktu Penyelesaian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="">   
                        Menguapkan kopi   
                    </td>
                    <td class="">   
                        Kopi
                    </td>
                    <td class="">   
                        1 Gelas
                    </td>
                    <td class="">   
                        5 Menit
                    </td>
                </tr>   
            </tbody>
        </table>
    </div>
    <div class="">
        <a href="{{ url()->previous() }}" class="btn btn-primary header1"><img src="" alt="" data-feather="arrow-left" width="20px"> Kembali</a>
    </div>  
@endsection