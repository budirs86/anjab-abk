@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('ajuan-abk-unitkerja', $abk, $unit_kerja) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Analisis Beban Kerja {{ $abk->tahun }} {{ $unit_kerja->nama }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="mb-3">
        @if (auth()->user()->roles[0]->name == 'Admin Kepegawaian' || auth()->user()->roles[0]->name == 'Wakil Rektor 2')
            <a href="{{ route('abk.ajuan.show', ['abk' => $abk]) }}" class="btn btn-primary header1"><img src="" alt=""
                    data-feather="arrow-left" width="20px"> Kembali</a>
        @else
            <a href="{{ route('abk.ajuans') }}"  class="btn btn-primary header1"><img src="" alt=""
                    data-feather="arrow-left" width="20px"> Kembali</a>
        @endif
    </div>
    <table class="table table-bordered">
        <thead>
            <th class="text-muted d-flex">
                Jabatan Tugas Tambahan
            </th>

        </thead>
        <tbody>
            @foreach ($tutams as $tutam)
                <tr class="table-secondary">
                    <td colspan="2">
                        <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $tutam->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $tutam->id }}">
                            <i class="fa-solid fa-chevron-down me-2"></i>
                        </button>
                        {{ $tutam->nama }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="p-0">
                        <div class="collapse" id="collapse{{ $tutam->id }}">
                            <table class="table mb-0 table-bordered table-striped">
                                <thead>
                                    <th class="fw-semibold text-muted">Kode</th>
                                    <th class="fw-semibold text-muted d-flex">Jabatan
                                    </th>
                                </thead>
                                @forelse ($tutam->abkJabatan as $jabatan)
                                    <tr wire:key="{{ $jabatan->id }}">
                                        <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <p>{{ $jabatan->jabatan->nama }}</p>
                                                <div class="">
                                                    <a href="{{ route('abk.jabatan.show',['abk' => $abk, 'unit_kerja' => $unit_kerja, 'abk_jabatan' => $jabatan ]) }}"
                                                        class="btn btn-sm btn-primary ms-auto"><i class="fa-regular fa-eye"></i> Lihat Analisis Beban Kerja</a>
                                                </div>
                                            </div>
                                        </td>
                                    <tr>

                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Unsur ini Belum memiliki Jabatan</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
