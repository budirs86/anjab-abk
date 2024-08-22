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
                    {{-- <button type="submit" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</button> --}}
                    <a href="{{ route('anjab.ajuan.show', ['ajuan' => $ajuan->tahun, 'id' => $ajuan->id]) }}" class="btn btn-primary header1"><img src="" alt="" data-feather="arrow-left" width="20px"> Kembali</a>
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
                            <textarea class="form-control" placeholder="Masukkan Ikhtisar" value="{{ $jabatan->ikhtisar }}" id="ikhtisar" style="height:100px" >{{ $jabatan->ikhtisar }}</textarea>
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
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatan->pendidikanFormal as $pendidikan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pendidikan->jenjang }}</td>
                                                <td>{{ $pendidikan->jurusan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table 
                                table-bordered w-75">
                                    <caption class="caption-top">Kualifikasi Jabatan | Pengalaman</caption>
                                    <thead class="table-primary">
                                        <th>No</th>
                                        <th>Nama Pengalaman</th>
                                        <th>Lama Pengalaman</th>
                                        
                                    </thead>
                                    <tbody>
                                        @forelse ($jabatan->pengalaman as $pengalaman)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td>{{ $pengalaman->nama }}</td>
                                                <td>{{ $pengalaman->lama . " Tahun" }}</td>
                                            </tr>
                                        @empty

                                        @endforelse
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
                                        @foreach ($jabatan->pendidikanPelatihan as $pelatihan)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td>{{ $pelatihan->nama }}</td>
                                            </tr>
                                        @endforeach
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
                                        @forelse ($jabatan->uraianTugas as $tugas)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td>{{$tugas->nama_tugas}}</td>
                                            </tr>
                                        @empty
                                            <td colspan="2">Tidak ada data.</td>
                                        @endforelse
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
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatan->bahanKerja as $bahan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bahan->nama }}</td>
                                                <td>{{ $bahan->penggunaan }}</td>
                                            </tr>
                                        @endforeach
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
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatan->perangkatKerja as $perangkat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $perangkat->nama }}</td>
                                                <td>{{ $perangkat->penggunaan }}</td>
                                            </tr>
                                        @endforeach
                                        
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
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td class="d-flex justify-content-between">
                                                    {{ $tanggungJawab->nama }}
                                                </td>
                                            </tr>
                                        @endforeach
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
                                        @foreach ($jabatan->wewenang as $wewenang)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td class="d-flex justify-content-between">
                                                    {{ $wewenang->nama }}
                                                </td>
                                            </tr>
                                        @endforeach
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
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($jabatan->korelasiJabatan as $korelasi)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $korelasi->jabatanRelasi->unsurs[0]->nama }}</td>
                                                            <td>{{ $korelasi->jabatanRelasi->nama }}</td>
                                                            <td>{{ $korelasi->dalam_hal }}</td>
                                                            {{-- <td>{{ $korelasi->unit_kerja }}</td>
                                                            <td>{{ $korelasi->jabatan }}</td>
                                                            <td>{{ $korelasi->dalam_hal }}</td> --}}
                                                        </tr>
                                                    @endforeach
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
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatan->risikoBahaya as $risiko)
                                            <tr>
                                                <td style="width: 10%">{{ $loop->iteration }}</td>
                                                <td>{{ $risiko->bahaya_fisik }}</td>
                                                <td>{{ $risiko->penyebab }}</td>
                                            </tr>
                                        @endforeach
                                        
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
                                        <option value="" @selected($jabatan->lokasi == "dalam ruangan")>Dalam Ruangan</option>
                                        <option value="" @selected($jabatan->lokasi == "luar ruangan")>Luar Ruangan</option>
                                    </select>
                                    <label for="penerangan" class="form-label">Penerangan</label>
                                    <select name="" id="penerangan" class="form-select mb-3">
                                        <option value="" @selected($jabatan->penerangan == "redup")>Redup</option>
                                        <option value="" @selected($jabatan->penerangan == "terang")>Terang</option>
                                    </select>
                                    <label for="suhu" class="form-label text-capitalize">suhu</label>
                                    <select name="" id="suhu" class="form-select mb-3">
                                        <option value="" @selected($jabatan->suhu == "panas")>Panas</option>
                                        <option value="" @selected($jabatan->suhu == "dingin")>Dingin</option>
                                    </select>
                                    <label for="getaran" class="form-label text-capitalize">getaran</label>
                                    <select name="" id="getaran" class="form-select mb-3">
                                        <option value="" @selected($jabatan->getaran == "rendah")>Rendah</option>
                                        <option value="" @selected($jabatan->getaran == "sedang")>Sedang</option>
                                        <option value="" @selected($jabatan->getaran == "tinggi")>Tinggi</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="suara" class="form-label text-capitalize">suara</label>
                                    <select name="" id="suara" class="form-select mb-3">
                                        <option value="" @selected($jabatan->suara == 'bising')>Bising</option>
                                        <option value="" @selected($jabatan->suara == 'senyap')>Senyap</option>
                                    </select>
                                    <label for="keadaan_ruangan" class="form-label text-capitalize">keadaan ruangan</label>
                                    <select name="" id="keadaan_ruangan" class="form-select mb-3">
                                        <option value="" @selected($jabatan->keadaan_ruangan == 'sesak')>Sesak</option>
                                        <option value="" @selected($jabatan->keadaan_ruangan == 'lega')>Lega</option>
                                    </select>
                                    {{-- create select input for udara with options "lembab", "kering" --}}
                                    <label for="udara" class="form-label text-capitalize">udara</label>
                                    <select name="" id="udara" class="form-select mb-3">
                                        {{-- for each option, add appropriate selected blade directive --}}
                                        <option value="" @selected($jabatan->udara == 'lembab')>Lembab</option>
                                        <option value="" @selected($jabatan->udara == 'kering')>Kering</option>
                                    </select>
                                    {{-- create text input for tempat --}}
                                    <label for="tempat" class="form-label text-capitalize">tempat</label>
                                    <input type="text" class="form-control mb-3" id="tempat" value="{{ $jabatan->tempat }}">
                                </div>
                            </div>
                            <hr class="mb-3">
                        </div>
                        <p for="syarat_jabatan">Syarat Jabatan</p>
                        <div class="" id="syarat_jabatan">
                            {{-- create text input for keterampilan --}}
                            <label for="keterampilan" class="text-capitalize form-label">keterampilan</label>
                            <textarea name="keterampilan" id="keterampilan" rows="4" class="form-control mb-3">{{ $jabatan->keterampilan }}</textarea>
                            {{-- create bakat kerja checkbox input, with options using options in /seeder/bakat_kerja.json --}}
                            <label for="bakat_kerja" class="form-label">Bakat Kerja</label>
                            <div class="mb-4" id="bakat_kerja">
                            
                            <div class="row">
                                @foreach ($bakat_kerjas as $bakat)
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $bakat->kode }}" id="{{ $bakat->id }}" @checked(in_array($bakat->id, $checkedBakatKerja))>
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
                                        <input class="form-check-input" type="checkbox" value="{{   $temperamen->kode }}" id="{{ $temperamen->nama }}" @checked(in_array($temperamen->id, $checkedTemperamenKerja))>
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
                                        <input class="form-check-input" type="checkbox" value="{{   $upaya_fisik->kode }}" id="{{ $upaya_fisik->nama }}" @checked(in_array($upaya_fisik->id, $checkedUpayaFisik))>
                                        <label class="form-check-label" for="{{ $upaya_fisik->nama }}">{{ $upaya_fisik->nama }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <fieldset disabled>
                        <div class="my-3">
                            <p>Kondisi Fisik</p>
                            <div class="row">
                                <div class="col-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mb-3">
                                        <option value="L" @selected($jabatan->jenis_kelamin == 'L')>Laki-Laki</option>
                                        <option value="P" @selected($jabatan->jenis_kelamin == 'P')>Perempuan</option>
                                    </select>

                                    <label for="umur" class="form-label">Umur (Tahun)</label>
                                    <input type="text" class="form-control mb-3" id="umur" value="{{ $jabatan->umur }}">

                                    <label for="tinggi_badan" class="form-label text-capitalize">tinggi badan (sentimeter)</label>
                                    <input type="number" class="form-control mb-3" id="tinggi_badan" value="{{ $jabatan->tinggi_badan }}">
                                </div>
                                <div class="col-6">
                                    <label for="berat_badan" class="form-label text-capitalize">berat badan (kilogram)</label>
                                    <input type="number" class="form-control mb-3" id="berat_badan" value="{{ $jabatan->berat_badan }}">

                                    <label for="postur_badan" class="form-label text-capitalize">postur badan</label>
                                    <input type="text" class="form-control mb-3" id="postur_badan" value="{{ $jabatan->postur_badan }}">

                                    <label for="penampilan" class="form-label text-capitalize">penampilan</label>
                                    <input type="text" class="form-control mb-3" id="penampilan" value="{{ $jabatan->penampilan }}">
                                </div>
                            </div>
                            <hr class="mb-3">
                        </div>
                        <div class="row mb-4" id="fungsi_pekerjaan">
                            @foreach ($fungsi_pekerjaans as $fungsi_pekerjaan)
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{   $fungsi_pekerjaan->id }}" id="{{ $fungsi_pekerjaan->nama }}" @checked(in_array($fungsi_pekerjaan->id, $checkedFungsiPekerjaan))>
                                    <label class="form-check-label" for="{{ $fungsi_pekerjaan->nama }}"> {{$fungsi_pekerjaan->kode . " " . $fungsi_pekerjaan->nama }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    
                        <div class="mb-3">
                            <label for="prestasi" class="form-label text-capitalize">prestasi</label>
                            <input type="text" class="form-control " id="prestasi" value="{{ $jabatan->prestasi }}">
                        </div>
                        </fieldset>
                        <div class="">
                            {{-- <button type="submit" class="btn btn-primary header1"><img src="" alt="" data-feather="save" width="20px"> Simpan</button> --}}
                            <a href="{{ route('anjab.ajuan.show', ['ajuan' => $ajuan->tahun, 'id' => $ajuan->id]) }}" class="btn btn-primary header1"><img src="" alt="" data-feather="arrow-left" width="20px"> Kembali</a>
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