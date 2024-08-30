<?php

use Livewire\Volt\Component;
use App\Models\JabatanDiajukan;
use App\Models\Unsur;

new class extends Component {
    public $search = '';
    public $ajuan = '';
    public $jabatans = '';
    public $unsurs = '';
    public $mode;

    public function with()
    {
        if ($this->search) {
            $this->jabatans = JabatanDiajukan::where('ajuan_id', $this->ajuan->id)
                ->where('nama', 'like', '%' . $this->search . '%')
                ->get();
        }
        return [
            'jabatans' => JabatanDiajukan::where('ajuan_id', $this->ajuan->id)
                ->with('uraianTugas')
                ->where('nama', 'like', '%' . $this->search . '%')
                ->get(),
        ];
    }
}; ?>

<div>
    {{-- @dd($this->ajuan) --}}
    {{ $this->mode == 'edit' }}
    <div class="form-floating mb-3 w-25 ">
        <input type="email" wire:model.live="search" class="form-control" id="search" placeholder="Cari Jabatan">
        <label for="search">Cari Nama Jabatan</label>
    </div>
    @if (empty($this->search))
        <table class="table table-bordered">
            <thead>
                <th class="text-muted d-flex justify-content-between">
                    Unsur
                    @can('verify anjab')
                        {{--  show buttons only when next verificator is the current user  --}}
                        @if ($this->ajuan->next_verificator()->role->name == auth()->user()->getRoleNames()->first())
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#modalTerima">Terima Semua Jabatan</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalRevisi">Revisi Semua Jabatan</button>
                            </div>
                        @endif
                    @endcan
                    @if ($this->mode == 'edit')
                        <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal"
                            data-bs-target="#modalJabatan" id="addButton" data-bs-atasan=""><i
                                class="fa-solid fa-plus"></i>
                            Tambah Jabatan</button>
                    @endif
                </th>
                </th>
            </thead>
            <tbody>
                @foreach ($unsurs as $unsur)
                    <tr wire:key="{{ $unsur->nama }}" class="table-secondary">
                        <td colspan="2">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $unsur->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $unsur->id }}">
                                <i class="fa-solid fa-chevron-down me-2"></i>
                            </button>
                            {{ $unsur->nama }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-0">
                            <div class="collapse" id="collapse{{ $unsur->id }}">
                                <table class="table mb-0 table-bordered table-striped">
                                    <thead>
                                        <th class="fw-semibold text-muted">Kode</th>
                                        <th class="fw-semibold text-muted d-flex">Jabatan
                                        </th>
                                    </thead>
                                    @forelse ($unsur->jabatanDiajukan as $jabatan)
                                        <tr wire:key="{{ $jabatan->id }}">
                                            <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
                                            <td class="d-flex justify-content-between">
                                                <div class="d-flex gap-1"
                                                    style="margin-left: {{ 25 * $jabatan->depth }}px">
                                                    @if ($jabatan->depth > 0)
                                                        <i class="fa-solid fa-chevron-right mt-1"></i>
                                                    @endif
                                                    <p class="" href="/anjab/analisis-jabatan/create"
                                                        style="">
                                                        {{ $jabatan->nama }}
                                                    </p>
                                                </div>
                                                <div class="div">
                                                    <a href="{{ route('anjab.ajuan.jabatan.edit.1', ['ajuan' => $ajuan->tahun, 'jabatan' => $jabatan->id]) }}"
                                                        class="btn btn-sm btn-warning ms-auto add-button"><i class="fa-solid fa-edit"></i> Edit Informasi
                                                        Jabatan</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Unsur ini Belum memiliki Jabatan</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table class="table mb-0 table-bordered table-striped">
            <thead>
                <th class="fw-semibold text-muted"style="width: 10%">Kode</th>
                <th class="fw-semibold text-muted d-flex">Jabatan
                </th>
            </thead>
            @forelse ($jabatans as $jabatan)
                <tr wire:key="{{ $jabatan->id }}">
                    <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
                    <td class="d-flex justify-content-between">
                        <div class="d-flex gap-1" style="margin-left: {{ 25 * $jabatan->depth }}px">
                            @if ($jabatan->depth > 0)
                                <i class="fa-solid fa-chevron-right mt-1"></i>
                            @endif
                            <p class="" href="/anjab/analisis-jabatan/create" style="">
                                {{ $jabatan->nama }}
                            </p>
                        </div>
                        <div class="div">
                            <a href="{{ route('anjab.ajuan.jabatan.edit.1', ['ajuan' => $ajuan->tahun, 'jabatan' => $jabatan->id]) }}"
                                class="btn btn-sm btn-warning ms-auto add-button"><i class="fa-solid fa-edit"></i> Edit Informasi
                                Jabatan</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Jabatan Tidak Ditemukan</td>
                </tr>
            @endforelse
        </table>
    @endif
</div>
