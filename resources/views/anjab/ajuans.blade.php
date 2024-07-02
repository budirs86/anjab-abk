@extends('layouts.main')

@section('container')
<div class="">
    {{ Breadcrumbs::render('ajuan-analisis-jabatan') }} 
</div>
        <div class="card-head mb-3">
                <h1 class="fw-light fs-4 d-inline nav-item">Daftar Ajuan Analisis Jabatan</h1>                
        </div>
        <div class="alert alert-dismissible alert-success fade show">
            <p class="m-0">Ajuan berhasil disimpan!</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="card dropdown-divider mb-3"></div>
        <a type="button" class="btn-primary btn mb-3" href="{{ route('anjab.buat-ajuan') }}"><i data-feather="plus"></i> Buat Ajuan Baru</a>
        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
            </thead>
            <tbody>
            {{-- Loop through the ajuan data and display each row --}}
            
            {{-- @foreach ($ajuanData as $ajuan)
            @endforeach --}}
            
            @for($i = 1; $i <= 2; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td class="w-25">
                        <div class="d-flex justify-content-between">
                            <p>{{ $i + 2020}} </p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/anjab/ajuan/{{ $i }}?periode={{ $i+2020 }}" class="btn btn-outline-primary">Lihat</a>
                                @if ($i % 2 != 0)                                  
                                @else
                                    <a href="/abk/ajuan/create" class="btn btn-outline-success" aria-disabled="true">Buat Ajuan ABK</a>
                                    
                                @endif
                            </div>
                        </div>
                    </td>
                    @if ($i % 2 == 0)
                        <td class="w-25">
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
                        </td>
                        <td>Tidak ada catatan.</td>
                        @else
                        <td class="">
                            <div class="alert alert-warning w-100">
                                    <div class="alert-heading d-flex">
                                        <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                                        <p class="m-0 p-0">Perlu Perbaikan</p>
                                    </div>
                                    <hr>  
                                    <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
                            </div>

                        </td>
                        <td>
                            <ul>
                                <li>Lorem ipsum dolor doloran</li>
                                <li>Lorem ipsum dolor doloran</li>
                                <li>Lorem ipsum dolor doloran</li>
                            </ul>
                        </td>
                        
                    @endif
                    {{-- <td>{{  ? <p class="bad"></p> : "Revisi" }}</td> --}}
                </tr>
            @endfor
            {{-- please  --}}
            </tbody>
        </table>
        {{-- make a kembali button --}}
        <a href="{{ route('home') }}" class="btn btn-secondary"><i data-feather="chevron-left"></i> Kembali</a>
@endsection 