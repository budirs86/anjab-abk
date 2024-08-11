<?php

use Livewire\Volt\Component;
use App\Models\PendidikanPelatihanDiajukan;

new class extends Component {
    public $jabatan;
    public $pelatihan;

    public function mount($jabatan)
    {
        $this->jabatan = $jabatan;
        $this->pelatihan = '';
    }

    public function addPelatihan()
    {
        $this->validate([
            'pelatihan' => 'required|string',
        ]);

        $this->jabatan->pendidikanPelatihan()->create([
            'nama' => $this->pelatihan,
        ]);

        $this->reset('pelatihan');
    }

    public function deletePelatihan(PendidikanPelatihanDiajukan $pelatihan)
    {
        $pelatihan->delete();
    }
}; ?>

<div>
    <table class="table table-bordered w-75" id="pelatihan">
        <caption class="caption-top"> Kualifikasi Jabatan | Pelatihan</caption>
        <thead class="table-primary">
            <th>No</th>
            <th>Jenis Pelatihan</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->pendidikanPelatihan as $pelatihan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pelatihan->nama }}</td>
                    <td class="d-flex gap-1">
                        <button wire:click="deletePelatihan({{ $pelatihan }})" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <input type="hidden" name="kualifikasi_jabatan_id" value="{{ $jabatan->id }}">
                <td></td>
                <td class="d-flex justify-content-between">
                    <input name="nama" type="text" class="form-control w-100"
                        placeholder="Masukkan Nama Pelatihan" wire:model="pelatihan">
                </td>
                <td>
                    <button wire:click="addPelatihan" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Tambah
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
