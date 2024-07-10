@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('buat-informasi-beban-kerja',$jabatan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Buat Informasi ABK {{ $jabatan->nama }}</h1>                
    </div>
    <hr>
    <label for="uraian_tugas_table" class="form-label">Uraian Tugas</label>
    <div class="mb-3" id="uraian_tugas_table">
        <table class=" table table-bordered" id="tabelTugas">
            <thead class="table-light">
                <tr>
                    <th class="fw-semibold text-muted" scope="col ">Uraian Tugas</th>
                    <th class="fw-semibold text-muted" scope="col ">Hasil Kerja</th>
                    <th class="fw-semibold text-muted" scope="col ">Jumlah Hasil Kerja</th>
                    <th class="fw-semibold text-muted" scope="col ">Waktu Penyelesaian (dalam menit)</th>
                    <th class="fw-semibold text-muted" scope="col ">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Membuat Rencana Kerja</td>
                    <td>Rencana Kerja</td>
                    <td>1</td>
                    <td>16</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="">   
                        Membuat Rencana Strategis
                    </td>
                    <td class="">
                        {{-- create a text input and labelfor "hasil kerja" --}}
                        <input type="text" class="form-control" name="hasil_kerja" id="hasil_kerja" value="Rencana Strategis">
                    </td>
                    <td class="">   
                        <input type="text" class="form-control" name="beban_kerja" id="beban_kerja" value="1">
                    </td>
                    <td class="">   
                        <input type="text" class="form-control" name="waktu_penyelesaian" id="waktu_penyelesaian" value="16">
                    </td>
                    <td class="text-center">   
                        <button class="btn btn-primary"><i data-feather="save"></i> Simpan</button>
                    </td>
                </tr>   
            </tbody>
        </table>
    </div>
    <div class="">
        <a href="{{ url()->previous() }}" class="btn btn-primary header1"><img src="" alt="" data-feather="arrow-left" width="20px"> Kembali</a>
    </div>  
@endsection