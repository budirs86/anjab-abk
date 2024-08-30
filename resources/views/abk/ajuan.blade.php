@extends('layouts.main')


@section('container')
    <div class="">
        {{ Breadcrumbs::render('lihat-ajuan-abk', $abk) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Analisis Beban Kerja Periode {{ $abk->tahun }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <table class="table table-striped table-bordered">
        <thead>
            <th class="fw-semibold text-muted">No</th>
            <th class="fw-semibold text-muted">Unit Kerja/Lembaga/Sekolah</th>
            @can('make abk')
                <th class="fw-semibold text-muted">Status</th>
                <th class="fw-semibold text-muted">Catatan Perbaikan</th>
            @elsecan('verify anjab')
                <th class="fw-semibold text-muted">Diajukan Tanggal</th>
            @endcan

        </thead>
        <tbody>
            @foreach ($abk_unit_kerja as $abk_unit)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>{{ $abk_unit->unitKerja[0]->nama }}</p>
                            {{-- create edit and lihat button group --}}
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('abk.unitkerja.show', ['abk' => $abk, 'unit_kerja' => $abk_unit->unitKerja->first()->id]) }}"
                                    class="btn btn-outline-primary">Lihat</a>
                                {{-- @if ($abk_unit->)
                                    
                                @endif --}}
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- Modal Terima Start --}}
                <div class="modal fade" tabindex="-1" id="modalTerima{{ $loop->index }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Terima Ajuan?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Ajuan yang sudah diterima tidak akan bisa diubah lagi dan akan diteruskan ke tingkat
                                    verifikasi
                                    berikutnya.</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('abk.ajuan.verifikasi', ['abk' => $abk_unit]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Terima End --}}
            @endforeach

        </tbody>
    </table>
    <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
@endsection
