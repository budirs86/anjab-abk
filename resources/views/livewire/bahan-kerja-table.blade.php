<?php

use Livewire\Volt\Component;
use App\Models\BahanKerjaDiajukan;

new class extends Component {
    public $jabatan;
    public $nama;

    public function mount($jabatan)
    {
        $this->jabatan = $jabatan;
        $this->nama = '';
    }

    public function addBahanKerja() {
        $validated = $this->validate([
            'nama' => 'required|string'
        ]);

        $this->jabatan->bahanKerja()->create($validated);

        $this->reset('nama');
    }

    public function deleteBahanKerja(BahanKerjaDiajukan $bahanKerja) {
        $bahanKerja->delete();

    }
}; ?>

<div class="mb-3">
    <label for="bahan_kerja" class="form-label">Bahan Kerja</label>
    <table class="table table-bordered w-75" id="BahanKerja">
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
                        <button wire:click="deleteBahanKerja({{ $bahanKerja }})" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <form wire:submit="addBahanKerja()" method="POST">
                    @csrf
                    <td></td>
                    <td>
                        <input name="nama" type="text" class="form-control"
                            placeholder="Masukkan Bahan Kerja" wire:model="nama">
                    </td>
                    <td><button type="submit" class="btn btn-primary"><i data-feather="plus"></i>
                            Tambah</button></td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
