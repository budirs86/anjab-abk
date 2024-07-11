@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('ajuan-analisis-jabatan') }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Daftar Ajuan Analisis Jabatan</h1>
    </div>
    @can('make ajuan')
        @if (Request::has('abk'))
            <div class="alert alert-info alert-dismissible fade show">
                <div class="alert-heading d-flex justify-content-between">
                    <div class="d-flex">
                        <img width="20px" data-feather="info" class="m-0 p-0 me-2"></img>
                        <p class="m-0 p-0">Perhatian</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <hr>
                <p class="m-0 p-0">Untuk membuat ajuan ABK, silahkan tekan tombol 'Buat Ajuan ABK'</p>
            </div>
        @endif
        <div class="alert alert-dismissible alert-success fade show">
            <p class="m-0">Ajuan berhasil disimpan!</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endcan
    <div class="card dropdown-divider mb-3"></div>
    @can('make ajuan')
        <a type="button" class="btn-primary btn mb-3" href="{{ route('anjab.ajuan.create') }}"><i data-feather="plus"></i> Buat
            Ajuan Baru</a>
    @endcan
    <table class="table table-striped table-bordered table-responsive">
        <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th>Periode</th>
                @can('make ajuan')
                    <th>Status</th>
                    <th>Catatan</th>
                @elsecan('verify ajuan')
                    <th>Diajukan Tanggal</th>
                    <th>Aksi</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($ajuans as $ajuan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="w-25">
                        <div class="d-flex flex-column justify-content-between">
                            <p>{{ $ajuan->tahun }} </p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @can('make ajuan')
                                    <a href="{{ route('anjab.ajuan', $ajuan->id) }}" class="btn btn-outline-primary">Lihat</a>
                                    <a href="{{ route('anjab.ajuan.edit', $ajuan->id) }}"
                                        class="btn btn-outline-primary">Edit</a>
                                    <a href="{{ route('abk.ajuan.create', ['periode' => now()->year]) }}"
                                        class="btn btn-outline-success" aria-disabled="true">Buat Ajuan ABK</a>
                                @endcan
                            </div>
                        </div>
                    </td>
                    @can('make ajuan')
                        <td class="w-25">
                            @if (!$ajuan->verifikasi->count())
                                {{-- if there is no verifikasi for the ajuan, display alert info --}}
                                <div class="alert alert-info w-100">
                                    <div class="alert-heading d-flex">
                                        <img width="20px" data-feather="clock" class="m-0 p-0 me-2"></img>
                                        <p class="m-0 p-0">Menunggu Diperiksa</p>
                                    </div>
                                    <hr>
                                    <p class="m-0 p-0">
                                        {{ $ajuan->role_verifikasi[0]->role->name }}
                                    </p>
                                </div>
                            @endif
                        </td>
                        <td>
                            <ul>
                                @forelse ($ajuan->verifikasi as $verifikasi)
                                    <li>{{ $verifikasi->catatan }}</li>
                                @empty
                                    <li>Tidak ada catatan.</li>
                                @endforelse
                            </ul>
                        </td>
                    @elsecan('verify ajuan')
                        <td>
                            <p>{{ now()->format('d-m-Y') }}</p>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('anjab.ajuan', $ajuan) }}" class="btn btn-outline-primary">Lihat</a>
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#modalTerima">Terima</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalRevisi">Revisi</button>
                            </div>
                        </td>
                    @endcan
                    {{-- <td>{{  ? <p class="bad"></p> : "Revisi" }}</td> --}}
                </tr>
            @endforeach

            {{-- <tr>
                <td>1</td>
                <td class="w-25">
                    <div class="d-flex flex-column justify-content-between">
                        <p>2024</p>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @can('make ajuan')
                                <a href="{{ route('abk.ajuan.create', ['periode' => now()->year]) }}"
                                    class="btn btn-outline-success" aria-disabled="true">Buat Ajuan ABK</a>
                            @endcan
                        </div>
                    </div>
                </td>
                @can('make ajuan')
                    <td class="w-25">
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
                    </td>
                    <td>Tidak ada catatan.</td>
                @elsecan('verify ajuan')
                    <td>
                        <p>{{ now()->format('d-m-Y') }}</p>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('anjab.ajuan', $ajuan) }}" class="btn btn-outline-primary">Lihat</a>
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#modalTerima">Terima</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#modalRevisi">Revisi</button>
                        </div>
                    </td>
                @endcan
            </tr>
            <tr>
                <td>1</td>
                <td class="w-25">
                    <div class="d-flex flex-column justify-content-between">
                        <p>2024</p>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @can('make ajuan')
                                <a href="{{ route('anjab.ajuan', $ajuan->id) }}" class="btn btn-outline-primary">Lihat</a>
                                <a href="{{ route('anjab.ajuan.edit', $ajuan->id) }}"
                                    class="btn btn-outline-primary">Edit</a>
                                <a href="{{ route('abk.ajuan.create', ['periode' => now()->year]) }}"
                                    class="btn btn-outline-success" aria-disabled="true">Buat Ajuan ABK</a>
                            @endcan
                        </div>
                    </div>
                </td>
                @can('make ajuan')
                    <td class="">
                        <div class="alert alert-warning w-100">
                            <div class="alert-heading d-flex">
                                <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                                <p class="m-0 p-0">Perlu Perbaikan</p>
                            </div>
                            <hr>
                            <p class="m-0 p-0">Kepala Biro, Wakil Dekan 2, Sekretaris Lembaga</p>
                        </div>

                    </td>
                    <td>
                        <ul>
                            <li>Lorem ipsum dolor doloran</li>
                            <li>Lorem ipsum dolor doloran</li>
                            <li>Lorem ipsum dolor doloran</li>
                        </ul>
                    </td>
                @elsecan('verify ajuan')
                    <td>
                        <p>{{ now()->format('d-m-Y') }}</p>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('anjab.ajuan', $ajuan) }}" class="btn btn-outline-primary">Lihat</a>
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#modalTerima">Terima</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#modalRevisi">Revisi</button>
                        </div>
                    </td>
                @endcan
            </tr> --}}
        </tbody>
    </table>
    {{-- make a kembali button --}}
    <a href="{{ route('home') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>

    <div class="modal fade" tabindex="-1" id="modalTerima">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terima Ajuan?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ajuan yang sudah diterima tidak akan bisa diubah lagi dan akan diteruskan ke tingkat verifikasi
                        berikutnya.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ya</button>
                    <button type="button" class="btn btn-primary">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalRevisi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Beri Catatan dan Minta Revisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="catatan" class="form-label">Berikan Catatan tentang ajuan untuk diperbaiki</label>
                        <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
