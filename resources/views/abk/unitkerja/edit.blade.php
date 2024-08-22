@extends('layouts.main')

@section('container')
    <div class="">
        {{-- {{ Breadcrumbs::render('edit-ajuan-abk-unitkerja', $anjab, $unit_kerja) }} --}}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit Analisis Beban Kerja {{ $anjab->tahun }} {{ $unit_kerja->nama }}
        </h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="">
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
                                    <a href="{{ route('abk.jabatan.edit', ['anjab' => $anjab, 'abk' => $abk, 'jabatan' => $jabatan]) }}"
                                        class="btn btn-sm btn-warning ms-auto"><img width="20px"
                                            data-feather="edit"></img>Edit Analisis Beban Kerja</a>
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
        <form action="{{ route('abk.ajuan.update', ['anjab' => $anjab->id, 'abk' => $abk,]) }}" method="POST">
            @csrf
          <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan ABK</button>
        </form>
    @endsection
