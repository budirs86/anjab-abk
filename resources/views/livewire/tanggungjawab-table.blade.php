<?php

use Livewire\Volt\Component;
use App\Models\TanggungJawabDiajukan;

new class extends Component {
    public $jabatan;
    public $nama;

    public function mount($jabatan) {
        $this->jabatan = $jabatan;
        $this->nama = '';

    }

    public function addTanggungJawab() {
        $validated = $this->validate([
            'nama' => 'required|string'
        ]);

        $this->jabatan->tanggungJawab()->create($validated);

        $this->reset('nama');
    }

    public function deleteTanggungJawab(TanggungJawabDiajukan $tanggungjawab) {
        $tanggungjawab->delete();
    
    }
}; ?> 

<div class="mb-3">
    <label for="tanggung_jawab" class="form-label">Tanggung Jawab</label>
    <table class="table table-bordered w-75" id="tanggung_jawab">
        <thead class="table-info">
            <th>No</th>
            <th>Uraian Tanggung Jawab</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->tanggungJawab as $tanggungJawab)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="d-flex justify-content-between">
                        <p>{{ $tanggungJawab->nama }}</p>
                    </td>
                    <td>
                        <button wire:click="deleteTanggungJawab({{ $tanggungJawab }})" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <form wire:submit="addTanggungJawab" method="POST">
                    @csrf
                    <td></td>
                    <td class="d-flex justify-content-between">
                        <input name="nama" type="text" class="form-control"
                            placeholder="Masukkan Tanggung Jawab" wire:model="nama">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                        Tambah</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
