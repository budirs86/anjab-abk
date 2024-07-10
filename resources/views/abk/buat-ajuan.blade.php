@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('buat-ajuan-abk') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Buat Ajuan ABK</h1>                
    </div>
    <div class="card dropdown-divider mb-3"></div>

    @if (Request::has('periode'))
        <div class="">
            <div class="mb-3">
                <label for="periode" class="form-label">Periode</label>
                <input type="text" class="form-control" name="periode" value="{{ now()->year }}" readonly>
            </div>
            <div class="mb-3">
                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                <select class="form-select" id="unit_kerja" name="unit_kerja">
                    <option value="Bidang Kepegawaian">Bidang Kepegawaian</option>
                    <option value="Bidang Keuangan">Bidang Keuangan</option>
                    <option value="Bidang Teknologi Informasi">Bidang Teknologi Informasi</option>
                    <option value="Bidang Pengembangan Sumber Daya Manusia">Bidang Pengembangan Sumber Daya Manusia</option>
                </select>
            </div>
            <table class="table table-striped table-bordered">
                <thead >
                    {{-- <th class="fw-semibold text-muted">Action</th> --}}
                    <th class="fw-semibold text-muted">Kode</th>
                    <th class="fw-semibold text-muted">Jabatan</th>
                </thead>
                <tbody>
                    @foreach ($jabatans as $jabatan)
                        <tr>
                        <td>K - 123</td>
                        <td class="d-flex justify-content-between">
                            <p class="" href="/anjab/analisis-jabatan/create" style="">{{ $jabatan->nama }}</p>
                            <div class="div">
                                <a href="{{ route('abk.jabatan.create', ['jabatan'=> $jabatan->id]) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="edit-3"></img> Buat Informasi Beban Kerja</a>
                                {{-- <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan Bawahan</button> --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                        
                </tbody>
            </table>
            <div class="">
                <a href="{{ route('abk.ajuans') }}"  class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan Informasi ABK</a>
            </div>
        </div>        
    @else
        <div class="text-center">
            <p>Mohon maaf, Ajuan Analisis Jabatan belum dibuat atau belum disetujui.</p>
        </div>
    @endif
@endsection