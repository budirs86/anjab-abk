<?php

use Livewire\Volt\Component;
use App\Models\PerangkatKerja;

new class extends Component {
    public $jabatan;
    public $nama;

    public function mount($jabatan) {
        $this->jabatan = $jabatan;
        $this->nama = '';
    }

    public function addPerangkatKerja() {
        $this->validate([
            'nama' => 'required|string'
        ]);

        $this->jabatan->perangkatKerja()->create([
            'nama' => $this->nama
        ]);

        $this->reset('nama');
    }

    public function deletePerangkatKerja(PerangkatKerja $perangkatKerja) {
        $perangkatKerja->delete();
    
    }
}; ?>

<div class="mb-3">
    <label for="perangkat_kerja" class="form-label">Perangkat Kerja</label>
    <table class="table table-bordered w-75" id="PerangkatKerja">
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
                        <button wire:click="deletePerangkatKerja({{ $perangkatKerja }})" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <form wire:submit="addPerangkatKerja()">
                    @csrf
                    <td></td>
                    <td>
                        <input name="nama" type="text" class="form-control" placeholder="Masukkan Perangkat Kerja" wire:model="nama">
                    </td>
                    <td><button type="submit" class="btn btn-primary"><i data-feather="plus"></i>
                            Tambah</button></td>
                </form>
            </tr>
        </tbody>
    </table>
</div>