@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('ajuan-abk-unitkerja', $ajuan, $unit_kerja) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Analisis Beban Kerja {{ $ajuan->tahun }} {{ $unit_kerja->nama }}</h1>                
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="mb-3">
        <a href="{{ route('abk.ajuan.show',$ajuan) }}" class="btn btn-primary header1"><img src="" alt="" data-feather="arrow-left" width="20px"> Kembali</a>
    </div>
    @can('make ajuan')
        <div class="">
            <label for="tracking" class="form-label">Tracking :</label>
            <div class="d-flex gap-2" id="tracking">
                <div class="alert alert-success w-100">
                <div class="alert-heading d-flex">
                    <img width="20px" data-feather="check-circle" class="m-0 p-0 me-2"></img>
                    <p class="m-0 p-0">Disetujui</p>
                </div>
                <hr>  
                <p class="m-0 p-0">Manajer Tata Usaha/Kepegawaian</p>
            </div>
            <div class="alert alert-info w-100">
                <div class="alert-heading d-flex">
                    <img width="20px" data-feather="clock" class="m-0 p-0 me-2"></img>
                    <p class="m-0 p-0">Menunggu Diperiksa</p>
                </div>
                <hr>  
                <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
            </div>
            <div class="alert alert-warning w-100">
                    <div class="alert-heading d-flex">
                        <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                        <p class="m-0 p-0">Perlu Perbaikan</p>
                    </div>
                    <hr>  
                    <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
            </div>
            <div class="alert alert-warning w-100">
                    <div class="alert-heading d-flex">
                        <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                        <p class="m-0 p-0">Perlu Perbaikan</p>
                    </div>
                    <hr>  
                    <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
            </div>
        </div>
        <label for="catatan" id="catatan" class="form-label">Catatan :</label>
        <div class="form-label" id="catatan">
            <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="4" readonly></textarea>
        </div>
    @endcan
    <table class="table table-striped table-bordered">
        <thead>
            <th>Kode</th>
            <th>Jabatan</th>
        </thead>
        <tbody>
            @forelse ($jabatans as $jabatan)    
                <tr>
                    <td>K // 123</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>{{ $jabatan->nama }}</p>
                            <div class="">
                                <a href="{{ route('abk.jabatan.show',[$ajuan, $unit_kerja, $jabatan]) }}" class="btn btn-sm btn-primary ms-auto"><img width="20px" data-feather="eye"></img> Lihat Analisis Beban Kerja</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Tidak ada jabatan di unit kerja ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @endsection