<?php

use Livewire\Volt\Component;
use App\Models\AbkJabatan;

new class extends Component {
    public $tutams;
    public $abk;
    public $unit;
    public $search;
    public $jabatans;
    public $selectedJabatan;

    public function with()
    {
        if ($this->search) {
            $this->jabatans = ABKJabatan::with('jabatanTugasTambahan')
                ->where('abk_id', $this->abk->id)
                ->whereHas('jabatan', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->get();
        }
        return ['jabatans' => $this->jabatans];
    }

    // DELETE JABATAN
    // assigns jabatan to be deleted to $selectedJabatan
    public function deleteJabatan(ABKJabatan $jabatan)
    {
        $this->selectedJabatan = $jabatan;
        // dd($this->selectedJabatan->nama);
    }

    // DESTROY JABATAN
    // deletes selected jabatan in $selectedJabatan from database
    public function destroyJabatan()
    {
        $this->selectedJabatan->delete();
    }
}; ?>

<div>
    <div class="" wire:ignore>
        <div class="modal fade" tabindex="-1" id="deleteJabatanModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus ABK Jabatan?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin menghapus jabatan? Jabatan yang sudah dihapus
                            tidak bisa dikembalikan lagi.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click="destroyJabatan"
                            data-bs-dismiss="modal">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3 w-25 ">
        <input type="email" wire:model.live="search" class="form-control" id="search" placeholder="Cari Jabatan">
        <label for="search">Cari Nama Jabatan</label>
    </div>
    @if ($this->search)
        <table class="table mb-3 table-bordered table-striped">
            <thead>
                <th class="fw-semibold text-muted">Kode</th>
                <th class="fw-semibold text-muted d-flex">Jabatan
                </th>
            </thead>
            @forelse ($jabatans as $jabatan)
                <tr wire:key="{{ $jabatan->id }}">
                    <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <p>{{ $jabatan->jabatan->nama }}</p>
                                <span class="text-muted">(Dibawahi oleh
                                    {{ $jabatan->jabatanTugasTambahan->nama }})</span>
                            </div>
                            <div class="">
                                <div class="">
                                    <a href="{{ route('abk.jabatan.edit', ['abk' => $abk, 'unit_kerja' => $this->unit, 'abk_jabatan' => $jabatan]) }}"
                                        class="btn btn-sm btn-warning ms-auto"><i class="fa-solid fa-edit"></i> Edit
                                        Analisis Beban
                                        Kerja</a>
                                    <button data-bs-target="#deleteJabatanModal" data-bs-toggle="modal"
                                        class="btn btn-danger btn-sm" wire:click="deleteJabatan({{ $jabatan }})"><i
                                            class="fa-solid fa-trash"></i> Hapus
                                        Jabatan</button>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="w-25">
                        <div class="overflow-y-scroll" style="line-height: 1.5em; max-height: calc(1.5em * 4);">
                            @forelse ($jabatan->catatanAjuan as $catatan)
                                <p class="m-0 p-0 text-muted">Catatan oleh
                                    {{ $catatan->verifikasi->user->name }}</p>
                                <p class="m-0 p-0 text-muted">
                                    {{ $catatan->verifikasi->created_at }}</p>
                                <p class="m-0 p-0">{{ $catatan->catatan }}</p>
                                <hr>
                            @empty
                                <p class="m-0 p-0 text-muted">Tidak ada catatan.</p>
                            @endforelse
                        </div>
                    </td>
                <tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Jabatan Tidak Ditemukan.</td>
                </tr>
            @endforelse
        </table>
    @else
        <table class="table table-bordered">
            <thead>
                <th class="text-muted d-flex">
                    Jabatan Tugas Tambahan
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
                                    @forelse ($tutam->abkJabatan->where('abk_id',$abk->id) as $jabatan)
                                        <tr wire:key="{{ $jabatan->id }}">
                                            <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <p>{{ $jabatan->jabatan->nama }}</p>
                                                    <div class="">
                                                        <a href="{{ route('abk.jabatan.edit', ['abk' => $abk, 'unit_kerja' => $this->unit, 'abk_jabatan' => $jabatan]) }}"
                                                            class="btn btn-sm btn-warning ms-auto"><i
                                                                class="fa-solid fa-edit"></i> Edit Analisis Beban
                                                            Kerja</a>
                                                        <button data-bs-target="#deleteJabatanModal"
                                                            data-bs-toggle="modal" class="btn btn-danger btn-sm"
                                                            wire:click="deleteJabatan({{ $jabatan }})"><i
                                                                class="fa-solid fa-trash"></i> Hapus
                                                            Jabatan</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-25">
                                                <div class="overflow-y-scroll"
                                                    style="line-height: 1.5em; max-height: calc(1.5em * 4);">
                                                    @forelse ($jabatan->catatanAjuan as $catatan)
                                                        <p class="m-0 p-0 text-muted">Catatan oleh
                                                            {{ $catatan->verifikasi->user->name }}</p>
                                                        <p class="m-0 p-0 text-muted">
                                                            {{ $catatan->verifikasi->created_at }}</p>
                                                        <p class="m-0 p-0">{{ $catatan->catatan }}</p>
                                                        <hr>
                                                    @empty
                                                        <p class="m-0 p-0 text-muted">Tidak ada catatan.</p>
                                                    @endforelse
                                                </div>
                                            </td>
                                        <tr>

                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Jabatan Bawahan belum disusun.</td>
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
                                    <form action="{{ route('abk.abk-jabatan.store', ['abk' => $abk]) }}"
                                        method="POST" id="jabatanForm">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="integer" name="abk_id" value="{{ $abk->id }}" hidden>
                                            <input type="integer" name="jabatan_tutam_id"
                                                value="{{ $tutam->id }}" hidden>
                                            <label for="nama" class="form-label">Supervisor</label>
                                            <input type="text"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Masukkan Nama Jabatan" value="{{ $tutam->nama }}"
                                                readonly>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="jabatan_id" class="form-label">Jabatan
                                                Bawahan</label>
                                            <select class="form-select @error('jabatan_id') is-invalid @enderror"
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
    @endif
</div>
