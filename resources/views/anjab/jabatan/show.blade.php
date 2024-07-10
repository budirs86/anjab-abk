@extends('layouts.main')

@section('container')
            <div class="card-head mb-3">
                <div class="">
                    @if (Route::currentRouteName() == 'anjab.ajuan.jabatan.show')
                        {{ Breadcrumbs::render('lihat-ajuan-anjab-jabatan', $ajuan, $jabatan) }}
                    @else
                        {{ Breadcrumbs::render('ubah-informasi-jabatan',$jabatan) }}
                    @endif
                </div>
                <div class="mb-3">
                    <h1 class="fw-light fs-4 d-inline nav-item">
                        @if (Route::currentRouteName() == 'anjab.ajuan.jabatan.show')
                            Lihat Informasi Jabatan | {{ $jabatan->nama }}
                        @else
                            Ubah Informasi Jabatan | {{ $jabatan->nama }}
                        @endif
                    </h1> 
                </div>
                <div class="card dropdown-divider mb-4"></div>
                <div class="mb-3">
                    <a href=" {{ Route::currentRouteName() == 'anjab.ajuan.jabatan.show' ? route('anjab.ajuan', ['ajuan' => $ajuan->id]) : route('anjab.ajuan.create') }} "
                     class="btn btn-sm btn-secondary align-baseline"><i data-feather="chevron-left"></i>Kembali</a>
                </div>
                <form action="/anjab/analisis-jabatan" method="POST">
                    <fieldset disabled>
                    <div class="mb-3">
                        <label for="nama" id="nama" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama" 
                        value="{{ $jabatan->nama ?? '' }}" >
                    </div>
                    <div class="mb-3">
                        <label for="jenis_jabatan" class="form-label">Jenis Jabatan</label>
                        <select class="form-select" name="jenis_jabatan_id" id="jenis_jabatan">
                            @foreach ($jenis_jabatan as $jenis)
                                <option value="{{ $jenis->id }}" @if ($jenis->id == old('jenis_jabatan_id')) selected @endif>{{ $jenis->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ikhtisar" class="form-label">Ikhtisar Jabatan</label>  
                        <textarea class="form-control"  placeholder="Masukkan Ikhtisar" id="ikhtisar" style="height:100px" ></textarea>
                    </div>
                    <div class="mb-3">
                    <hr>
                        <label for="kualifikasi" class="form-label">Kualifikasi Jabatan</label>
                        <div class="" id="kualifikasi">
                            <table class="table 
                            table-bordered w-75">
                                <caption class="caption-top fs-6">Kualifikasi Jabatan | Pendidikan Formal</caption>
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Jenjang</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>S-1</td>
                                        <td>Manajemen</td>
                                        <td class="d-flex gap-1">
                                            <a href="" class="btn btn-warning"><img width="20px" data-feather="edit"></img></a>
                                            <a href="" class="btn btn-danger"><img width="20px" data-feather="trash"></img></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <form action="">
                                        <td>2</td>
                                        <td>
                                            <select name="" class="form-select" id="">
                                                <option value="" selected>Pilih Jenjang Pendidikan</option>
                                                <option value="">SMA</option>
                                                <option value="">D-3</option>
                                                <option value="">D-4</option>
                                                <option value="">S-1</option>
                                                <option value="">S-2</option>
                                                <option value="">S-3</option>

                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" placeholder="Masukkan Jurusan"></td>
                                        <td><button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table 
                            table-bordered w-75">
                                <caption class="caption-top">Kualifikasi Jabatan | Pengalaman</caption>
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Nama Pengalaman</th>
                                    <th>Lama Pengalaman</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Manajer</td>
                                        <td>1 Tahun</td>
                                        <td class="d-flex gap-1">
                                            <a href="" class="btn btn-warning"><img width="20px" data-feather="edit"></img></a>
                                            <a href="" class="btn btn-danger"><img width="20px" data-feather="trash"></img></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <form action="">
                                        <td>2</td>
                                        <td><input type="text" class="form-control" placeholder="Masukkan Nama Pengalaman"></td>
                                        <td><input type="text" class="form-control" placeholder="Masukkan Lama Pengalaman"></td>
                                        <td><button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table 
                            table-bordered w-75">
                                <caption class="caption-top"> Kualifikasi Jabatan | Pelatihan</caption>
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Jenis Pelatihan</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="d-flex justify-content-between">
                                            <p>Pelatihan Manajemen Organisasi</p>
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
                                            <input type="text" class="form-control w-50" placeholder="Masukkan Nama Pelatihan">
                                            <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button>
                                        </td>  
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <label for="uraian_tugas" class="form-label">Uraian Tugas</label>
                        <table class="table table-bordered w-75" id="uraian_tugas">
                                <thead class="table-info">
                                    <th>No</th>
                                    <th>Uraian Tugas</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="d-flex justify-content-between">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi ad nam vero ea temporibus.</p>
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
                                            <input type="text" class="form-control w-50" placeholder="Masukkan Uraian Tugas">
                                            <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button>
                                        </td>  
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="mb-3">
                        <label for="bahan_kerja" class="form-label">Bahan Kerja</label>
                        <table class="table 
                            table-bordered w-75" id="bahan_kerja">
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Bahan Kerja</th>
                                    <th>Penggunaan dalam Pekerjaan</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Alat Tulis</td>
                                        <td>Menulis</td>
                                        <td class="d-flex gap-1">
                                            <a href="" class="btn btn-warning"><img width="20px" data-feather="edit"></img></a>
                                            <a href="" class="btn btn-danger"><img width="20px" data-feather="trash"></img></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <form action="">
                                        <td>2</td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Masukkan Bahan Kerja">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Masukkan Penggunaan dalam Pekerjaan">
                                        </td>
                                        <td><button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button></td>
                                        </form>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="perangkat_kerja" class="form-label">Perangkat Kerja</label>
                        <table class="table 
                            table-bordered w-75" id="perangkat_kerja">
                                <thead class="table-secondary">
                                    <th>No</th>
                                    <th>Perangkat Kerja</th>
                                    <th>Penggunaan dalam Pekerjaan</th>
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
                                            <input type="text" class="form-control" placeholder="Masukkan Perangkat Kerja">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Masukkan Penggunaan dalam Pekerjaan">
                                        </td>
                                        <td><button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button></td>
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
                                    <tr>
                                        <td>1</td>
                                        <td class="d-flex justify-content-between">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi ad nam vero ea temporibus.</p>
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
                                            <input type="text" class="form-control w-50" placeholder="Masukkan Uraian Tanggung Jawab">
                                            <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button>
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
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro modi ad nam vero ea temporibus.</p>
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
                                            <input type="text" class="form-control w-50" placeholder="Masukkan Uraian Wewenang">
                                            <button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button>
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
                                                        <button type="button" class="btn btn-warning"><img src="" data-feather="edit" alt="" width="20px"></button>
                                                        <button type="button" class="btn btn-danger"><img src="" data-feather="trash" alt="" width="20px"></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>
                                                        <select name="" id="" class="form-select" >
                                                            <option value="">Pilih Unit Kerja</option>
                                                            @foreach ($unit_kerjas as $unit)
                                                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="" id="" class="form-select" >
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
                                        <td><button type="button" class="btn btn-primary"><i data-feather="plus"></i> Tambah</button></td>
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
                                <label for="lokasi" class="form-label">Letak</label>
                                <select name="" id="lokasi" class="form-select mb-3">
                                    <option value="">Dalam Ruangan</option>
                                    <option value="">Luar Ruangan</option>
                                </select>
                                <label for="penerangan" class="form-label">Penerangan</label>
                                <select name="" id="penerangan" class="form-select mb-3">
                                    <option value="">Redup</option>
                                    <option value="">Terang</option>
                                </select>
                                <label for="suhu" class="form-label text-capitalize">suhu</label>
                                <select name="" id="suhu" class="form-select mb-3">
                                    <option value="">Panas</option>
                                    <option value="">Dingin</option>
                                </select>
                                <label for="getaran" class="form-label text-capitalize">getaran</label>
                                <select name="" id="getaran" class="form-select mb-3">
                                    <option value="">Rendah</option>
                                    <option value="">Sedang</option>
                                    <option value="">Tinggi</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="suara" class="form-label text-capitalize">suara</label>
                                <select name="" id="suara" class="form-select mb-3">
                                    <option value="">Bising</option>
                                    <option value="">Senyap</option>
                                </select>
                                <label for="keadaan_ruangan" class="form-label text-capitalize">keadaan ruangan</label>
                                <select name="" id="keadaan_ruangan" class="form-select mb-3">
                                    <option value="">Sesak</option>
                                    <option value="">Lega</option>
                                </select>
                                {{-- create select input for udara with options "lembab", "kering" --}}
                                <label for="udara" class="form-label text-capitalize">udara</label>
                                <select name="" id="udara" class="form-select mb-3">
                                    <option value="">Lembab</option>
                                    <option value="">Kering</option>
                                </select>
                                {{-- create text input for tempat --}}
                                <label for="tempat" class="form-label text-capitalize">tempat</label>
                                <input type="text" class="form-control mb-3" id="tempat">
                            </div>
                        </div>
                        <hr class="mb-3">
                    </div>
                    <p for="syarat_jabatan">Syarat Jabatan</p>
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
                                    <input class="form-check-input" type="checkbox" value="{{   $bakat->kode }}" id="{{ $bakat->nama }}">
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
                                    <input class="form-check-input" type="checkbox" value="{{   $temperamen->kode }}" id="{{ $temperamen->nama }}">
                                    <label class="form-check-label" for="{{ $temperamen->nama }}">{{ $temperamen->nama }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <label for="upaya_fisik" class="form-label">Upaya Fisik</label>
                    <div class="row mb-4" id="upaya_fisik">
                            @foreach ($upaya_fisiks as $upaya_fisik)
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{   $upaya_fisik->kode }}" id="{{ $upaya_fisik->nama }}">
                                    <label class="form-check-label" for="{{ $upaya_fisik->nama }}">{{ $upaya_fisik->nama }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
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
                                <input type="text" class="form-control mb-3" id="umur">

                                <label for="tinggi_badan" class="form-label text-capitalize">tinggi badan (sentimeter)</label>
                                <input type="number" class="form-control mb-3" id="tinggi_badan">
                            </div>
                            <div class="col-6">
                                <label for="berat_badan" class="form-label text-capitalize">berat badan (kilogram)</label>
                                <input type="number" class="form-control mb-3" id="berat_badan">

                                <label for="postur_badan" class="form-label text-capitalize">postur badan</label>
                                <input type="text" class="form-control mb-3" id="postur_badan">

                                <label for="penampilan" class="form-label text-capitalize">penampilan</label>
                                <input type="text" class="form-control mb-3" id="penampilan">
                            </div>
                        </div>
                        <hr class="mb-3">
                    </div>
                    <div class="row mb-4" id="fungsi_pekerjaan">
                        @foreach ($fungsi_pekerjaans as $fungsi_pekerjaan)
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{   $fungsi_pekerjaan->id }}" id="{{ $fungsi_pekerjaan->nama }}">
                                <label class="form-check-label" for="{{ $fungsi_pekerjaan->nama }}"> {{$fungsi_pekerjaan->kode . " " . $fungsi_pekerjaan->nama }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                
                    <label for="prestasi" class="form-label text-capitalize">prestasi</label>
                    <input type="text" class="form-control " id="prestasi">

                    <label for="kelas_jabatan" class="form-label text-capitalize">kelas jabatan</label>
                    <div class="mb-3">
                        <select class="form-select" id="kelas_jabatan">
                            @for ($i = 1; $i <= 8; ++$i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="">
                        {{-- <button type="submit" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</button> --}}
                        <a href="{{ url()->previous() }}" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</a>
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>
        
        <script>
            const tambahTugas = document.getElementById('tambahTugas');
            const tabelTugas = document.getElementById('tabelTugas');
            

            function tambahTugas(e) {

            }
        </script>
    </div>
@endsection