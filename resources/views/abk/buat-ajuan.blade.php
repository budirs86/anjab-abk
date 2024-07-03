@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('buat-ajuan-abk') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Buat Ajuan ABK</h1>                
    </div>
    <div class="">
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
                        {{-- <tr>
                            <td>
                                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target=".collapseparent0">Expand</button>
                            </td>
                            <td>// K-123 //</td>
                            <td class="d-flex justify-content-start">
                                <p>Bidang Kepegawaian</p>
                                <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalJabatan"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
                            </td>
                        </tr>                                 --}}
                        @foreach ($jabatans as $jabatan)
                    <x-table-row :jabatan="$jabatan" :buttons="$buttons"/>    
                        @endforeach
                            
                    </tbody>
                </table>
                <div class="">
                    <a href="{{ route('abk.ajuans') }}"  class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan Informasi ABK</a>
                </div>
            </div>
@endsection