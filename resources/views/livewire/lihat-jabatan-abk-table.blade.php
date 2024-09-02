<?php

use Livewire\Volt\Component;
use App\Models\ABKJabatan;

new class extends Component {
    public $tutams;
    public $abk;
    public $unit;
    public $search;
    public $jabatans;

    public function with() {
        if ($this->search) {
            $this->jabatans = ABKJabatan::with('jabatanTugasTambahan')->where('abk_id', $this->abk->id)->whereHas('jabatan', function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })->get();
        }
        return ['jabatans' => $this->jabatans];
    }
}; ?>

<div>
    <div class="form-floating mb-3 w-25 ">
        <input type="email" wire:model.live="search" class="form-control" id="search" placeholder="Cari Jabatan">
        <label for="search">Cari Nama Jabatan</label>
    </div>
    @if ($this->search)
        <table class="table mb-0 table-bordered table-striped">
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
                            <p>{{ $jabatan->jabatan->nama }} <span class="text-muted">(Di bawahi oleh {{ $jabatan->jabatanTugasTambahan->nama }})</span></p>
                            <div class="">
                                <a href="{{ route('abk.jabatan.show', ['abk' => $this->abk, 'unit_kerja' => $this->unit, 'abk_jabatan' => $jabatan]) }}"
                                    class="btn btn-sm btn-primary ms-auto"><i class="fa-regular fa-eye"></i> Lihat
                                    Analisis Beban
                                    Kerja</a>
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
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $tutam->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $tutam->id }}">
                                <i class="fa-solid fa-chevron-down me-2"></i>
                            </button>
                            {{ $tutam->nama }}
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
                                    @forelse ($tutam->abkJabatan->where('abk_id',$this->abk->id) as $jabatan)
                                        <tr wire:key="{{ $jabatan->id }}">
                                            <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <p>{{ $jabatan->jabatan->nama }}</p>
                                                    <div class="">
                                                        <a href="{{ route('abk.jabatan.show', ['abk' => $abk, 'unit_kerja' => $this->unit, 'abk_jabatan' => $jabatan]) }}"
                                                            class="btn btn-sm btn-primary ms-auto"><i
                                                                class="fa-regular fa-eye"></i> Lihat Analisis Beban
                                                            Kerja</a>
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
                @endforeach
            </tbody>
        </table>
    @endif
</div>
