@extends('layouts.main')

@section('container')
    <div class="">
        {{ Breadcrumbs::render('isi-detail-jabatan', $jabatan) }}
    </div>
    <div class="mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Ubah Informasi Jabatan | {{ $jabatan->nama }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="mb-3">
        <a href="{{ route('anjab.jabatan.edit.1', $jabatan) }}" class="btn btn-sm btn-secondary align-baseline"><i
                data-feather="chevron-left"></i>Kembali</a>
    </div>
    <div class="alert alert-info alert-dismissible fade show">
        <div class="alert-heading d-flex justify-content-between">
            <div class="d-flex">
                <img width="20px" data-feather="info" class="m-0 p-0 me-2"></img>
                <p class="m-0 p-0">Perhatian</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <hr>
        <p class="m-0 p-0">Silahkan isi Kualifikasi Jabatan dengan informasi yang benar.</p>
    </div>
    <div class="" id="kualifikasi">
        <table class="table 
                table-bordered w-75" id="pendidikan_formal">
            <caption class="caption-top fs-6 text-black">Kualifikasi Jabatan | Pendidikan Formal</caption>
            <thead class="table-primary">
                <th>No</th>
                <th>Jenjang</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($jabatan->kualifikasi->pendidikanFormals as $pendidikan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pendidikan->jenjang }}</td>
                        <td>{{ $pendidikan->jurusan }}</td>
                        <td class="d-flex gap-1">
                            <form
                                action="{{ route('anjab.jabatan.pendidikan.delete', ['jabatan' => $jabatan->id, 'pendidikan' => $pendidikan->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="kualifikasi_jabatan_id" value="{{ $jabatan->kualifikasi->id }}">
                                <button type="submit" class="btn btn-danger">
                                    <img width="20px" data-feather="trash"></img>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.pendidikan.store', ['jabatan' => $jabatan->id]) }}"
                        method="POST">
                        @csrf
                        <td></td>
                        <input type="hidden" name="kualifikasi_jabatan_id" value="{{ $jabatan->kualifikasi->id }}">
                        <td>
                            <select name="jenjang" class="form-select" id="">
                                <option value="" selected>Pilih Jenjang Pendidikan</option>
                                <option value="SMA">SMA</option>
                                <option value="D3">D-3</option>
                                <option value="D4">D-4</option>
                                <option value="S1">S-1</option>
                                <option value="S2">S-2</option>
                                <option value="S3">S-3</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="plus"></i>
                                Tambah
                            </button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
        <table class="table 
                            table-bordered w-75" id="pengalaman">
            <caption class="caption-top">Kualifikasi Jabatan | Pengalaman</caption>
            <thead class="table-primary">
                <th>No</th>
                <th>Nama Pengalaman</th>
                <th>Lama Pengalaman (Tahun)</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($jabatan->kualifikasi->pengalamans as $pengalaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengalaman->nama }}</td>
                        <td>{{ $pengalaman->lama }}</td>
                        <td class="d-flex gap-1">
                            <form
                                action="{{ route('anjab.jabatan.pengalaman.delete', ['jabatan' => $jabatan->id, 'pengalaman' => $pengalaman->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="kualifikasi_jabatan_id"
                                    value="{{ $jabatan->kualifikasi->id }}">
                                <button type="submit" class="btn btn-danger">
                                    <img width="20px" data-feather="trash"></img>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.pengalaman.store', ['jabatan' => $jabatan->id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="kualifikasi_jabatan_id" value="{{ $jabatan->kualifikasi->id }}">
                        <td></td>
                        <td><input name="nama" type="text" class="form-control"
                                placeholder="Masukkan Nama Pengalaman">
                        </td>
                        <td><input name="lama" type="text" class="form-control"
                                placeholder="Masukkan Lama Pengalaman">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="plus"></i>
                                Tambah
                            </button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
        <table class="table 
                            table-bordered w-75" id="pelatihan">
            <caption class="caption-top"> Kualifikasi Jabatan | Pelatihan</caption>
            <thead class="table-primary">
                <th>No</th>
                <th>Jenis Pelatihan</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($jabatan->kualifikasi->pendidikanPelatihans as $pelatihan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pelatihan->nama }}</td>
                        <td class="d-flex gap-1">
                            <form
                                action="{{ route('anjab.jabatan.pelatihan.delete', ['jabatan' => $jabatan->id, 'pelatihan' => $pelatihan->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="kualifikasi_jabatan_id"
                                    value="{{ $jabatan->kualifikasi->id }}">
                                <button type="submit" class="btn btn-danger">
                                    <img width="20px" data-feather="trash"></img>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.pelatihan.store', ['jabatan' => $jabatan->id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="kualifikasi_jabatan_id" value="{{ $jabatan->kualifikasi->id }}">
                        <td></td>
                        <td class="d-flex justify-content-between">
                            <input name="nama" type="text" class="form-control w-50"
                                placeholder="Masukkan Nama Pelatihan">

                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="plus"></i>
                                Tambah
                            </button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="uraian_tugas" class="form-label">Uraian Tugas</label>
        <table class="table table-bordered w-75" id="uraian_tugas">
            <thead class="table-info">
                <th>No</th>
                <th>Uraian Tugas</th>
            </thead>
            <tbody>
                @foreach ($jabatan->uraianTugas as $uraian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="d-flex justify-content-between">
                            <p>{{ $uraian->nama_tugas }}</p>
                            <div class="">
                                <form
                                    action="{{ route('anjab.jabatan.uraian.delete', ['jabatan' => $jabatan->id, 'uraian' => $uraian->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                                    <button type="submit" class="btn btn-danger">
                                        <img width="20px" data-feather="trash"></img>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.uraian.store', ['jabatan' => $jabatan->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                        <td></td>
                        <td class="d-flex justify-content-between">
                            <input name="nama_tugas" type="text" class="form-control w-50"
                                placeholder="Masukkan Uraian Tugas">
                            <button type="submit" class="btn btn-primary"><i data-feather="plus"></i>
                                Tambah</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="bahan_kerja" class="form-label">Bahan Kerja</label>
        <table class="table 
                            table-bordered w-75" id="BahanKerja">
            <thead class="table-primary">
                <th>No</th>
                <th>Bahan Kerja</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($jabatan->bahanKerja as $bahanKerja)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bahanKerja->nama }}</td>
                        <td class="d-flex gap-1">
                            <form
                                action="{{ route('anjab.jabatan.bahanKerja.delete', ['jabatan' => $jabatan->id, 'bahanKerja' => $bahanKerja->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                                <button type="submit" class="btn btn-danger">
                                    <img width="20px" data-feather="trash"></img>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.bahanKerja.store', ['jabatan' => $jabatan->id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                        <td></td>
                        <td>
                            <input name="nama" type="text" class="form-control"
                                placeholder="Masukkan Bahan Kerja">
                        </td>
                        <td><button type="submit" class="btn btn-primary"><i data-feather="plus"></i>
                                Tambah</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="perangkat_kerja" class="form-label">Perangkat Kerja</label>
        <table class="table 
                            table-bordered w-75" id="PerangkatKerja">
            <thead class="table-secondary">
                <th>No</th>
                <th>Perangkat Kerja</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($jabatan->perangkatKerja as $perangkatKerja)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $perangkatKerja->nama }}</td>
                        <td class="d-flex gap-1">
                            <form
                                action="{{ route('anjab.jabatan.perangkatKerja.delete', ['jabatan' => $jabatan->id, 'perangkatKerja' => $perangkatKerja->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                                <button type="submit" class="btn btn-danger">
                                    <img width="20px" data-feather="trash"></img>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.perangkatKerja.store', ['jabatan' => $jabatan->id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                        <td></td>
                        <td>
                            <input name="nama" type="text" class="form-control"
                                placeholder="Masukkan Perangkat Kerja">
                        </td>
                        <td><button type="submit" class="btn btn-primary"><i data-feather="plus"></i>
                                Tambah</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="tanggung_jawab" class="form-label">Tanggung Jawab</label>
        <table class="table table-bordered w-75" id="tanggung_jawab">
            <thead class="table-info">
                <th>No</th>
                <th>Uraian</th>
            </thead>
            <tbody>
                @foreach ($jabatan->tanggungJawab as $tanggungJawab)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="d-flex justify-content-between">
                            <p>{{ $tanggungJawab->nama }}</p>
                            <div class="">
                                <form
                                    action="{{ route('anjab.jabatan.tanggungJawab.delete', ['jabatan' => $jabatan->id, 'tanggungJawab' => $tanggungJawab->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                                    <button type="submit" class="btn btn-danger">
                                        <img width="20px" data-feather="trash"></img>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('anjab.jabatan.tanggungJawab.store', ['jabatan' => $jabatan->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                        <td></td>
                        <td class="d-flex justify-content-between">
                            <input name="nama" type="text" class="form-control w-50" placeholder="Masukkan Tanggung Jawab">
                            <button type="submit" class="btn btn-primary"><i data-feather="plus"></i>
                                Tambah</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="wewenang" class="form-label">Wewenang</label>
        <table class="table table-bordered w-75" id="wewenang">
            <thead class="table-info">
                <th>No</th>
                <th>Uraian</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="d-flex justify-content-between">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi ad nam vero ea
                            temporibus.</p>
                        <div class="">
                            <a href="" class="btn btn-warning"><img width="20px" data-feather="edit"></img></a>
                            <a href="" class="btn btn-danger"><img width="20px" data-feather="trash"></img></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <form action="">
                        <td>2</td>
                        <td class="d-flex justify-content-between">
                            <input type="text" class="form-control w-50" placeholder="Masukkan Nama Pengalaman">
                            <button type="button" class="btn btn-primary"><i data-feather="plus"></i>
                                Tambah</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="korelasi_jabatan" class="form-label">Korelasi Jabatan</label>
        <table class="table table-bordered" id="korelasi_jabatan">
            <thead class="table-info">
                <th>No</th>
                <th>Unit Kerja/Instansi</th>
                <th>Jabatan</th>
                <th>Dalam Hal</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td>
                        <button type="button" class="btn btn-warning"><img src="" data-feather="edit"
                                alt="" width="20px"></button>
                        <button type="button" class="btn btn-danger"><img src="" data-feather="trash"
                                alt="" width="20px"></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <select name="" id="" class="form-select">
                            <option value="">Pilih Unit Kerja</option>
                            @foreach ($unit_kerjas as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="" id="" class="form-select">
                            <option value="">Pilih Jabatan</option>
                            <option value="">Lorem, ipsum dolor.</option>
                            <option value="">Lorem, ipsum dolor.</option>
                            <option value="">Lorem, ipsum dolor.</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="Masukkan Korelasi Jabatan">
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary"><i data-feather=""></i>Tambah</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-3">
        <label for="risiko_bahaya" class="form-label">Risiko Bahaya</label>
        <table class="table 
                    table-bordered w-75" id="bahan_kerja">
            <thead class="table-danger">
                <th>No</th>
                <th>Risiko bahaya</th>
                <th>Penyebab</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                    <td class="d-flex gap-1">
                        <a href="" class="btn btn-warning"><img width="20px" data-feather="edit"></img></a>
                        <a href="" class="btn btn-danger"><img width="20px" data-feather="trash"></img></a>
                    </td>
                </tr>
                <tr>
                    <form action="">
                        <td>2</td>
                        <td>
                            <input type="text" class="form-control" placeholder="Masukkan Risiko Bahaya">
                        </td>
                        <td>
                            <input type="text" class="form-control" placeholder="Masukkan Penyebab">
                        </td>
                        <td><button type="button" class="btn btn-primary"><i data-feather="plus"></i>
                                Tambah</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="my-3">
        <hr>
        <p>Kondisi Lingkungan Kerja</p>
        <div class="row">
            <div class="col-6">
                <label for="letak" class="form-label">Letak</label>
                <select name="letak" id="letak" class="form-select mb-3">
                    <option value="dalam ruangan">Dalam Ruangan</option>
                    <option value="luar ruangan">Luar Ruangan</option>
                </select>
                <label for="penerangan" class="form-label">Penerangan</label>
                <select name="penerangan" id="penerangan" class="form-select mb-3">
                    <option value="redup">Redup</option>
                    <option value="terang">Terang</option>
                </select>
                <label for="suhu" class="form-label text-capitalize">suhu</label>
                <select name="suhu" id="suhu" class="form-select mb-3">
                    <option value="panas">Panas</option>
                    <option value="dingin">Dingin</option>
                </select>
                <label for="getaran" class="form-label text-capitalize">getaran</label>
                <select name="getaran" id="getaran" class="form-select mb-3">
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>
            <div class="col-6">
                <label for="suara" class="form-label text-capitalize">suara</label>
                <select name="suara" id="suara" class="form-select mb-3">
                    <option value="bising">Bising</option>
                    <option value="senyap">Senyap</option>
                </select>
                <label for="keadaan_ruangan" class="form-label text-capitalize">keadaan ruangan</label>
                <select name="keadaan_ruangan" id="keadaan_ruangan" class="form-select mb-3">
                    <option value="sesak">Sesak</option>
                    <option value="lega">Lega</option>
                </select>
                {{-- create select input for udara with options "lembab", "kering" --}}
                <label for="udara" class="form-label text-capitalize">udara</label>
                <select name="udara" id="udara" class="form-select mb-3">
                    <option value="kering">Lembab</option>
                    <option value="lembab">Kering</option>
                </select>
                {{-- create text input for tempat --}}
                <label for="tempat" class="form-label text-capitalize">tempat</label>
                <input type="text" class="form-control mb-3" id="tempat" name="tempat">
            </div>
        </div>
        <hr class="mb-3">
    </div>
    <label for="syarat_jabatan" class="form-label mb-4">Syarat Jabatan</label>

    <div class="" id="syarat_jabatan">
        {{-- create text input for keterampilan --}}
        <label for="keterampilan" class="text-capitalize form-label">keterampilan</label>
        <textarea name="keterampilan" id="keterampilan" rows="4" class="form-control mb-3"></textarea>
        {{-- create bakat kerja checkbox input, with options using options in /seeder/bakat_kerja.json --}}
        <label for="bakat_kerja" class="form-label">Bakat Kerja</label>
        <div class="mb-4" id="bakat_kerja">

            <div class="row">
                @foreach ($bakat_kerjas as $bakat)
                    <div class="col-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $bakat->kode }}"
                                id="{{ $bakat->nama }}" name="{{ $bakat->nama }}">
                            <label class="form-check-label" for="{{ $bakat->nama }}">{{ $bakat->nama }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <label for="temperamen" class="form-label">Temperamen Kerja</label>
        <div class="row mb-4" id="temperamen">
            @foreach ($temperamens as $temperamen)
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $temperamen->kode }}"
                            id="{{ $temperamen->nama }}" name="{{ $temperamen->nama }}">
                        <label class="form-check-label" for="{{ $temperamen->nama }}">{{ $temperamen->nama }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <label for="minat" class="form-label">Minat Kerja</label>
        <div class="row mb-4" id="minat">
            @foreach ($minat_kerjas as $minat_kerja)
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $minat_kerja->kode }}"
                            id="{{ $minat_kerja->nama }}" name="{{ $minat_kerja->nama }}">
                        <label class="form-check-label" for="{{ $minat_kerja->nama }}">{{ $minat_kerja->nama }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <label for="upaya_fisik" class="form-label">Upaya Fisik</label>
        <div class="row mb-4" id="upaya_fisik">
            @foreach ($upaya_fisiks as $upaya_fisik)
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $upaya_fisik->kode }}"
                            id="{{ $upaya_fisik->nama }}" name="{{ $upaya_fisik->nama }}">
                        <label class="form-check-label" for="{{ $upaya_fisik->nama }}">{{ $upaya_fisik->nama }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-3">
            <p>Kondisi Fisik</p>
            <div class="row">
                <div class="col-6">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mb-3">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>

                    <label for="umur" class="form-label">Umur (Tahun)</label>
                    <input type="text" name="umur" class="form-control mb-3" id="umur">

                    <label for="tinggi_badan" class="form-label text-capitalize">tinggi badan (sentimeter)</label>
                    <input type="number" name="tinggi_badan" class="form-control mb-3" id="tinggi_badan">
                </div>
                <div class="col-6">
                    <label for="berat_badan" class="form-label text-capitalize">berat badan (kilogram)</label>
                    <input type="number" name="berat_badan" class="form-control mb-3" id="berat_badan">

                    <label for="postur_badan" class="form-label text-capitalize">postur badan</label>
                    <input type="text" name="postur_badan" class="form-control mb-3" id="postur_badan">

                    <label for="penampilan" class="form-label text-capitalize">penampilan</label>
                    <input type="text" name="penampilan" class="form-control mb-3" id="penampilan">
                </div>
            </div>
        </div>
        <label for="fungsi_pekerjaan" class="form-label">Fungsi Pekerjaan</label>
        <div class="row mb-4" id="fungsi_pekerjaan">
            @foreach ($fungsi_pekerjaans as $fungsi_pekerjaan)
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $fungsi_pekerjaan->id }}"
                            id="{{ $fungsi_pekerjaan->nama }}" name="{{ $fungsi_pekerjaan->nama }}">
                        <label class="form-check-label" for="{{ $fungsi_pekerjaan->nama }}">
                            {{ $fungsi_pekerjaan->kode . ' ' . $fungsi_pekerjaan->nama }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ route('anjab.ajuan.create') }}" class="btn header1 btn-primary"><i data-feather="save"></i> Simpan
            dan Kembali</a>
    </div>
@endsection
