<?php

use Livewire\Volt\Component;
use App\Models\WewenangDiajukan;

new class extends Component {
    public $jabatan;
    public $nama;

    public function mount($jabatan) {
        $this->jabatan = $jabatan;
        $this->nama = '';

    }

    public function addWewenang() {
        $validated = $this->validate([
            'nama' => 'required|string'
        ]);

        $this->jabatan->wewenang()->create($validated);

        $this->reset('nama');
    }

    public function deleteWewenang(WewenangDiajukan $wewenang) {
        $wewenang->delete();
    
    }
}; ?>

<div class="mb-3">
    <label for="wewenang" class="form-label">Wewenang</label>
    <table class="table table-bordered w-75" id="wewenang">
        <thead class="table-info">
            <th>No</th>
            <th>Wewenang</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->wewenang as $wewenang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="d-flex justify-content-between">
                        <p>{{ $wewenang->nama }}</p>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-danger" wire:click="deleteWewenang({{ $wewenang }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <form wire:submit="addWewenang" method="POST">
                    @csrf
                    <td></td>
                    <td class="d-flex justify-content-between">
                        <input name="nama" type="text" class="form-control"
                            placeholder="Masukkan Wewenang" wire:model="nama">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
