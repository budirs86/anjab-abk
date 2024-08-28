<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js">
    </script>
    <script src="bootstrap-autocomplete.min.js"></script>
    <title>Document</title>
    <style>
        @media print {
            .page-break-after {
                page-break-after: always;
            }
        }

        @media print {
            .page-break-after {
                break-after: page;
            }
        }
    </style>
</head>

<body>
    @foreach ($jabatans ?? [] as $jabatan)
        <div class="my-3 mx-5" style="page-break-after: always">
            <h2 class="text-center mb-5">Informasi Jabatan</h2>
            <ol class="">
                <li class="mb-2">
                    <div class="row">
                        <div class="col-2">Nama Jabatan</div>:
                        <div class="col"> {{ $jabatan->nama }}</div>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="row">
                        <div class="col-2">Kode Jabatan</div>:
                        <div class="col"> {{ $jabatan->kode }}</div>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="row">
                        <div class="col-2">Unit Kerja</div>:
                    </div>
                    <ol type="a">
                        <li>
                            <div class="row">
                                <div class="col-2">JPT Madya</div>:
                                <div class="col">Lorem.</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-2">JPT Pratama</div>:
                                <div class="col">Lorem.</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-2">Manajer</div>:
                                <div class="col">Lorem.</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-2">Supervisor</div>:
                                <div class="col">Lorem.</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-2">Pelaksana</div>:
                                <div class="col">Lorem.</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-2">Fungsional</div>:
                                <div class="col">Lorem.</div>
                            </div>
                        </li>
                    </ol>
                </li>
                <li>
                    <div class="row">
                        <div class="col-2">Ikhtisar Jabatan</div>:
                    </div>
                    <p>{{ $jabatan->ikhtisar ?? 'Lorem ipsum dolor sit amet consectetur.' }}</p>
                </li>
                <li>
                    <div class="row">
                        <div class="col-2">Kualifikasi Jabatan</div>:
                    </div>
                    <ol type="a">
                        <li>
                            <p>Pendidikan Formal</p>
                            <ul class="m-0">
                                @forelse ($jabatan->pendidikanFormals ?? [] as $pendidikanFormal)
                                    <li>{{ $pendidikanFormal->jenjang . ' - ' . $pendidikanFormal->jurusan }}</li>
                                @empty
                                    {{ '-' }}
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Pendidikan dan Pelatihan</p>
                            <ul class="m-0">
                                @forelse ($jabatan->pendidikanPelatihans ?? [] as $pendidikanPelatihan)
                                    <li>{{ $pendidikanPelatihan->nama }}</li>
                                @empty
                                    {{ '-' }}
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Pengalaman</p>
                            <ul class="m-0">
                                @forelse ($jabatan->pengalamans ?? [] as $pengalaman)
                                    <li>{{ $pengalaman->nama }}</li>
                                @empty
                                    {{ '-' }}
                                @endforelse
                            </ul>
                        </li>
                    </ol>
                </li>
                <li class="mt-3">
                    <p>Tugas Pokok</p>

                    <table class="table table-bordered">
                        <thead class="table-primary" class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Uraian Tugas</th>
                                <th>Hasil Kerja</th>
                                <th>Jumlah Hasil</th>
                                <th>Waktu Penyelesaian (Jam)</th>
                                <th>Waktu Efektif</th>
                                <th>Kebutuhan Pegawai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatan->uraianTugas ?? [] as $uraianTugas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $uraianTugas->nama_tugas }}</td>
                                    <td>{{ $uraianTugas->hasil_kerja }}</td>
                                    <td>{{ $uraianTugas->beban_kerja }}</td>
                                    <td>{{ $uraianTugas->waktu_penyelesaian }}</td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="4" class="table-primary text-center">Jumlah</td>
                                <td>...</td>
                                <td></td>
                                <td>...</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="table-primary text-center">Jumlah Pegawai</td>
                                <td>...</td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Hasil Kerja</p>
                    <ol>
                        @forelse ($jabatan->uraianTugas ?? [] as $uraianTugas)
                            <li>
                                <p>{{ $uraianTugas->hasil_kerja ?? 'Data Belum diisi' }}</p>
                            </li>
                        @empty
                            Data Tidak Ditemukan
                        @endforelse
                    </ol>
                </li>
                <li>
                    <p>Bahan Kerja</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Bahan Kerja</th>
                                <th>Penggunaan Dalam Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatan->bahanKerja ?? [] as $bahan_kerja)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bahan_kerja->nama }}</td>
                                    <td>{{ $bahan_kerja->penggunaan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Perangkat Kerja</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Perangkat Kerja</th>
                                <th>Penggunaan Dalam Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatan->perangkatKerja ?? [] as $perangkat_kerja)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $perangkat_kerja->nama }}</td>
                                    <td>{{ $perangkat_kerja->penggunaan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Tanggung Jawab</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggung Jawab</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatan->tanggungJawab ?? [] as $tanggungJawab)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tanggungJawab->nama }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Wewenang</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Wewenang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatan->wewenang ?? [] as $wewenang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $wewenang->nama }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Korelasi Jabatan</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Unit Kerja/Instansi</th>
                                <th>Dalam Hal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatan->korelasiJabatan ?? [] as $korelasiJabatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $korelasiJabatan->jabatanRelasi->nama }}</td>
                                    <td>{{ $korelasiJabatan->jabatanRelasi->unitKerja->nama }}</td>
                                    <td>{{ $korelasiJabatan->dalam_hal }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Kondisi Lingkungan Kerja</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Aspek</th>
                                <th>Faktor</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- loop through all attributes of kondisi lingkungan kerja as an associative array --}}
                            @forelse ($jabatan->getAttributes() ?? [] as $aspek => $faktor)
                                {{-- show all attributes except id, nama, jabatan_id, created_at, updated_at --}}
                                @if (!in_array($aspek, ['id', 'nama', 'jabatan_id', 'created_at', 'updated_at']))
                                    <tr>
                                        <td class="text-capitalize">{{ $aspek }}</td>
                                        <td class="text-capitalize">{{ $faktor }}</td>
                                    </tr>
                                @endif
                            @empty
                                <tr colspan="2">Data Tidak Ditemukan</tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Risiko Bahaya</p>
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Risiko</th>
                                <th>Penyebab</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- loop through all attributes of kondisi lingkungan kerja as an associative array --}}
                            @forelse ($jabatan->risikoBahaya ?? [] as $risiko)
                                {{-- show all attributes except id, nama, jabatan_id, created_at, updated_at --}}
                                <tr>
                                    <td class="text-capitalize">{{ $loop->iteration }}</td>
                                    <td class="text-capitalize">{{ $risiko->bahaya_fisik }}</td>
                                    <td class="text-capitalize">{{ $risiko->penyebab }}</td>
                                </tr>
                            @empty
                                <tr colspan="3">Data Tidak Ditemukan</tr>
                            @endforelse
                        </tbody>
                    </table>
                </li>
                <li>
                    <p>Syarat Jabatan</p>
                    <ol type="a">
                        <li>
                            <p>Keterampilan Kerja</p>
                            <p>{{ $jabatan->keterampilan }}</p>
                        </li>
                        <li>
                            <p>Bakat Kerja</p>
                            <ul class="mb-3">
                                @forelse ($jabatan->syaratBakat ?? [] as $bakat)
                                    <li>{{ $bakat->bakatKerja->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Temperamen Kerja</p>
                            <ul class="mb-3">
                                @forelse ($jabatan->syaratTemperamens ?? [] as $temperamen)
                                    <li>{{ $temperamen->temperamenKerja->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Minat Kerja</p>
                            <ul class="mb-3">
                                @forelse ($jabatan->syaratMinats ?? [] as $minat)
                                    <li>{{ $minat->minatKerja->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Upaya Fisik :</p>
                            <ul class="mb-3">
                                @forelse ($jabatan->syaratUpayas ?? [] as $upaya)
                                    <li>{{ $upaya->upayaFisik->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>
                                Kondisi Fisik :
                            </p>
                            <ol type="1">
                                <li>
                                    <div class="row">
                                        <p class="col-2">Jenis Kelamin</p>:
                                        <p class="col">
                                            {{ $jabatan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Umur</p>:
                                        <p class="col">{{ $jabatan->umur . ' Tahun' }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Tinggi Badan</p>:
                                        <p class="col">{{ $jabatan->tinggi_badan . ' cm' }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Berat Badan</p>:
                                        <p class="col">{{ $jabatan->berat_badan . ' kg' }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Postur Badan</p>:
                                        <p class="col">{{ $jabatan->postur_badan }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Postur Badan</p>:
                                        <p class="col">{{ $jabatan->penampilan }}</p>
                                    </div>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <p>Fungsi Pekerjaan :</p>
                            <ul>
                                @forelse ($jabatan->SyaratFungsis ?? [] as $fungsi)
                                    <li>{{ $fungsi->fungsiPekerjaan->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                    </ol>
                </li>
                <li>
                    <p>Prestasi Kerja :</p>
                    <p>{{ $jabatan->prestasi }}</p>
                </li>
            </ol>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js">
    </script>
    <script src="bootstrap-autocomplete.min.js"></script>
</body>

</html>
