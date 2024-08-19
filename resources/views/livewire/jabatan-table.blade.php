<?php

use Livewire\Volt\Component;
use App\Models\JabatanDiajukan;

new class extends Component {
    
    public $search = '';

    public function with() {
        if (empty($this->search)) {
            return [
            'jabatans' => JabatanDiajukan::where('ajuan_id', null)->with('uraianTugas')->tree()->get()->toTree()
        ];
        }
        else {
            return [
                'jabatans' => JabatanDiajukan::where('ajuan_id', null)->with('uraianTugas')->where('nama', 'like', '%'.$this->search.'%')->get()
            ];
        }
    }

}; ?>

<div>
    <div class="form-floating mb-3 w-25 ">
        <input type="email" wire:model.live="search" class="form-control" id="search" placeholder="Cari Jabatan">
        <label for="search">Cari Nama Jabatan</label>
    </div>
    <table class="table table-striped table-bordered">
        <thead >
            <th class="fw-semibold text-muted">Kode</th>
            <th class="fw-semibold text-muted d-flex">Jabatan
                <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan=""><i class="fa-solid fa-plus"></i> Tambah Jabatan</button>
            </th>
        </thead>
        <tbody>
            @foreach ($jabatans as $jabatan)
                <x-table-row type="create" :jabatan="$jabatan" wire:key="{{ $jabatan->id }}"></x-table-row>
            @endforeach
        </tbody>
    </table>
</div>
