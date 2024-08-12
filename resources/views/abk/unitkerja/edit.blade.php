@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('edit-ajuan-abk-unitkerja', $ajuan, $unit_kerja) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit Analisis Beban Kerja {{ $ajuan->tahun }} {{ $unit_kerja->nama }}
        </h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="">
        {{-- <label for="tracking" class="form-label">Tracking :</label>
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
        </div> --}}
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
                                    <a href="{{ route('abk.jabatan.edit', [$ajuan, $unit_kerja, $jabatan]) }}"
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
        <form action="{{ route('abk.ajuan.update', ['ajuan' => $ajuan->id, 'unit_kerja' => $unit_kerja, 'abk' => $abkId,]) }}" method="POST">
            @csrf
          <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan ABK</button>
        </form>
    @endsection
