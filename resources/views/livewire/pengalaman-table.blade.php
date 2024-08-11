<?php

use Livewire\Volt\Component;
use App\Models\PengalamanDiajukan;

new class extends Component {
    public $jabatan;
    public $id;
    public $nama;
    public $lama;

    public function mount($jabatan)
    {
        $this->jabatan = $jabatan;
        $this->id = $this->jabatan->id;
        $this->nama = '';
        $this->lama = '';
    }

    public function addPengalaman()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'lama' => 'required',
        ]);

        $this->jabatan->pengalaman()->create($validated);
        $this->reset(['nama', 'lama']);
    }

    public function deletePengalaman(PengalamanDiajukan $pengalaman)
    {
        $pengalaman->delete();
    }
}; ?>

<div>
    <table class="table table-bordered w-75" id="pengalaman">
        <caption class="caption-top">Kualifikasi Jabatan | Pengalaman</caption>
        <thead class="table-primary">
            <th>No</th>
            <th>Nama Pengalaman</th>
            <th>Lama Pengalaman (Tahun)</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->pengalaman as $pengalaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengalaman->nama }}</td>
                    <td>{{ $pengalaman->lama }}</td>
                    <td class="d-flex gap-1">
                        <button type="button" class="btn btn-danger" wire:click="deletePengalaman({{ $pengalaman }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <form wire:submit="addPengalaman">
                    <td></td>
                    <td><input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Pengalaman"
                            wire:model="nama">
                    </td>
                    <td><input name="lama" type="text" class="form-control" placeholder="Masukkan Lama Pengalaman"
                            wire:model="lama">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            Tambah
                        </button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
