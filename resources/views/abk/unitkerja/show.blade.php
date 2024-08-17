@extends('layouts.main')

@section('container')
    <div class="">
        {{-- {{ Breadcrumbs::render('ajuan-abk-unitkerja', $anjab, $unit_kerja) }} --}}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Analisis Beban Kerja {{ $anjab->tahun }} {{ $unit_kerja->nama }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="mb-3">
        @if (auth()->user()->roles[0]->name == 'Admin Kepegawaian')
            <a href="{{ route('abk.ajuan.show', ['anjab' => $anjab]) }}" class="btn btn-primary header1"><img src=""
                    alt="" data-feather="arrow-left" width="20px"> Kembali</a>
        @endif
        @if (auth()->user()->roles[0]->name == 'Operator Unit Kerja')
            <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1"><img src=""
                    alt="" data-feather="arrow-left" width="20px"> Kembali</a>
        @endif
    </div>
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
                            <p>{{ $jabatan->jabatan->nama }}</p>
                            <div class="">
                                <a href="{{ route('abk.jabatan.show', ['anjab' => $anjab, 'abk' => $abk, 'jabatan' => $jabatan]) }}"
                                    class="btn btn-sm btn-primary ms-auto"><img width="20px" data-feather="eye"></img>
                                    Lihat Analisis Beban Kerja</a>
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
