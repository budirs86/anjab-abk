@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('edit-ajuan-abk-jabatan', $ajuan, $unit_kerja, $jabatan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit Analisis Beban Kerja {{ $jabatan->nama }}</h1>
    </div>
    <hr>
    <label for="uraian_tugas_table" class="form-label">Uraian Tugas</label>
    <div class="mb-4" id="uraian_tugas_table">
        <table class=" table table-bordered" id="tabelTugas">
            <thead class="table-light">
                <tr>
                    <th class="fw-semibold text-muted" scope="col ">Uraian Tugas</th>
                    <th class="fw-semibold text-muted" scope="col ">Hasil Kerja</th>
                    <th class="fw-semibold text-muted" scope="col ">Jumlah Hasil Kerja</th>
                    <th class="fw-semibold text-muted" scope="col ">Waktu Penyelesaian (dalam jam)</th>
                    <th class="fw-semibold text-muted" scope="col ">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jabatan->detailAbk as $detail)
                    <tr>
                        <form
                            action="{{ route('abk.detail_abk.store', [
                                'ajuan' => $ajuan->id,
                                'jabatan' => $jabatan->id,
                                'unit_kerja' => $unit_kerja->id,
                                'detail_abk' => $detail->id,
                            ]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <td>
                                {{ $detail->uraianTugasDiajukan->nama_tugas }}
                            </td>
                            <td class="">
                                {{-- create a text input and labelfor "hasil kerja" --}}
                                <input type="text" class="form-control" name="hasil_kerja" id="hasil_kerja"
                                    value="{{ $detail->hasil_kerja }}">
                            </td>
                            <td class="d-flex">
                                <input type="text" class="form-control" name="jumlah_hasil_kerja" id="jumlah_hasil_kerja"
                                    value="{{ $detail->jumlah_hasil_kerja }}">
                            </td>
                            <td class="">
                                <input type="text" class="form-control" name="waktu_penyelesaian" id="waktu_penyelesaian"
                                    value="{{ $detail->waktu_penyelesaian }}">
                            </td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-primary"><i data-feather="save"></i> Simpan</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        Membuat Rencana Strategis
                    </td>
                    <td class="">
                        {{-- create a text input and labelfor "hasil kerja" --}}
                        <input type="text" class="form-control" name="hasil_kerja" id="hasil_kerja"
                            value="Rencana Strategis">
                    </td>
                    <td class="d-flex">
                        <input type="text" class="form-control" name="beban_kerja" id="beban_kerja" value="1">
                    </td>
                    <td class="">
                        <input type="text" class="form-control" name="waktu_penyelesaian" id="waktu_penyelesaian"
                            value="16">
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary"><i data-feather="save"></i> Simpan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <h2 class="fs-5">Perhitungan Jumlah Kebutuhan Pegawai</h2>

        <div class="col-md-6">
            <div class="row">
                <div class="col">Total Waktu Penyelesaian Tugas (WPT)</div>
                <div class="col">7116 jam</div>
            </div>
            <div class="row">
                <div class="col">Total Waktu Kerja Efektif</div>
                <div class="col">1250 jam</div>
            </div>
            <div class="row">
                <div class="col">Jumlah Kebutuhan Pegawai</div>
                <div class="col">6 orang</div>
            </div>
        </div>
    </div>
    <div class="">
        <a href="{{ url()->previous() }}" class="btn btn-primary header1"><img src="" alt=""
                data-feather="arrow-left" width="20px"> Kembali</a>
    </div>
@endsection
