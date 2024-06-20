@extends('layouts.main')

@section('container')
    <div class="container-fluid px-5 py-3 bg-tertiary vh-100">
        <div class="card m-0 p-3 ">
            <div class="card-head mb-3">
                <div class="">
                    {{ Breadcrumbs::render('ubah-informasi-jabatan') }}
                </div>
                <div class="mb-3">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-dark align-baseline"><i data-feather="chevron-left"></i>Kembali</a>
                </div>
                <h1 class="fw-light fs-4 d-inline nav-item">{{ $title }}</h1>
                <div class="card dropdown-divider mb-4"></div>
                
                <form action="/anjab/analisis-jabatan" method="POST">
                    <div class="mb-3">
                        <label for="nama_jabatan" id="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" 
                        value="{{ request()->nama_jabatan ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_jabatan" id="jenis_jabatan" class="form-label">Jenis Jabatan</label>
                        <input type="text" class="form-control" id="jenis_jabatan" 
                        value="{{ request()->jenis_jabatan ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="golongan" id="golongan" class="form-label">Golongan Jabatan</label>
                        <input type="text" class="form-control" id="golongan" 
                        value="{{ request()->golongan ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="ikhtisar" class="form-label">Ikhtisar Jabatan</label>  
                        <textarea class="form-control"  placeholder="Masukkan Ikhtisar" id="ikhtisar" style="height:100px" ></textarea>
                    </div>
                    <div class=" mb-3">
                        <label for="objek_kerja" class="form-label">Objek Kerja</label>
                        <input type="text" class="form-control" id="objek_kerja" 
                        placeholder="Masukkan Objek kerja">
                    </div>
                    
                    {{-- <label for="uraian_tugas_table" class="form-label">Uraian Tugas</label>
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
                        
                    </div> --}}
                    
                    <div class="mb-3">
                        <label for="tanggungjawab" class="form-label">Tanggung Jawab</label>
                        <textarea class="form-control" placeholder="Masukkan Tanggung Jawab" id="tanggungjawab" style="height: 100px"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="wewenang" class="form-label">Wewenang</label>
                        <textarea class="form-control" placeholder="Masukkan Wewenang" id="wewenang" style="height: 100px"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="perangkat_kerja" class="form-label">Perangkat Kerja</label>
                        {{-- <p>Mohon centang dan isi perangkat kerja yang digunakan</p> --}}
                        <ul class="list-group list-group-flush" id="perangkat_kerja">
                            <li class="list-group-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="sop_check" data-bs-toggle="disabled" data-bs-target="sop">
                                    <label class="form-check-label" for="sop_check">
                                        Standar Operasional Prosedur
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukkan SOP" id="sop" disabled>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="sop_check" data-bs-toggle="disabled" data-bs-target="sop">
                                    <label class="form-check-label" for="sop_check">
                                        Standar Operasional Prosedur
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukkan SOP" id="sop" disabled>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="bahan_kerja" class="form-label">Bahan Kerja</label>
                        {{-- <p>Mohon centang dan isi perangkat kerja yang digunakan</p> --}}
                        <ul class="list-group list-group-flush" id="bahan_kerja">
                            <li class="list-group-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="sop_check" data-bs-toggle="disabled" data-bs-target="sop">
                                    <label class="form-check-label" for="sop_check">
                                        Surat Masuk
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukkan SOP" id="sop" disabled>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="korelasi_jabatan" class="form-label">Korelasi Jabatan</label>
                        <table class="table table-bordered" id="korelasi_jabatan">
                                            <thead class="table-info">
                                                <th class="fw-semibold text-muted">Jabatan</th>
                                                <th class="fw-semibold text-muted">Dalam Hal</th>
                                                <th class="fw-semibold text-muted">Unit Kerja/Instansi</th>
                                                <th class="fw-semibold text-muted">Aksi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" >
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"><img src="" data-feather="edit" alt="" width="15px"></button>
                                                        <button type="button" class="btn btn-danger"><img src="" data-feather="trash" alt="" width="15px"></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <button type="button" class="btn btn-primary header1">Tambah Korelasi Jabatan</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="risiko_bahaya" class="form-label">Risiko Bahaya</label>
                        <table class="table table-bordered" id="risiko_bahaya">
                                            <thead class="table-danger">
                                                <th class="fw-semibold text-muted">Risiko Bahaya</th>
                                                <th class="fw-semibold text-muted">Penyebab</th>
                                                <th class="fw-semibold text-muted">Aksi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" >
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"><img src="" data-feather="edit" alt="" width="15px"></button>
                                                        <button type="button" class="btn btn-danger"><img src="" data-feather="trash" alt="" width="15px"></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <button type="button" class="btn btn-primary header1 text-center">Tambah Risiko Bahaya</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                    </div>
                    <div class="my-3">
                        <p>Kondisi Lingkungan Kerja</p>
                        <hr>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Tempat Kerja</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Suhu</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Udara</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Keadaan Ruangan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Letak</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Penerangan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Penerangan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Suara</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Keadaan Tempat Kerja</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                        <div class="row mb-3 col-lg-8">
                            <div class="col-4">
                                <label for="tempat_kerja" class="col-form-label">Getaran</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="tempat_kerja">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <input type="text" class="form-control" id="rekomendasi">
                    <label for="prestasi" class="form-label text-capitalize">prestasi</label>
                    <input type="text" class="form-control " id="prestasi">
                    <label for="lainnya" class="form-label text-capitalize">lainnya</label>
                    <input type="text" class="form-control" id="lainnya">
                    <label for="kelas_jabatan" class="form-label text-capitalize">kelas jabatan</label>
                    <div class="mb-3">
                        <select class="form-select" id="kelas_jabatan">
                            @for ($i = 1; $i <= 8; ++$i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="">
                        {{-- <button type="submit" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</button> --}}
                        <a href="{{ url()->previous() }}" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            const tambahTugas = document.getElementById('tambahTugas');
            const tabelTugas = document.getElementById('tabelTugas');
            

            function tambahTugas(e) {

            }
        </script>
    </div>
@endsection