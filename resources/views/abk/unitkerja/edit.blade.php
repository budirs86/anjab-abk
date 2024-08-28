@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('edit-ajuan-abk-unitkerja', $abkunit, $unit_kerja) }}
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Edit Analisis Beban Kerja {{ $abkunit->tahun }} {{ $unit_kerja->nama }}
        </h1>
    </div>
    <div class="card dropdown-divider mb-3"></div>
    <a href="{{ route('abk.ajuans') }}" class="btn btn-primary header1 mb-3"><i data-feather="arrow-left"></i> Kembali</a>
    <div class="">
        <table class="table table-bordered">
            <thead>
                <th class="text-muted d-flex">
                    Jabatan Struktural
                </th>

            </thead>
            <tbody>
                @foreach ($tutams as $tutam)
                    <tr class="table-secondary">
                        <td colspan="2">
                            <div class="d-flex">
                                <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $tutam->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $tutam->id }}">
                                    <i class="fa-solid fa-chevron-down me-2"></i>
                                </button>
                                <div class="d-flex flex-grow-1">
                                    {{ $tutam->nama }}
                                    <button type="button" class="btn btn-sm btn-success ms-auto text-right"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalTambahJabatan{{ $loop->index }}">Tambah Jabatan
                                        Bawahan</button>
                                </div>
                            </div>
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
                                                        <a href="{{ route('abk.jabatan.edit', ['abk' => $abk, 'unit_kerja' => $unit_kerja,'abk_jabatan' => $jabatan]) }}"
                                                            class="btn btn-sm btn-warning ms-auto"><img width="20px"
                                                                data-feather="edit"></img>Edit Analisis Beban Kerja</a>
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
                    {{-- Modal Tambah Jabatan Start --}}
                                    <div class="modal fade" tabindex="-1" id="modalTambahJabatan{{ $loop->index }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambahkan Jabatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('abk.abk-jabatan.store', ['abk' => $abk]) }}" method="POST" id="jabatanForm">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <input type="integer" name="abk_id"
                                                                value="{{ $abk->id }}" hidden>
                                                            <input type="integer" name="jabatan_tutam_id"
                                                                value="{{ $tutam->id }}" hidden>
                                                            <label for="nama" class="form-label">Supervisor</label>
                                                            <input type="text"
                                                                class="form-control @error('nama') is-invalid @enderror"
                                                                placeholder="Masukkan Nama Jabatan"
                                                                value="{{ $tutam->nama }}" readonly>
                                                            @error('nama')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jabatan_id" class="form-label">Jabatan
                                                                Bawahan</label>
                                                            <select
                                                                class="form-select @error('jabatan_id') is-invalid @enderror"
                                                                name="jabatan_id" id="jabatan_id">
                                                                <option value="">Pilih Jenis Jabatan</option>
                                                                @foreach ($jabatans as $jabatan)
                                                                    <option value="{{ $jabatan->id }}"
                                                                        @if ($jabatan->id == old('jabatan_id')) selected @endif>
                                                                        {{ $jabatan->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('jabatan_id')
                                                                <label for="jabatan_id"
                                                                    class="invalid-feedback">{{ $message }}</label>
                                                            @enderror
                                                        </div>
                                                        <div class="">
                                                            <button class="btn btn-primary header1" type="submit"
                                                                id="submitJabatan"><i class="fa-solid fa-plus"></i>
                                                                Tambah
                                                                Jabatan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Modal Tambah Jabatan End --}}
                @endforeach
            </tbody>
        </table>
        {{-- <table class="table table-striped table-bordered">
            <thead>
                <th>Kode</th>
                <th>Jabatan</th>
            </thead>
            <tbody>
                @forelse ($tutams as $tutam)
                    <tr>
                        <td colspan="2">
                            <div class="d-flex justify-content-between">
                                <p>{{ $tutam->nama }}</p>
                                <div class="">
                                    <button type="button" class="btn btn-sm btn-success ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#modalTambahJabatan{{ $loop->index }}">Tambah Jabatan
                                        Bawahan</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @foreach ($tutam->abkJabatan as $jabatan)
                        <tr>
                            <td>K // 123</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <p>{{ $jabatan->jabatan->nama }}</p>
                                    <div class="">
                                        <a href="{{ route('abk.jabatan.edit', ['abk' => $abk, 'anjab' => $anjab, 'abk_jabatan' => $jabatan]) }}"
                                            class="btn btn-sm btn-warning ms-auto"><img width="20px"
                                                data-feather="edit"></img>Edit Analisis Beban Kerja</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada jabatan di unit kerja ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table> --}}
        <form action="{{ route('abk.ajuan.update', ['abk' => $abk]) }}"  method="POST">
            @csrf
            <button type="submit" class="btn btn-primary header1 text-white"><i data-feather="save"></i> Simpan Ajuan
                ABK</button>
        </form>
    @endsection
