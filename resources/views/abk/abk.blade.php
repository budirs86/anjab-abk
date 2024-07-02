@extends('layouts.main')

@section('content')
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Informasi ABK</h1>                
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
                    <th class="fw-semibold text-muted" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="">   
                        <input type="text" class="form-control mb-3" name="uraian_tugas" id="uraian_tugas" placeholder="Masukkan Uraian Tugas">  
                    </td>
                    <td>   
                        <input type="text" class="form-control mb-3" name="hasil_kerja" id="hasil_kerja" placeholder="Masukkan Satuan Hasil Kerja">  
                    </td>
                    <td>   
                        <input type="text" class="form-control mb-3" name="beban_kerja" id="beban_kerja" placeholder="Masukkan Jumlah Hasil Kerja">  
                    </td>
                    <td>   
                        <input type="text" class="form-control mb-3" name="uraian_tugas" id="uraian_tugas" placeholder="Masukkan Waktu Penyelesaian Dalam Jam">  
                    </td>
                    <td class="d-flex gap-2"> 
                        <button type="button" class="btn btn-sm btn-secondary w-100">
                            <img width="20px" data-feather="edit"></img>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger w-100">
                            <img width="20px" data-feather="trash"></img>
                        </button>
                        
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="5" class="text-end">
                        <button type="button" class="btn btn-primary header1" onclick="tambahTugas()" id="tambahTugas">Tambah Uraian Tugas</button>
                    </td>                                    
                </tr>
            </tbody>
        </table>
    </div>

@endsection