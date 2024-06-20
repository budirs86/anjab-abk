@extends('anjab.layouts.main')

@section('content')
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Informasi ABK</h1>                
    </div>
    <label for="uraian_tugas_table" class="form-label">Uraian Tugas</label>
    <div class="mb-3" id="uraian_tugas_table">
        <table class=" table table-bordered" id="tabelTugas">
            <thead class="table-light">
                <tr>
                    <th class="fw-semibold text-muted" scope="col">Aksi</th>
                    <th class="fw-semibold text-muted" scope="col ">Uraian Tugas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>   
                        <button type="button" class="btn btn-secondary w-100">Hapus</button>
                    </td>
                    <td> 
                        <input type="text" class="form-control mb-3" name="uraian_tugas" id="uraian_tugas" placeholder="Masukkan Uraian Tugas">  
                        <table class="table table-bordered border-secondary">
                            <thead class="table-primary">
                                <th class="fw-semibold text-muted w-75">Langkah Kerja</th>
                                <th class="fw-semibold text-muted">Aksi</th>
                            </thead>
                            <tbody>
                                <tr >
                                    <td colspan="2">
                                        <button type="button" class="btn btn-primary header1">Tambah Langkah kerja</button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered ">
                            <thead class="table-success">
                                <th class="fw-semibold text-muted w-50">Hasil Kerja</th>
                                <th class="fw-semibold text-muted">Satuan</th>
                                <th class="fw-semibold text-muted">Waktu</th>
                                <th class="fw-semibold text-muted">Jumlah</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Hasil Kerja">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Satuan">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Dalam Menit">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Jumlah">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-primary header1" onclick="tambahTugas()" id="tambahTugas">Tambah Uraian Tugas</button>
                    </td>                                    
                </tr>
            </tbody>
        </table>
    </div>
    <div class="">
        <a href="{{ url()->previous() }}" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</a>
    </div>


@endsection
