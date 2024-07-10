@extends('layouts.main')


@section('container')
    <div class="">
        {{ Breadcrumbs::render('lihat-ajuan-abk', $ajuan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Analisis Beban Kerja Periode {{ $ajuan->tahun }}</h1>                
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <table class="table table-striped table-bordered">
        <thead >
            <th class="fw-semibold text-muted">No</th>
            <th class="fw-semibold text-muted">Unit Kerja/Lembaga/Sekolah</th>
            @can('make ajuan')
                <th class="fw-semibold text-muted">Status</th>
                <th class="fw-semibold text-muted">Catatan Perbaikan</th>
            @elsecan('verify ajuan')
                <th class="fw-semibold text-muted">Diajukan Tanggal</th>
            @endcan

        </thead>
        <tbody>
            @foreach ($unit_kerjas as $unit_kerja)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td >
                        <div class="d-flex justify-content-between">
                            <p>{{ $unit_kerja->nama }}</p>
                            {{-- create edit and lihat button group --}}
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('abk.unitkerja.show', [$ajuan, $unit_kerja]) }}" class="btn btn-outline-primary">Lihat</a>
                                @can('make ajuan')
                                    <a href="{{ route('abk.unitkerja.edit',[$ajuan, $unit_kerja]) }}" class="btn btn-outline-secondary">Edit</a>
                                @endcan
                            </div>
                        </div>
                    </td>
                    @can('make ajuan')
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
                            @if ($loop->iteration % 2 == 0)
                                Tidak ada catatan.
                            @else                            
                                <ul>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Lorem ipsum dolor sit amet.</li>
                                </ul>
                            @endif
                        </td>
                    
                    @elsecan('verify ajuan')
                        <td>{{ now()->format('d-m-Y') }}</td>
                    @endcan
                </tr>
            @endforeach
        
        </tbody>
    </table>
    <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
@endsection