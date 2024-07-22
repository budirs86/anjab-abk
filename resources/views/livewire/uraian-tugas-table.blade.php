<?php

use Livewire\Volt\Component;
use App\Models\UraianTugas;

new class extends Component {
    public $jabatan;
    public $uraian;

    public function mount($jabatan) {
        $this->jabatan = $jabatan;
        $this->uraian = '';
    }

    public function addUraianTugas() {
        $this->validate([
            'uraian' => 'required|string'
        ]);

        $this->jabatan->uraianTugas()->create([
            'nama_tugas' => $this->uraian
        ]);

        $this->reset('uraian');
    
    }

    public function deleteUraianTugas(UraianTugas $uraian) {
        $uraian->delete();
    }
}; ?>

<div class="mb-3">
    <table class="table table-bordered w-75" id="uraian_tugas">
        <caption class="caption-top text-black">Uraian Tugas</caption>
        <thead class="table-info">
            <th>No</th>
            <th>Uraian Tugas</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->uraianTugas as $uraian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="d-flex justify-content-between">
                        <p>{{ $uraian->nama_tugas }}</p>
                    </td>
                    <td class="">
                        <button type="button" class="btn btn-danger" wire:click="deleteUraianTugas({{ $uraian }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>   
                </tr>
            @endforeach
            <tr>
                <td></td>
                <form action="" wire:submit="addUraianTugas()">
                    <td class="">
                        <input name="nama_tugas" type="text" class="form-control"
                            placeholder="Masukkan Uraian Tugas" wire:model="uraian">
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
