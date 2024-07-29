<?php

use function Livewire\Volt\{state, with};

//
state([
    'selectedJabatanId' => null,
    'jabatans',
    
]);

with([
    'selectedJabatan' => fn() => $this->jabatans->find($this->selectedJabatanId),
])
?>

<div>
    <label for="jabatan" class="form-label">Pilih Berdasarkan Jabatan</label>
    <select name="jabatan" id="jabatan" wire:model.change="selectedJabatanId" class="form-select">
        <option value="">Pilih Jabatan</option>
        @foreach ($jabatans as $jabatan)
            <option value={{ $jabatan->id }}>{{ $jabatan->nama }}</option>
        @endforeach 
    </select>
    @if ($selectedJabatanId)
        <div class="my-3 mx-5">
            <h2 class="text-center mb-5">Informasi Jabatan</h2>
            <ol class="">
                <li class="mb-2">
                    <div class="row">
                        <div class="col-2">Nama Jabatan</div>:
                        <div class="col"> {{ $selectedJabatan->nama }}</div>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="row">
                        <div class="col-2">Kode Jabatan</div>:
                        <div class="col"> {{ $selectedJabatan->kode }}</div>
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
                    <p>{{ $selectedJabatan->ikhtisar ?? "Lorem ipsum dolor sit amet consectetur." }}</p>
                </li>
                <li>
                    <div class="row">
                        <div class="col-2">Kualifikasi Jabatan</div>:
                    </div>
                    <ol type="a">
                        <li>
                            <p>Pendidikan Formal</p>
                            <ul class="m-0">
                                @forelse ($selectedJabatan->kualifikasi->pendidikanFormals as $pendidikanFormal)
                                    <li>{{ $pendidikanFormal->jenjang . " - " . $pendidikanFormal->jurusan }}</li>
                                @empty
                                    {{ "-" }}
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Pendidikan dan Pelatihan</p>
                            <ul class="m-0">
                                @forelse ($selectedJabatan->kualifikasi->pendidikanPelatihans as $pendidikanPelatihan)
                                    <li>{{ $pendidikanPelatihan->nama  }}</li>
                                @empty
                                    {{ "-" }}
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Pengalaman</p>
                            <ul class="m-0">
                                @forelse ($selectedJabatan->kualifikasi->pengalamans as $pengalaman)
                                    <li>{{ $pengalaman->nama  }}</li>
                                @empty
                                    {{ "-" }}
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
                            @forelse ($selectedJabatan->uraianTugas as $uraianTugas)
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
                        @forelse ($selectedJabatan->uraianTugas as $uraianTugas)
                        <li>
                            <p>{{ $uraianTugas->hasil_kerja ?? "Data Belum diisi"}}</p>
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
                            @forelse ($selectedJabatan->bahanKerja as $bahan_kerja)
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
                            @forelse ($selectedJabatan->perangkatKerja as $perangkat_kerja)
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
                            @forelse ($selectedJabatan->tanggungJawab as $tanggungJawab)
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
                            @forelse ($selectedJabatan->wewenang as $wewenang)
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
                            @forelse ($selectedJabatan->korelasiJabatan as $korelasiJabatan)
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
                            @forelse ($selectedJabatan->kondisiLingkunganKerja->getAttributes() as $aspek => $faktor)
                                {{-- show all attributes except id, nama, jabatan_id, created_at, updated_at --}}
                                @if (!in_array($aspek, ['id','nama','jabatan_id', 'created_at', 'updated_at']))
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
                            @forelse ($selectedJabatan->risikoBahaya as $risiko)
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
                            <p>{{ $selectedJabatan->syaratJabatan->keterampilan }}</p>
                        </li>
                        <li>
                            <p>Bakat Kerja</p>
                            <ul class="mb-3">
                                @forelse ($selectedJabatan->syaratJabatan->syaratBakat as $bakat)
                                    <li>{{ $bakat->bakatKerja->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Temperamen Kerja</p>
                            <ul class="mb-3">
                                @forelse ($selectedJabatan->syaratJabatan->syaratTemperamens as $temperamen)
                                    <li>{{ $temperamen->temperamenKerja->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Minat Kerja</p>
                            <ul class="mb-3">
                                @forelse ($selectedJabatan->syaratJabatan->syaratMinats as $minat)
                                    <li>{{ $minat->minatKerja->nama }}</li>
                                @empty
                                    Data Tidak Ditemukan
                                @endforelse
                            </ul>
                        </li>
                        <li>
                            <p>Upaya Fisik :</p>
                            <ul class="mb-3">
                                @forelse ($selectedJabatan->syaratJabatan->syaratUpayas as $upaya)
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
                                        <p class="col">{{ $selectedJabatan->syaratJabatan->jenis_kelamin== 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Umur</p>:
                                        <p class="col">{{ $selectedJabatan->syaratJabatan->umur . ' Tahun' }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Tinggi Badan</p>:
                                        <p class="col">{{ $selectedJabatan->syaratJabatan->tinggi_badan . ' cm' }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Berat Badan</p>:
                                        <p class="col">{{ $selectedJabatan->syaratJabatan->berat_badan . ' kg' }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Postur Badan</p>:
                                        <p class="col">{{ $selectedJabatan->syaratJabatan->postur_badan }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <p class="col-2">Postur Badan</p>:
                                        <p class="col">{{ $selectedJabatan->syaratJabatan->penampilan }}</p>
                                    </div>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <p>Fungsi Pekerjaan :</p>
                            <ul>
                                @forelse ($selectedJabatan->syaratJabatan->SyaratFungsis as $fungsi)
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
                    <p>{{ $selectedJabatan->prestasi }}</p>
                </li>
            </ol>
        </div>
    @endif
</div>
