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
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
@endsection
